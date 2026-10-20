<?php
    /*
     * PUNTO DE ARRANQUE COMÚN
     * Todas las vistas y controladores lo incluyen primero:
     *   require_once __DIR__ . "/../../core/bootstrap.php";
     */
    require_once __DIR__ . "/../config/config.php";

    date_default_timezone_set(APP_TIMEZONE);

    // Los errores se registran en el log de PHP/Apache, nunca se muestran al usuario
    // (mostrarlos revela rutas, consultas y datos internos).
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');

    // Comprime las respuestas (HTML de tablas, JSON) con gzip si el navegador lo admite:
    // una tabla de cientos de filas pasa de cientos de KB a unas decenas.
    if (!headers_sent() && extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
        ini_set('zlib.output_compression', '1');
    }

    require_once __DIR__ . "/../models/Connection.php";
    require_once __DIR__ . "/request.php";
    require_once __DIR__ . "/session.php";

    // Cualquier error no controlado (p. ej. la base de datos caída) termina aquí:
    // se registra el detalle y el front recibe "0", que ya interpreta como error.
    set_exception_handler(function($exception){
        error_log("[cardiologia] " . $exception);
        // 42S22 = columna inexistente, 42S02 = tabla inexistente: la base no tiene las migraciones al día.
        if ($exception instanceof PDOException && in_array($exception -> getCode(), array('42S22', '42S02'), true)) {
            error_log("[cardiologia] FALTA EJECUTAR UNA MIGRACIÓN: revise app/database/migracion_*.sql (ver README.md)");
        }
        if (!headers_sent()) {
            http_response_code(500);
        }
        echo es_peticion_ajax() ? "0" : "Ocurrió un error en el sistema. Contacte al administrador.";
    });
?>
