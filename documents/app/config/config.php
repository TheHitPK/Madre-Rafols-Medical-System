<?php
    /*
     * CONFIGURACIÓN GENERAL DEL SISTEMA
     * Este es el único archivo que hay que tocar al instalar en otro servidor.
     */

    // BASE DE DATOS
    // Se usa 127.0.0.1 y no "localhost": en Windows "localhost" intenta primero IPv6 (::1)
    // y, si MySQL solo escucha en IPv4, cada conexión espera 1-2 segundos antes de reintentar.
    // IMPORTANTE: crear un usuario propio para la aplicación (ver database/migracion_01_seguridad.sql)
    // y dejar de usar root sin contraseña.
    define('DB_HOST', '127.0.0.1');
    define('DB_PORT', 3306);
    define('DB_NAME', 'cardiologia');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    // ZONA HORARIA
    define('APP_TIMEZONE', 'America/Caracas');

    // SESIÓN
    // Minutos de inactividad antes de cerrar la sesión automáticamente (equipos compartidos).
    define('SESSION_TIMEOUT_MINUTES', 480);

    // LOGIN: intentos fallidos permitidos por equipo antes de bloquear temporalmente.
    define('LOGIN_MAX_ATTEMPTS', 5);
    define('LOGIN_LOCK_MINUTES', 10);

    // ROLES (tabla `rol`)
    define('ROL_ADMIN', 1);
    define('ROL_EMPLEADO', 2);

    // ESTADOS (tabla `estado`)
    define('ESTADO_ACTIVO', 1);
    define('ESTADO_INACTIVO', 2);

    // Usuario administrador principal (oculto en la gestión de usuarios, no se puede modificar desde el sistema).
    define('SUPER_ADMIN_ID', 1);

    // Empleados (no administradores) autorizados a ELIMINAR ecos, holters y mapas, por cédula.
    // Antes estaba escrito directamente en las vistas; ahora se valida también en el servidor.
    define('CEDULAS_AUTORIZADAS_ELIMINAR', [28520856]);

    // Longitud mínima de contraseñas nuevas.
    define('PASSWORD_MIN_LENGTH', 6);

    // Versión de los JS/CSS propios. Subir este número al modificarlos para que los
    // navegadores descarguen la versión nueva en vez de usar la que tienen en caché.
    define('ASSET_VERSION', '2026.10.19-2');
?>
