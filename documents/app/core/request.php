<?php
    /*
     * LECTURA Y VALIDACIÓN DE DATOS DE ENTRADA / SALIDA SEGURA
     */

    // Escapa texto antes de imprimirlo en HTML (evita XSS). Usar SIEMPRE al hacer echo de datos.
    function e($value){
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }

    function es_peticion_ajax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    // Termina la petición con un código HTTP y una respuesta corta.
    function responder($respuesta, $codigoHttp = 200){
        if (!headers_sent()) {
            http_response_code($codigoHttp);
        }
        echo $respuesta;
        exit;
    }

    function requerir_post(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            responder("METODO_NO_PERMITIDO", 405);
        }
    }

    // Texto recortado; cadena vacía si no viene.
    function post_texto($clave, $longitudMaxima = 100){
        $valor = isset($_POST[$clave]) ? trim((string)$_POST[$clave]) : '';
        if (function_exists('mb_substr')) {
            return mb_substr($valor, 0, $longitudMaxima, 'UTF-8');
        }
        return substr($valor, 0, $longitudMaxima);
    }

    // Entero positivo (ids, cédulas); null si no es válido.
    function post_entero($clave){
        $valor = isset($_POST[$clave]) ? trim((string)$_POST[$clave]) : '';
        if ($valor === '' || !ctype_digit($valor) || strlen($valor) > 10 || (int)$valor > 2147483647) {
            return null; // 2147483647 = máximo de una columna INT
        }
        return (int)$valor;
    }

    // Entero opcional: vacío equivale a 0 (como se guardaba antes en la base de datos).
    function post_entero_opcional($clave){
        $valor = isset($_POST[$clave]) ? trim((string)$_POST[$clave]) : '';
        if ($valor === '') {
            return 0;
        }
        return post_entero($clave);
    }

    // Fecha en formato AAAA-MM-DD; null si no es válida.
    function post_fecha($clave){
        $valor = isset($_POST[$clave]) ? trim((string)$_POST[$clave]) : '';
        $fecha = DateTime::createFromFormat('!Y-m-d', $valor);
        if ($fecha === false || $fecha -> format('Y-m-d') !== $valor) {
            return null;
        }
        return $valor;
    }

    // Devuelve true si ningún valor del arreglo es null o cadena vacía.
    function campos_completos($datos){
        foreach ($datos as $valor) {
            if ($valor === null || $valor === '') {
                return false;
            }
        }
        return true;
    }
?>
