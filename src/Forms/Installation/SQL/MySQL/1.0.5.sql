SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

ALTER TABLE `pc_forms_content_textfield` ADD `MinLength` SMALLINT UNSIGNED NOT NULL AFTER `Required`;

ALTER TABLE `pc_forms_content_textarea` ADD `MinLength` SMALLINT UNSIGNED NOT NULL AFTER `Required`, ADD `MaxLength` SMALLINT UNSIGNED NOT NULL AFTER `MinLength`, ADD `Pattern` VARCHAR(255) NOT NULL AFTER `MaxLength`;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_content_numberfield`
--

CREATE TABLE IF NOT EXISTS `pc_forms_content_numberfield` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Content` bigint(20) unsigned NOT NULL,
  `Label` varchar(128) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Value` varchar(128) NOT NULL,
  `Required` tinyint(1) NOT NULL DEFAULT '0',
  `Min` float DEFAULT NULL,
  `Max` float DEFAULT NULL,
  `Step` float unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Content` (`Content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;