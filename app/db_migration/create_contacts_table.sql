CREATE TABLE `cake2_training`.`contacts` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL ,
	`gender` CHAR(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL ,
	`email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL ,
	`contact_type` TINYINT NOT NULL ,
	`content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL ,
	`confirm_privacy_policy` TINYINT NOT NULL , PRIMARY KEY  (`id`)
) ENGINE = InnoDB;