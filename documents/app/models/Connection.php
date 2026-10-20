<?php
    require_once __DIR__ . "/../config/config.php";

    class Connection{
        private static $connection = null;

        // Una sola conexión por petición, reutilizada por todas las consultas.
        public static function connect(){
            if (self::$connection === null) {
                $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                self::$connection = new PDO($dsn, DB_USER, DB_PASS, array(
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH
                ));
            }
            return self::$connection;
        }
    }
?>
