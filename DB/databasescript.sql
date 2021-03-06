-- MySQL Script generated by MySQL Workbench
-- Thu Nov 18 14:05:19 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema id17762295_bitacademydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema id17762295_bitacademydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `id17762295_bitacademydb` DEFAULT CHARACTER SET utf8 ;
USE `id17762295_bitacademydb` ;

-- -----------------------------------------------------
-- Table `id17762295_bitacademydb`.`accounts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id17762295_bitacademydb`.`accounts` (
  `First_Name` VARCHAR(255) NOT NULL,
  `Insertion` VARCHAR(255) NOT NULL,
  `Surname` VARCHAR(255) NOT NULL,
  `E-mail_Address` VARCHAR(255) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `Division` VARCHAR(255) NOT NULL,
  `Admin` TINYINT NULL,
  PRIMARY KEY (`Surname`, `E-mail_Address`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id17762295_bitacademydb`.`subjects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id17762295_bitacademydb`.`subjects` (
  `Subject` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Subject`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id17762295_bitacademydb`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id17762295_bitacademydb`.`categories` (
  `Category` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Category`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id17762295_bitacademydb`.`categories_and_subjects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id17762295_bitacademydb`.`categories_and_subjects` (
  `subjects_Subject` VARCHAR(255) NOT NULL,
  `categories_Category` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`subjects_Subject`),
  INDEX `fk_categories_and_subjects_subjects1_idx` (`subjects_Subject` ASC),
  INDEX `fk_categories_and_subjects_categories1_idx` (`categories_Category` ASC),
  CONSTRAINT `fk_categories_and_subjects_subjects1`
    FOREIGN KEY (`subjects_Subject`)
    REFERENCES `id17762295_bitacademydb`.`subjects` (`Subject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categories_and_subjects_categories1`
    FOREIGN KEY (`categories_Category`)
    REFERENCES `id17762295_bitacademydb`.`categories` (`Category`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id17762295_bitacademydb`.`tickets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id17762295_bitacademydb`.`tickets` (
  `Description` VARCHAR(255) NOT NULL,
  `Layer` VARCHAR(45) NOT NULL,
  `Forcast Time` INT NOT NULL,
  `Deadline` DATE NOT NULL,
  `Language` VARCHAR(255) NOT NULL,
  `categories_and_subjects_subjects_Subject` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Description`),
  INDEX `fk_tickets_categories_and_subjects1_idx` (`categories_and_subjects_subjects_Subject` ASC),
  CONSTRAINT `fk_tickets_categories_and_subjects1`
    FOREIGN KEY (`categories_and_subjects_subjects_Subject`)
    REFERENCES `id17762295_bitacademydb`.`categories_and_subjects` (`subjects_Subject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id17762295_bitacademydb`.`plannings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id17762295_bitacademydb`.`plannings` (
  `idplanning` INT NOT NULL AUTO_INCREMENT,
  `Start_Time` DATETIME NOT NULL,
  `Stop_Time` DATETIME NOT NULL,
  `IsFinished` TINYINT NULL,
  `TimeSpent` TIME NULL,
  `tickets_Description` VARCHAR(255) NOT NULL,
  `accounts_Surname` VARCHAR(255) NULL,
  `accounts_E-mail_Address` VARCHAR(255) NULL,
  `deadlineFinished` TINYINT NULL,
  `finishedInTime` TINYINT NULL,
  PRIMARY KEY (`idplanning`),
  INDEX `fk_plannings_tickets1_idx` (`tickets_Description` ASC),
  INDEX `fk_plannings_accounts1_idx` (`accounts_Surname` ASC, `accounts_E-mail_Address` ASC),
  CONSTRAINT `fk_plannings_tickets1`
    FOREIGN KEY (`tickets_Description`)
    REFERENCES `id17762295_bitacademydb`.`tickets` (`Description`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plannings_accounts1`
    FOREIGN KEY (`accounts_Surname` , `accounts_E-mail_Address`)
    REFERENCES `id17762295_bitacademydb`.`accounts` (`Surname` , `E-mail_Address`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
