<?php
    /*
     * INFORMES MÉDICOS (PDF o Word) DE LOS ESTUDIOS DE IMÁGENES
     *
     * Los archivos se guardan en INFORMES_DIR (fuera de htdocs), en subcarpetas por año/mes
     * y con un nombre aleatorio: nadie puede adivinar la dirección de un informe ni abrirlo
     * sin pasar por el sistema, que revisa la sesión y el área antes de entregarlo.
     * En la base solo queda el nombre original (para mostrarlo) y la ruta relativa.
     *
     * Respuesta 5 = el archivo no es un PDF/Word válido o supera el tamaño máximo.
     */

    // Firma de los primeros bytes de cada formato admitido: se revisa el contenido real,
    // no solo la extensión (un .exe renombrado a .pdf se rechaza).
    function informe_formatos(){
        return array('pdf'  => array('firma' => "%PDF-",            'mime' => 'application/pdf'),
                     'doc'  => array('firma' => "\xD0\xCF\x11\xE0", 'mime' => 'application/msword'),
                     'docx' => array('firma' => "PK\x03\x04",       'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'));
    }

    // Si el envío superó post_max_size, PHP descarta TODO el formulario: se avisa como archivo muy grande.
    function informe_validar_envio(){
        $longitud = isset($_SERVER['CONTENT_LENGTH']) ? (int)$_SERVER['CONTENT_LENGTH'] : 0;
        if ($longitud > 0 && empty($_POST) && empty($_FILES)) {
            responder("5");
        }
    }

    // Archivo recibido en el campo $campo: null si no se eligió ninguno; corta con "5" si no es válido.
    function informe_recibido($campo){
        if (!isset($_FILES[$campo]) || !is_array($_FILES[$campo]) || is_array($_FILES[$campo]['error'])) {
            return null;
        }
        $archivo = $_FILES[$campo];
        if ($archivo['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }
        if ($archivo['error'] === UPLOAD_ERR_INI_SIZE || $archivo['error'] === UPLOAD_ERR_FORM_SIZE) {
            responder("5");
        }
        if ($archivo['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($archivo['tmp_name'])) {
            responder("0");
        }
        if ($archivo['size'] <= 0 || $archivo['size'] > INFORME_MAX_MB * 1024 * 1024) {
            responder("5");
        }

        $extension = strtolower(pathinfo((string)$archivo['name'], PATHINFO_EXTENSION));
        $formatos  = informe_formatos();
        if (!isset($formatos[$extension])) {
            responder("5");
        }
        $firma = $formatos[$extension]['firma'];
        $inicio = (string)@file_get_contents($archivo['tmp_name'], false, null, 0, strlen($firma));
        if ($inicio !== $firma) {
            responder("5");
        }

        return array('tmp'       => $archivo['tmp_name'],
                     'nombre'    => informe_nombre_seguro((string)$archivo['name'], $extension),
                     'extension' => $extension,
                     'tamano'    => (int)$archivo['size']);
    }

    // Nombre original sin rutas ni caracteres de control, para mostrarlo y como nombre de descarga.
    function informe_nombre_seguro($nombre, $extension){
        // Los navegadores envían el nombre en UTF-8; algún programa antiguo de Windows lo envía en Windows-1252.
        if (function_exists('mb_check_encoding') && !mb_check_encoding($nombre, 'UTF-8')) {
            $nombre = mb_convert_encoding($nombre, 'UTF-8', 'Windows-1252');
        }
        $nombre = basename(str_replace('\\', '/', $nombre));
        $nombre = preg_replace('/[\x00-\x1F\x7F"]/u', '', $nombre);
        $nombre = trim((string)$nombre);
        if ($nombre === '' || $nombre === '.' . $extension) {
            $nombre = 'informe.' . $extension;
        }
        return function_exists('mb_substr') ? mb_substr($nombre, 0, 200, 'UTF-8') : substr($nombre, 0, 200);
    }

    // Mueve el archivo a INFORMES_DIR/AAAA/MM/<aleatorio>.<ext>. Devuelve los datos para la base o false.
    function informe_guardar($recibido){
        $subcarpeta = date('Y') . '/' . date('m');
        $carpeta    = rtrim(INFORMES_DIR, '/\\') . '/' . $subcarpeta;
        if (!is_dir($carpeta) && !@mkdir($carpeta, 0750, true)) {
            error_log("[cardiologia] No se pudo crear la carpeta de informes: $carpeta (revise INFORMES_DIR en config.php)");
            return false;
        }
        informe_proteger_carpeta();

        $archivo = $subcarpeta . '/' . bin2hex(random_bytes(16)) . '.' . $recibido['extension'];
        if (!move_uploaded_file($recibido['tmp'], rtrim(INFORMES_DIR, '/\\') . '/' . $archivo)) {
            error_log("[cardiologia] No se pudo guardar el informe en " . INFORMES_DIR);
            return false;
        }
        return array('nombre' => $recibido['nombre'], 'archivo' => $archivo, 'tamano' => $recibido['tamano']);
    }

    // Por si algún día la carpeta queda dentro de htdocs: Apache no la sirve.
    function informe_proteger_carpeta(){
        $htaccess = rtrim(INFORMES_DIR, '/\\') . '/.htaccess';
        if (!is_file($htaccess)) {
            @file_put_contents($htaccess, "Require all denied\n");
        }
    }

    // Ruta completa de un informe guardado; false si no existe o si la ruta intenta salir de INFORMES_DIR.
    function informe_ruta($archivo){
        if (!is_string($archivo) || !preg_match('#^\d{4}/\d{2}/[0-9a-f]{32}\.(pdf|docx?)$#', $archivo)) {
            return false;
        }
        $ruta = rtrim(INFORMES_DIR, '/\\') . '/' . $archivo;
        return is_file($ruta) ? $ruta : false;
    }

    function informe_borrar($archivo){
        $ruta = informe_ruta($archivo);
        if ($ruta !== false) {
            @unlink($ruta);
        }
    }

    // Envía el archivo al navegador. Los PDF se abren en una pestaña; los Word se descargan.
    function informe_enviar($ruta, $nombre){
        $extension = strtolower(pathinfo($ruta, PATHINFO_EXTENSION));
        $formatos  = informe_formatos();

        ini_set('zlib.output_compression', '0'); // el archivo se envía tal cual, con su tamaño exacto
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        $ascii       = preg_replace('/[^A-Za-z0-9._ -]/', '_', $nombre);
        $disposicion = $extension === 'pdf' ? 'inline' : 'attachment';
        header("Content-Type: " . $formatos[$extension]['mime']);
        header("Content-Length: " . filesize($ruta));
        header("Content-Disposition: $disposicion; filename=\"$ascii\"; filename*=UTF-8''" . rawurlencode($nombre));
        header("X-Content-Type-Options: nosniff");
        header("Cache-Control: private, no-store");
        readfile($ruta);
        exit;
    }
?>
