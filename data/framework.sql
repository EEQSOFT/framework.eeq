
SET NAMES 'utf8mb4';

CREATE DATABASE IF NOT EXISTS `framework` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `framework`;

CREATE TABLE IF NOT EXISTS `user` (
    `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_admin` TINYINT NOT NULL DEFAULT 0,
    `user_active` TINYINT NOT NULL DEFAULT 1,
    `user_login` VARCHAR(20) NOT NULL DEFAULT '',
    `user_login_canonical` VARCHAR(20) NOT NULL DEFAULT '',
    `user_email` VARCHAR(100) NOT NULL DEFAULT '',
    `user_email_canonical` VARCHAR(100) NOT NULL DEFAULT '',
    `user_password` VARCHAR(255) NOT NULL DEFAULT '',
    `user_key` VARCHAR(255) NOT NULL DEFAULT '',
    `user_ip_added` VARCHAR(15) NOT NULL DEFAULT '',
    `user_date_added` DATETIME NOT NULL DEFAULT '1970-01-01 00:00:00',
    `user_ip_updated` VARCHAR(15) NOT NULL DEFAULT '',
    `user_date_updated` DATETIME NOT NULL DEFAULT '1970-01-01 00:00:00',
    `user_ip_loged` VARCHAR(15) NOT NULL DEFAULT '',
    `user_date_loged` DATETIME NOT NULL DEFAULT '1970-01-01 00:00:00',
    PRIMARY KEY (`user_id`),
    UNIQUE KEY `unique_login_canonical` (`user_login_canonical`),
    UNIQUE KEY `unique_email_canonical` (`user_email_canonical`),
--  KEY `user_id` (`user_id`),
--  KEY `user_admin` (`user_admin`),
--  KEY `user_active` (`user_active`),
--  KEY `user_login` (`user_login`),
--  KEY `user_login_canonical` (`user_login_canonical`),
--  KEY `user_email` (`user_email`),
--  KEY `user_email_canonical` (`user_email_canonical`),
    KEY `user_password` (`user_password`)
--  KEY `user_key` (`user_key`),
--  KEY `user_ip_added` (`user_ip_added`),
--  KEY `user_date_added` (`user_date_added`),
--  KEY `user_ip_updated` (`user_ip_updated`),
--  KEY `user_date_updated` (`user_date_updated`),
--  KEY `user_ip_loged` (`user_ip_loged`),
--  KEY `user_date_loged` (`user_date_loged`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`user_id`, `user_admin`, `user_active`, `user_login`, `user_login_canonical`, `user_email`, `user_email_canonical`, `user_password`, `user_key`) VALUES
(1, 0, 1, 'User', 'user', 'user@framework.eeq', 'user@framework.eeq', '', ''),
(2, 1, 1, 'Admin', 'admin', 'admin@framework.eeq', 'admin@framework.eeq', '', ''),

CREATE TABLE IF NOT EXISTS `language` (
    `language_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `language_prefix` VARCHAR(2) NOT NULL DEFAULT '',
    `language_name` VARCHAR(30) NOT NULL DEFAULT '',
    PRIMARY KEY (`language_id`),
--  KEY `language_id` (`language_id`),
    KEY `language_prefix` (`language_prefix`),
    KEY `language_name` (`language_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `language` (`language_id`, `language_prefix`, `language_name`) VALUES
(1, 'en', 'English'),
(2, 'pl', 'Polish');
