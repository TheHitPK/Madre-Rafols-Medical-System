-- =====================================================================
-- MIGRACIÓN 02 - Auditoría, papelera y marcas compartidas
-- Ejecutar DESPUÉS de migracion_01_seguridad.sql, en phpMyAdmin (pestaña SQL).
-- Hacer antes un respaldo: phpMyAdmin > Exportar.
-- Compatible con MariaDB 10.4 (XAMPP). Se puede ejecutar más de una vez sin problema.
-- No modifica ni borra ningún dato existente: solo agrega columnas, índices y una tabla.
-- =====================================================================

USE `cardiologia`;

-- 1) COLUMNAS DE CONTROL EN LOS ESTUDIOS
--    marcado*    : la marca (checkbox) ahora se guarda en la base y la ven todos los equipos
--    creado*     : quién y cuándo registró el estudio
--    modificado* : última edición
--    eliminado*  : papelera; un estudio "eliminado" se oculta pero se puede restaurar
-- Los registros existentes quedan con estos datos vacíos (no se sabe quién los creó).

ALTER TABLE `ecos`
    ADD COLUMN IF NOT EXISTS `marcado`        TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN IF NOT EXISTS `marcado_por`    INT NULL,
    ADD COLUMN IF NOT EXISTS `marcado_en`     DATETIME NULL,
    ADD COLUMN IF NOT EXISTS `creado_por`     INT NULL,
    ADD COLUMN IF NOT EXISTS `creado_en`      DATETIME NULL,
    ADD COLUMN IF NOT EXISTS `modificado_por` INT NULL,
    ADD COLUMN IF NOT EXISTS `modificado_en`  DATETIME NULL,
    ADD COLUMN IF NOT EXISTS `eliminado_por`  INT NULL,
    ADD COLUMN IF NOT EXISTS `eliminado_en`   DATETIME NULL,
    ADD INDEX IF NOT EXISTS `idx_eliminado` (`eliminado_en`),
    ADD INDEX IF NOT EXISTS `idx_cedula` (`cedula_paciente_eco`);

ALTER TABLE `holters`
    ADD COLUMN IF NOT EXISTS `marcado`        TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN IF NOT EXISTS `marcado_por`    INT NULL,
    ADD COLUMN IF NOT EXISTS `marcado_en`     DATETIME NULL,
    ADD COLUMN IF NOT EXISTS `creado_por`     INT NULL,
    ADD COLUMN IF NOT EXISTS `creado_en`      DATETIME NULL,
    ADD COLUMN IF NOT EXISTS `modificado_por` INT NULL,
    ADD COLUMN IF NOT EXISTS `modificado_en`  DATETIME NULL,
    ADD COLUMN IF NOT EXISTS `eliminado_por`  INT NULL,
    ADD COLUMN IF NOT EXISTS `eliminado_en`   DATETIME NULL,
    ADD INDEX IF NOT EXISTS `idx_eliminado` (`eliminado_en`),
    ADD INDEX IF NOT EXISTS `idx_cedula` (`cedula_paciente_holter`);

ALTER TABLE `mapas`
    ADD COLUMN IF NOT EXISTS `marcado`        TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN IF NOT EXISTS `marcado_por`    INT NULL,
    ADD COLUMN IF NOT EXISTS `marcado_en`     DATETIME NULL,
    ADD COLUMN IF NOT EXISTS `creado_por`     INT NULL,
    ADD COLUMN IF NOT EXISTS `creado_en`      DATETIME NULL,
    ADD COLUMN IF NOT EXISTS `modificado_por` INT NULL,
    ADD COLUMN IF NOT EXISTS `modificado_en`  DATETIME NULL,
    ADD COLUMN IF NOT EXISTS `eliminado_por`  INT NULL,
    ADD COLUMN IF NOT EXISTS `eliminado_en`   DATETIME NULL,
    ADD INDEX IF NOT EXISTS `idx_eliminado` (`eliminado_en`),
    ADD INDEX IF NOT EXISTS `idx_cedula` (`cedula_paciente_mapa`);

-- 2) REGISTRO DE AUDITORÍA
-- Cada alta, edición, eliminación, restauración, cambio de usuario e inicio de sesión.
-- Se guarda el nombre de usuario como texto para que el historial se conserve
-- aunque el usuario se elimine después.
CREATE TABLE IF NOT EXISTS `auditoria` (
    `idAuditoria`   INT NOT NULL AUTO_INCREMENT,
    `fecha`         DATETIME NOT NULL,
    `idUsuario`     INT NULL,
    `usuario`       VARCHAR(20) NULL,
    `accion`        VARCHAR(20) NOT NULL,
    `modulo`        VARCHAR(20) NOT NULL,
    `registro_id`   INT NULL,
    `descripcion`   VARCHAR(255) NOT NULL,
    `datos_antes`   TEXT NULL,
    `datos_despues` TEXT NULL,
    `ip`            VARCHAR(45) NULL,
    PRIMARY KEY (`idAuditoria`),
    INDEX `idx_fecha` (`fecha`),
    INDEX `idx_registro` (`modulo`, `registro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
