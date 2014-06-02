--
-- `user` : User profile
--

CREATE TABLE IF NOT EXISTS `user` (
-- Basic information
    `id`            bigint(20)      NOT NULL AUTO_INCREMENT,
    `email`         varchar(100)    COLLATE utf8_unicode_ci NOT NULL,
    `password`      varchar(80)     COLLATE utf8_unicode_ci NOT NULL,
    `privileges`    int(8)          NOT NULL DEFAULT '0',
-- Common information
    `firstname`     varchar(100)    COLLATE utf8_unicode_ci DEFAULT NULL,
    `lastname`      varchar(100)    COLLATE utf8_unicode_ci DEFAULT NULL,
    `company`       varchar(100)    COLLATE utf8_unicode_ci DEFAULT NULL,
-- Confirmation
    `emailold`      varchar(100)    COLLATE utf8_unicode_ci DEFAULT NULL,
    `secret`        varchar(80)     COLLATE utf8_unicode_ci DEFAULT NULL,
    `secretdate`    bigint(11)      NULL DEFAULT NULL,
-- Status information
    `registerdate`  bigint(11)      NULL DEFAULT NULL,
    `modifydate`    bigint(11)      NULL DEFAULT NULL,
    `lastaccess`    bigint(11)      NULL DEFAULT NULL,
    `deleted`       tinyint(1)      NOT NULL DEFAULT '0',
    `confirmed`     tinyint(1)      NOT NULL DEFAULT '0',
    `dontemailme`   tinyint(1)      NOT NULL DEFAULT '0',
-- Keys and indexes
    PRIMARY KEY (`id`),
    KEY `user_deleted`              (`deleted`),
    KEY `user_deleted_confirmed`    (`deleted`, `confirmed`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

--
-- `license` : License
--

CREATE TABLE IF NOT EXISTS `license` (
    `id`            bigint(20)      NOT NULL AUTO_INCREMENT,
    `label`         varchar(10)     COLLATE utf8_unicode_ci NOT NULL,
-- Metadata
    `name`          varchar(100)    COLLATE utf8_unicode_ci DEFAULT NULL,
    `url`           varchar(256)    COLLATE utf8_unicode_ci DEFAULT NULL,
    `description`   varchar(512)    COLLATE utf8_unicode_ci DEFAULT NULL,
-- Keys and indexes
    PRIMARY KEY (`id`),
    KEY `license_label`             (`label`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

--
-- `compatible` : License compatibility
--
-- type : (S) Static, (D) Dinamic

CREATE TABLE IF NOT EXISTS `compatible` (
    `id`            bigint(20)      NOT NULL AUTO_INCREMENT,
    `left_id`       bigint(20)      NULL DEFAULT NULL,
    `right_id`      bigint(20)      NULL DEFAULT NULL,
-- Compatibility
    `typeleft`      varchar(1)      COLLATE utf8_unicode_ci NOT NULL,
    `typeright`     varchar(1)      COLLATE utf8_unicode_ci NOT NULL,
    `status`        tinyint(1)      NOT NULL DEFAULT '0',
-- Keys and indexes
    PRIMARY KEY (`id`),
    KEY `compatible_license`        (`left_id`, `right_id`, `typeleft`, `typeright`),
    KEY `compatible_licenses`       (`left_id`, `typeleft`, `status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

--
-- `project` : User project
--

CREATE TABLE IF NOT EXISTS `project` (
    `id`            bigint(20)      NOT NULL AUTO_INCREMENT,
    `user_id`       bigint(20)      NOT NULL,
    `name`          varchar(100)    COLLATE utf8_unicode_ci NOT NULL,
-- Metadata
    `website`       varchar(256)    COLLATE utf8_unicode_ci DEFAULT NULL,
    `repo`          varchar(256)    COLLATE utf8_unicode_ci DEFAULT NULL,
-- License
    `license_id`    bigint(20)      NULL DEFAULT NULL,
    `licenseother`  varchar(256)    COLLATE utf8_unicode_ci DEFAULT NULL,
-- Temporal behaviour
    `createdate`    bigint(11)      NULL DEFAULT NULL,
-- Public protection
    `uuid`          varchar(100)    COLLATE utf8_unicode_ci DEFAULT NULL,
-- Keys and indexes
    PRIMARY KEY (`id`),
    KEY `project_user_id`           (`user_id`),
    KEY `project_license_id`        (`license_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

--
-- `module` : Project module (already licensed)
--
-- relation : Relation with project
--  LIB : Library
--  MOD : Module
--  DSN : Design
--  CON : Content
--  IND : Indepedent application
-- type : (S) Static, (D) Dinamic

CREATE TABLE IF NOT EXISTS `module` (
    `id`            bigint(20)      NOT NULL AUTO_INCREMENT,
    `project_id`    bigint(20)      NOT NULL,
    `name`          varchar(100)    COLLATE utf8_unicode_ci NOT NULL,
-- License
    `license_id`    bigint(20)      NULL DEFAULT NULL,
    `licenseother`  varchar(256)    COLLATE utf8_unicode_ci DEFAULT NULL,
-- Metadata
    `website`       varchar(256)    COLLATE utf8_unicode_ci DEFAULT NULL,
    `repo`          varchar(256)    COLLATE utf8_unicode_ci DEFAULT NULL,
    `relation`      varchar(3)      COLLATE utf8_unicode_ci DEFAULT NULL,
    `type`          varchar(1)      COLLATE utf8_unicode_ci NOT NULL,
    `day`           bigint(2)       NULL DEFAULT NULL,
    `month`         bigint(2)       NULL DEFAULT NULL,
    `year`          bigint(4)       NULL DEFAULT NULL,
-- Temporal behaviour
    `createdate`    bigint(11)      NULL DEFAULT NULL,
-- Sort order
    `priority`      bigint(3)       NULL DEFAULT NULL,
-- Keys and indexes
    PRIMARY KEY (`id`),
    KEY `module_project_id`         (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

