SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mattesEnterprise` DEFAULT CHARACTER SET utf8 ;
USE `mattesEnterprise` ;

-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Cliente` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `No_Identidad` VARCHAR(13) NULL,
  `Nombre` VARCHAR(45) NULL,
  `Apellido` VARCHAR(45) NULL,
  `Telefono_Personal` VARCHAR(45) NULL,
  `Telefono_Trabajo` VARCHAR(45) NULL,
  `Direccion` VARCHAR(255) NULL,
  `E_mail` VARCHAR(45) NULL,
  `Sexo` TINYINT(1) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `Activo` TINYINT(1) NULL DEFAULT true,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `No_Identidad_UNIQUE` (`No_Identidad` ASC),
  UNIQUE INDEX `E-mail_UNIQUE` (`E_mail` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Unidad_Medida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Unidad_Medida` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Material` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NULL,
  `Cantidad` INT(11) NULL,
  `Unidad_Medida` VARCHAR(45) NULL,
  `Costo_Unitario` FLOAT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `Unidad_Medida_Id` INT NOT NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_Material_Unidad_Medida_idx` (`Unidad_Medida_Id` ASC),
  CONSTRAINT `fk_Material_Unidad_Medida`
    FOREIGN KEY (`Unidad_Medida_Id`)
    REFERENCES `mattesEnterprise`.`Unidad_Medida` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Producto` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NULL,
  `Cantidad` INT(11) NULL,
  `Costo_Unitario` FLOAT NULL,
  `Precio_Unitario` FLOAT NULL,
  `Descripcion` VARCHAR(140) NULL,
  `Activo` TINYINT(1) NULL DEFAULT true,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Venta` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Subtotal` FLOAT NULL,
  `ISV` FLOAT NULL,
  `Total` FLOAT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `Cliente_Id` INT NOT NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_Venta_Cliente1_idx` (`Cliente_Id` ASC),
  CONSTRAINT `fk_Venta_Cliente1`
    FOREIGN KEY (`Cliente_Id`)
    REFERENCES `mattesEnterprise`.`Cliente` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Devolucion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Devolucion` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Producto_has_Material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Producto_has_Material` (
  `Producto_Id` INT NOT NULL,
  `Material_Id` INT NOT NULL,
  `Cantidad_Utilizada` INT(11) NULL,
  PRIMARY KEY (`Producto_Id`, `Material_Id`),
  INDEX `fk_Producto_has_Material_Material1_idx` (`Material_Id` ASC),
  INDEX `fk_Producto_has_Material_Producto1_idx` (`Producto_Id` ASC),
  CONSTRAINT `fk_Producto_has_Material_Producto1`
    FOREIGN KEY (`Producto_Id`)
    REFERENCES `mattesEnterprise`.`Producto` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Producto_has_Material_Material1`
    FOREIGN KEY (`Material_Id`)
    REFERENCES `mattesEnterprise`.`Material` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Venta_has_Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Venta_has_Producto` (
  `Venta_Id` INT NOT NULL,
  `Producto_Id` INT NOT NULL,
  `Cantidad` INT(11) NULL,
  `Precio_Unitario` FLOAT NULL,
  PRIMARY KEY (`Venta_Id`, `Producto_Id`),
  INDEX `fk_Venta_has_Producto_Producto1_idx` (`Producto_Id` ASC),
  INDEX `fk_Venta_has_Producto_Venta1_idx` (`Venta_Id` ASC),
  CONSTRAINT `fk_Venta_has_Producto_Venta1`
    FOREIGN KEY (`Venta_Id`)
    REFERENCES `mattesEnterprise`.`Venta` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venta_has_Producto_Producto1`
    FOREIGN KEY (`Producto_Id`)
    REFERENCES `mattesEnterprise`.`Producto` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Venta_has_Devolucion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Venta_has_Devolucion` (
  `Venta_Id` INT NOT NULL,
  `Devolucion_Id` INT NOT NULL,
  `Producto_Id` INT NOT NULL,
  PRIMARY KEY (`Venta_Id`, `Devolucion_Id`),
  INDEX `fk_Venta_has_Devolucion_Devolucion1_idx` (`Devolucion_Id` ASC),
  INDEX `fk_Venta_has_Devolucion_Venta1_idx` (`Venta_Id` ASC),
  INDEX `fk_Venta_has_Devolucion_Producto1_idx` (`Producto_Id` ASC),
  CONSTRAINT `fk_Venta_has_Devolucion_Venta1`
    FOREIGN KEY (`Venta_Id`)
    REFERENCES `mattesEnterprise`.`Venta` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venta_has_Devolucion_Devolucion1`
    FOREIGN KEY (`Devolucion_Id`)
    REFERENCES `mattesEnterprise`.`Devolucion` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venta_has_Devolucion_Producto1`
    FOREIGN KEY (`Producto_Id`)
    REFERENCES `mattesEnterprise`.`Producto` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mattesEnterprise`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mattesEnterprise`.`Usuario` (
  `username` VARCHAR(16) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `Cliente_Id` INT NULL,
  `role` INT(11) NULL DEFAULT '2',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`username`),
  UNIQUE INDEX `Cliente_Id_UNIQUE` (`Cliente_Id` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mattesEnterprise`.`Unidad_Medida`
-- -----------------------------------------------------
START TRANSACTION;
USE `mattesEnterprise`;
INSERT INTO `mattesEnterprise`.`Unidad_Medida` (`Id`, `Nombre`) VALUES (1, 'Pie');
INSERT INTO `mattesEnterprise`.`Unidad_Medida` (`Id`, `Nombre`) VALUES (2, 'Metro');
INSERT INTO `mattesEnterprise`.`Unidad_Medida` (`Id`, `Nombre`) VALUES (3, 'Yarda');
INSERT INTO `mattesEnterprise`.`Unidad_Medida` (`Id`, `Nombre`) VALUES (4, 'Centimetro');
INSERT INTO `mattesEnterprise`.`Unidad_Medida` (`Id`, `Nombre`) VALUES (5, 'Pulgada');

COMMIT;

