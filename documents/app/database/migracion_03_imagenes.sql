-- =====================================================================
-- MIGRACIÓN 03 - Áreas (departamentos) y módulo de Imágenes
-- Ejecutar DESPUÉS de migracion_02_auditoria.sql: en phpMyAdmin seleccionar la base del sistema y usar la pestaña SQL.
-- Hacer antes un respaldo: phpMyAdmin > Exportar.
-- Compatible con MariaDB 10.4 (XAMPP). Se puede ejecutar más de una vez sin problema.
-- No modifica ni borra ningún dato existente: los usuarios actuales quedan en Cardiología.
-- =====================================================================

-- Los textos con acentos (Imágenes, Ecografía) se guardan bien aunque se ejecute desde la consola.
SET NAMES utf8mb4;


-- 1) ÁREAS
-- Cada usuario pertenece a un área. Los empleados solo ven la suya;
-- los administradores ven todas.
CREATE TABLE IF NOT EXISTS `departamentos` (
    `idDepartamento` INT NOT NULL,
    `departamento`   VARCHAR(50) NOT NULL,
    PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `departamentos` (`idDepartamento`, `departamento`) VALUES
    (1, 'Cardiología'),
    (2, 'Imágenes');

ALTER TABLE `usuarios`
    ADD COLUMN IF NOT EXISTS `idDepartamento` INT NOT NULL DEFAULT 1 AFTER `idRol`,
    ADD INDEX IF NOT EXISTS `idx_departamento` (`idDepartamento`),
    ADD CONSTRAINT `usuarios_ibfk_departamento` FOREIGN KEY IF NOT EXISTS (`idDepartamento`)
        REFERENCES `departamentos` (`idDepartamento`) ON UPDATE CASCADE;


-- 2) TIPOS DE ESTUDIO DE IMÁGENES
-- Catálogo editable desde el sistema (como los médicos). Se cargan algunos tipos comunes;
-- se pueden cambiar o eliminar mientras no tengan estudios registrados.
CREATE TABLE IF NOT EXISTS `tipos_estudio` (
    `idTipoEstudio` INT NOT NULL AUTO_INCREMENT,
    `tipo_estudio`  VARCHAR(150) NOT NULL,
    PRIMARY KEY (`idTipoEstudio`),
    UNIQUE INDEX `uq_tipo_estudio` (`tipo_estudio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `tipos_estudio` (`tipo_estudio`) VALUES
    ('Rayos X'),
    ('Ecografía'),
    ('Tomografía'),
    ('Resonancia magnética'),
    ('Mamografía'),
    ('Densitometría ósea');


-- 3) ESTUDIOS DE IMÁGENES
-- Se registra qué estudio se hizo (no las imágenes). Opcionalmente, el informe médico
-- en PDF o Word: el archivo se guarda en el disco del servidor (INFORMES_DIR en config.php)
-- y aquí solo sus datos.
CREATE TABLE IF NOT EXISTS `imagenes` (
    `idImagen`                   INT NOT NULL AUTO_INCREMENT,
    `idTipoEstudio`              INT NOT NULL,
    `idC_costo`                  INT NOT NULL,
    `idMedico`                   INT NOT NULL,
    `factura_imagen`             VARCHAR(20) NOT NULL DEFAULT '',
    `fecha_imagen`               DATE NOT NULL,
    `nombre_paciente_imagen`     VARCHAR(100) NOT NULL,
    `apellido_paciente_imagen`   VARCHAR(100) NOT NULL,
    `cedula_paciente_imagen`     INT NOT NULL,
    `n_historia_paciente_imagen` INT NOT NULL DEFAULT 0,
    `informe_nombre`             VARCHAR(255) NULL,
    `informe_archivo`            VARCHAR(255) NULL,
    `informe_tamano`             INT NULL,
    `informe_subido_por`         INT NULL,
    `informe_subido_en`          DATETIME NULL,
    `marcado`                    TINYINT(1) NOT NULL DEFAULT 0,
    `marcado_por`                INT NULL,
    `marcado_en`                 DATETIME NULL,
    `creado_por`                 INT NULL,
    `creado_en`                  DATETIME NULL,
    `modificado_por`             INT NULL,
    `modificado_en`              DATETIME NULL,
    `eliminado_por`              INT NULL,
    `eliminado_en`               DATETIME NULL,
    PRIMARY KEY (`idImagen`),
    INDEX `idx_cedula_factura` (`cedula_paciente_imagen`, `factura_imagen`),
    INDEX `idx_cedula` (`cedula_paciente_imagen`),
    INDEX `idx_fecha` (`fecha_imagen`),
    INDEX `idx_eliminado` (`eliminado_en`),
    CONSTRAINT `imagenes_ibfk_tipo`    FOREIGN KEY (`idTipoEstudio`) REFERENCES `tipos_estudio` (`idTipoEstudio`) ON UPDATE CASCADE,
    CONSTRAINT `imagenes_ibfk_c_costo` FOREIGN KEY (`idC_costo`) REFERENCES `c_costo` (`idC_costo`) ON UPDATE CASCADE,
    CONSTRAINT `imagenes_ibfk_medico`  FOREIGN KEY (`idMedico`) REFERENCES `medicos` (`idMedico`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
