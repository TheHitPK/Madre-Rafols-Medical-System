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
    // Base en uso. La base "cardiologia" (respaldo de 2023) se conserva aparte; para volver a ella, cambiar este nombre.
    define('DB_NAME', 'cardiologia_original');
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

    // ÁREAS (tabla `departamentos`). Los empleados solo ven su área; los administradores, todas.
    define('AREA_CARDIOLOGIA', 1);
    define('AREA_IMAGENES', 2);

    // INFORMES MÉDICOS DE IMÁGENES (PDF o Word)
    // Carpeta donde se guardan los archivos. Debe estar FUERA de htdocs para que nadie pueda
    // abrirlos con un enlace directo: solo se descargan a través del sistema, que revisa los permisos.
    // Se crea sola la primera vez. Incluirla en los respaldos junto con la base de datos.
    define('INFORMES_DIR', 'C:/xampp/informes_imagenes');
    define('INFORME_MAX_MB', 20);

    // ESTADOS (tabla `estado`)
    define('ESTADO_ACTIVO', 1);
    define('ESTADO_INACTIVO', 2);

    // Super administradores: ocultos en la gestión de usuarios; nadie puede editarlos, desactivarlos ni eliminarlos desde el sistema.
    // 1 = admin, 26033 = sistema
    define('SUPER_ADMIN_IDS', [1, 26033]);

    // Empleados (no administradores) autorizados a ELIMINAR ecos, holters y mapas, por cédula.
    // Antes estaba escrito directamente en las vistas; ahora se valida también en el servidor.
    define('CEDULAS_AUTORIZADAS_ELIMINAR', [28520856]);

    // Longitud mínima de contraseñas nuevas.
    define('PASSWORD_MIN_LENGTH', 6);

    // Versión de los JS/CSS propios. Subir este número al modificarlos para que los
    // navegadores descarguen la versión nueva en vez de usar la que tienen en caché.
    define('ASSET_VERSION', '2026.10.20-imagenes');
?>
