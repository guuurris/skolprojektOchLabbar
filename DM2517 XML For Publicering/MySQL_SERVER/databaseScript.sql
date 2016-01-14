SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `kribba_kthproj` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `kribba_kthproj` ;

-- -----------------------------------------------------
-- Table `kribba_kthproj`.`Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kribba_kthproj`.`Category` ;

CREATE TABLE IF NOT EXISTS `kribba_kthproj`.`Category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kribba_kthproj`.`Food`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kribba_kthproj`.`Food` ;

CREATE TABLE IF NOT EXISTS `kribba_kthproj`.`Food` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `difficulty` INT NULL DEFAULT 0,
  `cookingTime` INT NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `xprocedure` VARCHAR(4096) NOT NULL,
  `urlToImage` VARCHAR(45) NULL,
  `category_id` INT NOT NULL,
  `added` TIMESTAMP NOT NULL,
  `portions` DOUBLE NULL,
  `portionType` VARCHAR(20) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Food_Category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_Food_Category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `kribba_kthproj`.`Category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kribba_kthproj`.`Ingredient`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kribba_kthproj`.`Ingredient` ;

CREATE TABLE IF NOT EXISTS `kribba_kthproj`.`Ingredient` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `quanity` DOUBLE NOT NULL,
  `measureUnit` VARCHAR(45) NOT NULL,
  `food_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Ingredient_Food1_idx` (`food_id` ASC),
  CONSTRAINT `fk_Ingredient_Food1`
    FOREIGN KEY (`food_id`)
    REFERENCES `kribba_kthproj`.`Food` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kribba_kthproj`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kribba_kthproj`.`User` ;

CREATE TABLE IF NOT EXISTS `kribba_kthproj`.`User` (
  `id` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kribba_kthproj`.`CategorySubscription`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kribba_kthproj`.`CategorySubscription` ;

CREATE TABLE IF NOT EXISTS `kribba_kthproj`.`CategorySubscription` (
  `category_id` INT NOT NULL,
  `user_id` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`category_id`, `user_id`),
  INDEX `fk_Category_has_User_User1_idx` (`user_id` ASC),
  INDEX `fk_Category_has_User_Category_idx` (`category_id` ASC),
  CONSTRAINT `fk_Category_has_User_Category`
    FOREIGN KEY (`category_id`)
    REFERENCES `kribba_kthproj`.`Category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Category_has_User_User1`
    FOREIGN KEY (`user_id`)
    REFERENCES `kribba_kthproj`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
