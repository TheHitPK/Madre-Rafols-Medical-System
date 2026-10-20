<?php
    /*
     * SESIÓN, AUTENTICACIÓN, PERMISOS Y CSRF
     *
     * Vistas (páginas completas):      requerir_login_pagina();   requerir_admin_pagina();   requerir_area_pagina(AREA_...);
     * Controladores que leen datos:    api_lectura();
     * Controladores que modifican:     api_escritura();           requerir_admin_api();      requerir_area_api(AREA_...);
     */

    function iniciar_sesion($soloLectura = false){
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }
        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');
        session_set_cookie_params(array(
            'lifetime' => 0,
            'path'     => '/',
            'secure'   => es_https(), // con HTTPS, la cookie nunca viaja sin cifrar
            'httponly' => true,      // JavaScript no puede leer la cookie de sesión
            'samesite' => 'Strict'   // el navegador no la envía desde otros sitios
        ));
        // read_and_close libera la sesión al instante: así las peticiones simultáneas
        // (contadores del dashboard, tablas) no se bloquean esperando unas a otras.
        session_start($soloLectura ? array('read_and_close' => true) : array());
    }

    function es_https(){
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443);
    }

    function sesion_valida(){
        if (empty($_SESSION['idUsuario'])) {
            return false;
        }
        $ultimaActividad = isset($_SESSION['ultima_actividad']) ? $_SESSION['ultima_actividad'] : 0;
        if ((time() - $ultimaActividad) > SESSION_TIMEOUT_MINUTES * 60) {
            return false;
        }

        // El usuario debe seguir existiendo y activo: si un administrador lo desactiva o elimina,
        // pierde el acceso de inmediato. Un cambio de rol o de área también se aplica al instante.
        $query_usuario = Connection::connect() -> prepare("SELECT idEstado, idRol, idDepartamento FROM usuarios WHERE idUsuario = :idUsuario");
        $query_usuario -> bindValue(":idUsuario", (int)$_SESSION['idUsuario'], PDO::PARAM_INT);
        $query_usuario -> execute();
        $usuario = $query_usuario -> fetch(PDO::FETCH_ASSOC);
        if (!$usuario || (int)$usuario['idEstado'] !== ESTADO_ACTIVO) {
            return false;
        }
        $_SESSION['idRol']          = (int)$usuario['idRol'];
        $_SESSION['idDepartamento'] = (int)$usuario['idDepartamento'];
        return true;
    }

    function registrar_actividad(){
        $_SESSION['ultima_actividad'] = time();
    }

    function abrir_sesion_usuario($usuario){
        session_regenerate_id(true); // evita fijación de sesión
        $_SESSION = array();
        $_SESSION['idUsuario']        = (int)$usuario['idUsuario'];
        $_SESSION['idEstado']         = (int)$usuario['idEstado'];
        $_SESSION['estado']           = $usuario['estado'];
        $_SESSION['idRol']            = (int)$usuario['idRol'];
        $_SESSION['rol']              = $usuario['rol'];
        $_SESSION['idDepartamento']   = (int)$usuario['idDepartamento'];
        $_SESSION['departamento']     = $usuario['departamento'];
        $_SESSION['nombre_usuario']   = $usuario['nombre_usuario'];
        $_SESSION['apellido_usuario'] = $usuario['apellido_usuario'];
        $_SESSION['cedula_usuario']   = (int)$usuario['cedula_usuario'];
        $_SESSION['usuario']          = $usuario['usuario'];
        $_SESSION['csrf_token']       = bin2hex(random_bytes(32));
        registrar_actividad();
    }

    function cerrar_sesion(){
        iniciar_sesion();
        $_SESSION = array();
        if (ini_get('session.use_cookies')) {
            $parametros = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $parametros['path'], $parametros['domain'], $parametros['secure'], $parametros['httponly']);
        }
        session_destroy();
    }

    // ---------- PÁGINAS ----------

    function requerir_login_pagina(){
        iniciar_sesion();
        if (!sesion_valida()) {
            cerrar_sesion();
            header("Location: ../../../index.php");
            exit;
        }
        registrar_actividad();
    }

    function requerir_admin_pagina(){
        if (!es_admin()) {
            header("Location: error.php");
            exit;
        }
    }

    // Páginas de un área (Cardiología, Imágenes): los empleados de otra área ven "Acceso denegado".
    function requerir_area_pagina($area){
        if (!puede_ver_area($area)) {
            header("Location: error.php");
            exit;
        }
    }

    // ---------- CONTROLADORES / FRAGMENTOS AJAX ----------

    function api_lectura(){
        iniciar_sesion(true);
        if (!sesion_valida()) {
            responder("SESION_EXPIRADA", 401);
        }
    }

    function api_escritura(){
        requerir_post();
        iniciar_sesion();
        if (!sesion_valida()) {
            responder("SESION_EXPIRADA", 401);
        }
        verificar_csrf();
        registrar_actividad();
        session_write_close(); // libera la sesión mientras se ejecuta la consulta
    }

    function requerir_admin_api(){
        if (!es_admin()) {
            responder("SIN_PERMISO", 403);
        }
    }

    function requerir_area_api($area){
        if (!puede_ver_area($area)) {
            responder("SIN_PERMISO", 403);
        }
    }

    // ---------- PERMISOS ----------

    function es_admin(){
        return isset($_SESSION['idRol']) && (int)$_SESSION['idRol'] === ROL_ADMIN;
    }

    // Super administradores (config.php): nadie puede editarlos, desactivarlos ni eliminarlos desde el sistema.
    function es_super_admin($idUsuario){
        return in_array((int)$idUsuario, array_map('intval', SUPER_ADMIN_IDS), true);
    }

    function area_usuario(){
        return isset($_SESSION['idDepartamento']) ? (int)$_SESSION['idDepartamento'] : AREA_CARDIOLOGIA;
    }

    // Los administradores ven todas las áreas; los empleados, solo la suya.
    function puede_ver_area($area){
        return es_admin() || area_usuario() === (int)$area;
    }

    function areas_visibles(){
        return array_values(array_filter(array(AREA_CARDIOLOGIA, AREA_IMAGENES), 'puede_ver_area'));
    }

    // Nombre que se muestra en el título de las páginas: el área del empleado, o el del sistema para los administradores.
    function nombre_sistema(){
        return (!es_admin() && area_usuario() === AREA_IMAGENES) ? 'Imágenes' : 'Cardiología';
    }

    function usuario_actual_id(){
        return isset($_SESSION['idUsuario']) ? (int)$_SESSION['idUsuario'] : 0;
    }

    // Eliminar ecos, holters y mapas: administradores y las cédulas autorizadas en config.php
    function puede_eliminar_estudios(){
        if (es_admin()) {
            return true;
        }
        $cedula = isset($_SESSION['cedula_usuario']) ? (int)$_SESSION['cedula_usuario'] : 0;
        return in_array($cedula, CEDULAS_AUTORIZADAS_ELIMINAR, true);
    }

    // ---------- CSRF ----------
    // Cada sesión tiene un token secreto. El front lo envía en la cabecera X-CSRF-Token
    // (configurado una sola vez en assets/js/scripts/app.js); una página de otro sitio no puede conocerlo.

    function csrf_token(){
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    function verificar_csrf(){
        $enviado = isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : (isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '');
        if (empty($_SESSION['csrf_token']) || !is_string($enviado) || !hash_equals($_SESSION['csrf_token'], $enviado)) {
            responder("CSRF", 403);
        }
    }

    // ---------- LÍMITE DE INTENTOS DE LOGIN ----------
    // Se guarda por dirección IP en la carpeta temporal del servidor.

    function archivo_intentos_login(){
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'desconocida';
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . "cardiologia_login_" . md5($ip) . ".json";
    }

    function leer_intentos_login(){
        $archivo = archivo_intentos_login();
        if (!is_file($archivo)) {
            return array('fallos' => 0, 'desde' => time());
        }
        $datos = json_decode((string)@file_get_contents($archivo), true);
        if (!is_array($datos) || (time() - $datos['desde']) > LOGIN_LOCK_MINUTES * 60) {
            return array('fallos' => 0, 'desde' => time());
        }
        return $datos;
    }

    function login_bloqueado(){
        $datos = leer_intentos_login();
        return $datos['fallos'] >= LOGIN_MAX_ATTEMPTS;
    }

    function registrar_fallo_login(){
        $datos = leer_intentos_login();
        $datos['fallos']++;
        @file_put_contents(archivo_intentos_login(), json_encode($datos), LOCK_EX);
    }

    function limpiar_fallos_login(){
        @unlink(archivo_intentos_login());
    }
?>
