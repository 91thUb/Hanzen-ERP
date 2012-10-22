SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `erp` DEFAULT CHARACTER SET latin1 ;
USE `erp` ;

-- -----------------------------------------------------
-- Table `erp`.`hnz_computers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `erp`.`hnz_computers` (
  `id_computer` INT(11) NOT NULL AUTO_INCREMENT ,
  `ip` VARCHAR(32) NOT NULL ,
  `device_name` VARCHAR(30) NOT NULL ,
  `active` INT(1) NOT NULL ,
  PRIMARY KEY (`id_computer`) ,
  UNIQUE INDEX `ip` (`ip` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `erp`.`hnz_folders`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `erp`.`hnz_folders` (
  `id_folder` INT NOT NULL ,
  `folder_name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_folder`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`hnz_modules`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `erp`.`hnz_modules` (
  `id_module` VARCHAR(6) NOT NULL ,
  `module_name` VARCHAR(45) NOT NULL ,
  `active` INT(1) NOT NULL ,
  `folder_id` INT NOT NULL ,
  PRIMARY KEY (`id_module`) ,
  INDEX `fk_hanz_modules_folders_idx` (`folder_id` ASC) ,
  CONSTRAINT `fk_hanz_modules_folders`
    FOREIGN KEY (`folder_id` )
    REFERENCES `erp`.`hnz_folders` (`id_folder` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`hnz_config`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `erp`.`hnz_config` (
  `id_config` INT(6) NOT NULL AUTO_INCREMENT ,
  `note` VARCHAR(255) NOT NULL ,
  `name` VARCHAR(20) NOT NULL ,
  `val` VARCHAR(255) NOT NULL ,
  `module_id` VARCHAR(6) NOT NULL ,
  PRIMARY KEY (`id_config`) ,
  INDEX `fk_hnz_config_hanz_modules1_idx` (`module_id` ASC) ,
  CONSTRAINT `fk_hnz_config_hanz_modules1`
    FOREIGN KEY (`module_id` )
    REFERENCES `erp`.`hnz_modules` (`id_module` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `erp`.`hnz_sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `erp`.`hnz_sessions` (
  `session_id` VARCHAR(40) NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(45) NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(120) NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `user_data` TEXT NOT NULL ,
  PRIMARY KEY (`session_id`) ,
  INDEX `last_activity_idx` (`last_activity` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `erp`.`hnz_user_groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `erp`.`hnz_user_groups` (
  `id_user_group` INT(4) NOT NULL ,
  `group_name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_user_group`) ,
  UNIQUE INDEX `group_name_UNIQUE` (`group_name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`hnz_users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `erp`.`hnz_users` (
  `id_user` INT(6) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(20) NOT NULL ,
  `password` VARCHAR(35) NOT NULL ,
  `last_login` INT(12) NOT NULL ,
  `last_ip` VARCHAR(25) NOT NULL ,
  `created` INT(12) NOT NULL ,
  `error_login` INT(2) NOT NULL ,
  `language` VARCHAR(2) NOT NULL ,
  `active` INT(1) NOT NULL ,
  `ping` INT(15) NULL ,
  `user_group_id` INT(4) NOT NULL ,
  PRIMARY KEY (`id_user`) ,
  UNIQUE INDEX `username` (`username` ASC) ,
  INDEX `fk_hnz_users_hnz_user_groups1_idx` (`user_group_id` ASC) ,
  CONSTRAINT `fk_hnz_users_hnz_user_groups1`
    FOREIGN KEY (`user_group_id` )
    REFERENCES `erp`.`hnz_user_groups` (`id_user_group` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `erp`.`hnz_transaction_history`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `erp`.`hnz_transaction_history` (
  `date` INT(14) NOT NULL ,
  `info` VARCHAR(255) NULL ,
  `referance_id` VARCHAR(20) NOT NULL ,
  `users_id` INT(6) NOT NULL ,
  `module_id` VARCHAR(6) NOT NULL ,
  PRIMARY KEY (`date`) ,
  INDEX `fk_hnz_transaction_history_hnz_users1_idx` (`users_id` ASC) ,
  INDEX `fk_hnz_transaction_history_hanz_modules1_idx` (`module_id` ASC) ,
  CONSTRAINT `fk_hnz_transaction_history_hnz_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `erp`.`hnz_users` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hnz_transaction_history_hanz_modules1`
    FOREIGN KEY (`module_id` )
    REFERENCES `erp`.`hnz_modules` (`id_module` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`hnz_permissions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `erp`.`hnz_permissions` (
  `user_group_id` INT(4) NOT NULL ,
  `module_id` VARCHAR(6) NOT NULL ,
  INDEX `fk_hnz_permissions_hnz_user_groups1_idx` (`user_group_id` ASC) ,
  INDEX `fk_hnz_permissions_hnz_modules1_idx` (`module_id` ASC) ,
  CONSTRAINT `fk_hnz_permissions_hnz_user_groups1`
    FOREIGN KEY (`user_group_id` )
    REFERENCES `erp`.`hnz_user_groups` (`id_user_group` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hnz_permissions_hnz_modules1`
    FOREIGN KEY (`module_id` )
    REFERENCES `erp`.`hnz_modules` (`id_module` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
