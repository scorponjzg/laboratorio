-- MySQL Script generated by MySQL Workbench
-- Thu Nov 15 13:21:17 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema laboratorio
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema laboratorio
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `laboratorio` DEFAULT CHARACTER SET utf8 ;
USE `laboratorio` ;

-- -----------------------------------------------------
-- Table `laboratorio`.`estudioClinico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio`.`estudioClinico` (
  `pk_estudioClinicocol` INT NOT NULL AUTO_INCREMENT,
  `clave` VARCHAR(45) NOT NULL DEFAULT '\"0\"',
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL on UPDATE CURRENT_TIMESTAMP,
  `nombre` VARCHAR(200) NOT NULL DEFAULT 'No se especificó nombre',
  `precio` INT NOT NULL DEFAULT 0,
  `quien_modifico` VARCHAR(100) NOT NULL,
  `tipo_ingreso` VARCHAR(45) NOT NULL COMMENT 'si es el sistema lo metieron mediante la interface si es abierto lo metieron mediante la captura de orden\n',
  PRIMARY KEY (`pk_estudioClinicocol`));


-- -----------------------------------------------------
-- Table `laboratorio`.`unidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio`.`unidad` (
  `pk_unidad` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `direccion` VARCHAR(150) NOT NULL,
  `telefono` VARCHAR(45) NULL,
  `web` VARCHAR(100) NULL,
  `correo` VARCHAR(100) NULL,
  PRIMARY KEY (`pk_unidad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio`.`perfil` (
  `pk_perfil` INT NOT NULL AUTO_INCREMENT,
  `perfil` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`pk_perfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio`.`usuario` (
  `pk_usuario` INT NOT NULL AUTO_INCREMENT,
  `fk_perfil` INT NOT NULL,
  `fk_unidad` INT NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `a_paterno` VARCHAR(50) NOT NULL,
  `a_materno` VARCHAR(50) NULL,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `usuario` VARCHAR(45) NULL,
  `contrasena` VARCHAR(100) NULL,
  PRIMARY KEY (`pk_usuario`, `fk_perfil`, `fk_unidad`),
  INDEX `fk_usuario_unidad1_idx` (`fk_unidad` ASC),
  INDEX `fk_usuario_perfil1_idx` (`fk_perfil` ASC),
  CONSTRAINT `fk_usuario_unidad1`
    FOREIGN KEY (`fk_unidad`)
    REFERENCES `laboratorio`.`unidad` (`pk_unidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_perfil1`
    FOREIGN KEY (`fk_perfil`)
    REFERENCES `laboratorio`.`perfil` (`pk_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio`.`orden`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio`.`orden` (
  `pk_orden` INT NOT NULL AUTO_INCREMENT,
  `a_paterno_paciente` VARCHAR(45) NOT NULL,
  `a_materno_paciente` VARCHAR(45) NULL,
  `nombre_paciente` VARCHAR(80) NOT NULL,
  `edad` INT NOT NULL,
  `sexo` VARCHAR(10) NOT NULL,
  `fecha_ingreso` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_impresion` TIMESTAMP NULL,
  `estatus` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'actuiva=1\ncancelada=0',
  `fk_usuario` INT NOT NULL COMMENT 'el usuario con la sesión activa en el sistema.',
  `fk_unidad` INT NOT NULL,
  PRIMARY KEY (`pk_orden`),
  INDEX `fk_orden_usuario1_idx` (`fk_usuario` ASC),
  INDEX `fk_orden_unidad1_idx` (`fk_unidad` ASC),
  CONSTRAINT `fk_orden_usuario1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `laboratorio`.`usuario` (`pk_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_unidad1`
    FOREIGN KEY (`fk_unidad`)
    REFERENCES `laboratorio`.`unidad` (`pk_unidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio`.`estudio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio`.`estudio` (
  `fk_estudioClinicocol` INT NOT NULL,
  `fk_orden` INT NOT NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'si se cancela el estudio o se equivocó cambia a 0',
  PRIMARY KEY (`fk_estudioClinicocol`, `fk_orden`),
  INDEX `fk_estudioClinico_has_orden_orden1_idx` (`fk_orden` ASC),
  INDEX `fk_estudioClinico_has_orden_estudioClinico_idx` (`fk_estudioClinicocol` ASC),
  CONSTRAINT `fk_estudioClinico_has_orden_estudioClinico`
    FOREIGN KEY (`fk_estudioClinicocol`)
    REFERENCES `laboratorio`.`estudioClinico` (`pk_estudioClinicocol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estudioClinico_has_orden_orden1`
    FOREIGN KEY (`fk_orden`)
    REFERENCES `laboratorio`.`orden` (`pk_orden`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `laboratorio`.`log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio`.`log` (
  `pk_log` INT NOT NULL AUTO_INCREMENT,
  `acciona` VARCHAR(300) NOT NULL,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_usuario` INT NOT NULL,
  PRIMARY KEY (`pk_log`),
  INDEX `fk_log_usuario1_idx` (`fk_usuario` ASC),
  CONSTRAINT `fk_log_usuario1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `laboratorio`.`usuario` (`pk_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio`.`modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio`.`modulo` (
  `pk_modulo` INT NOT NULL AUTO_INCREMENT,
  `modulo` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`pk_modulo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio`.`permiso` (
  `fk_perfil` INT NOT NULL,
  `ver` TINYINT(1) NOT NULL DEFAULT 0,
  `editar` TINYINT(1) NOT NULL DEFAULT 0,
  `eliminar` TINYINT(1) NOT NULL DEFAULT 0,
  `crear` TINYINT(1) NOT NULL DEFAULT 0,
  `fk_modulo` INT NOT NULL,
  PRIMARY KEY (`fk_perfil`),
  INDEX `fk_modulo_has_perfil_perfil1_idx` (`fk_perfil` ASC),
  INDEX `fk_modulo_has_perfil_modulo1_idx` (`fk_modulo` ASC),
  CONSTRAINT `fk_modulo_has_perfil_perfil1`
    FOREIGN KEY (`fk_perfil`)
    REFERENCES `laboratorio`.`perfil` (`pk_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_has_perfil_modulo1`
    FOREIGN KEY (`fk_modulo`)
    REFERENCES `laboratorio`.`modulo` (`pk_modulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

CREATE USER 'laboratorio'@'localhost' IDENTIFIED BY '#vivilab#';

GRANT ALL PRIVILEGES ON laboratorio.* TO 'laboratorio'@'localhost';

FLUSH PRIVILEGES;

