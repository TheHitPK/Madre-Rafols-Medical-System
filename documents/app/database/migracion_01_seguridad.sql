-- =====================================================================
-- MIGRACIÓN 2026-10-19 - Seguridad y rendimiento
-- Ejecutar UNA vez en phpMyAdmin: seleccionar la base del sistema a la izquierda y usar la pestaña SQL.
-- Hacer antes un respaldo: phpMyAdmin > Exportar.
-- Compatible con MariaDB 10.4 (XAMPP). Se puede ejecutar más de una vez sin problema.
-- =====================================================================


-- 1) CONTRASEÑAS
-- La columna medía 32 caracteres (MD5). Los hashes seguros (bcrypt) miden 60+.
-- Las contraseñas actuales siguen funcionando: cada usuario pasa a bcrypt
-- automáticamente la próxima vez que inicie sesión.
ALTER TABLE `usuarios` MODIFY `password` VARCHAR(255) NOT NULL;

-- 2) NOMBRE DE USUARIO ÚNICO
-- Evita duplicados aunque dos personas guarden al mismo tiempo.
-- (Si falla, es porque ya hay usuarios repetidos: corregirlos y volver a ejecutar.)
ALTER TABLE `usuarios` ADD UNIQUE INDEX IF NOT EXISTS `uq_usuario` (`usuario`);

-- 3) ÍNDICES PARA BÚSQUEDAS
-- Aceleran la verificación de facturas repetidas y el orden por fecha.
ALTER TABLE `ecos`    ADD INDEX IF NOT EXISTS `idx_cedula_factura` (`cedula_paciente_eco`, `factura_eco`);
ALTER TABLE `ecos`    ADD INDEX IF NOT EXISTS `idx_fecha` (`fecha_eco`);
ALTER TABLE `holters` ADD INDEX IF NOT EXISTS `idx_cedula_factura` (`cedula_paciente_holter`, `factura_holter`);
ALTER TABLE `holters` ADD INDEX IF NOT EXISTS `idx_fecha` (`fecha_holter`);
ALTER TABLE `mapas`   ADD INDEX IF NOT EXISTS `idx_cedula_factura` (`cedula_paciente_mapa`, `factura_mapa`);
ALTER TABLE `mapas`   ADD INDEX IF NOT EXISTS `idx_fecha` (`fecha_mapa`);

-- 4) USUARIO DE BASE DE DATOS PROPIO (recomendado)
-- La aplicación no debería conectarse como root sin contraseña.
-- Quitar los "-- " de las 2 líneas siguientes, cambiar la contraseña, ejecutar,
-- y poner el mismo usuario/contraseña en app/config/config.php (DB_USER / DB_PASS).
--
-- CREATE USER IF NOT EXISTS 'cardiologia_app'@'localhost' IDENTIFIED BY 'CAMBIE_ESTA_CLAVE';
-- GRANT SELECT, INSERT, UPDATE, DELETE ON `cardiologia`.* TO 'cardiologia_app'@'localhost';
--
-- Nota: con DB_HOST = 127.0.0.1 MariaDB identifica la conexión como 'localhost' en XAMPP;
-- si da "Access denied", crear también el usuario como 'cardiologia_app'@'127.0.0.1'.
