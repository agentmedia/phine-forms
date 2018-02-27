-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Mai 2015 um 13:24
-- Server Version: 5.6.16
-- PHP-Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `phine_2_0`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_content_checkbox`
--

CREATE TABLE IF NOT EXISTS `pc_forms_content_checkbox` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Content` bigint(20) unsigned DEFAULT NULL,
  `Label` varchar(128) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `CheckedValue` varchar(255) NOT NULL DEFAULT '1',
  `Checked` tinyint(1) NOT NULL DEFAULT '0',
  `Required` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Content` (`Content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_content_fieldset`
--

CREATE TABLE IF NOT EXISTS `pc_forms_content_fieldset` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Content` bigint(20) unsigned NOT NULL,
  `Legend` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Content` (`Content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_content_form`
--

CREATE TABLE IF NOT EXISTS `pc_forms_content_form` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Content` bigint(20) unsigned NOT NULL,
  `Method` varchar(32) NOT NULL COMMENT 'POST or GET',
  `RedirectUrl` bigint(20) unsigned DEFAULT NULL,
  `SaveTo` varchar(128) NOT NULL COMMENT 'Database table',
  `SendFrom` varchar(128) NOT NULL COMMENT 'The FROM address for mailing',
  `SendTo` varchar(128) NOT NULL COMMENT 'Recipient E-Mail',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Content` (`Content`),
  UNIQUE KEY `RedirectUrl` (`RedirectUrl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_content_radio`
--

CREATE TABLE IF NOT EXISTS `pc_forms_content_radio` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Content` bigint(20) unsigned NOT NULL,
  `Label` varchar(128) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `Required` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Content` (`Content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_content_select`
--

CREATE TABLE IF NOT EXISTS `pc_forms_content_select` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Content` bigint(20) unsigned NOT NULL,
  `Label` varchar(128) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Value` varchar(128) NOT NULL,
  `Required` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Content` (`Content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_content_submit`
--

CREATE TABLE IF NOT EXISTS `pc_forms_content_submit` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Content` bigint(20) unsigned NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Value` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Content` (`Content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_content_textarea`
--

CREATE TABLE IF NOT EXISTS `pc_forms_content_textarea` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Content` bigint(20) unsigned NOT NULL,
  `Label` varchar(128) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Value` mediumtext NOT NULL,
  `Required` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Content` (`Content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_content_textfield`
--

CREATE TABLE IF NOT EXISTS `pc_forms_content_textfield` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Content` bigint(20) unsigned NOT NULL,
  `Type` varchar(64) NOT NULL DEFAULT 'text',
  `Label` varchar(128) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `Required` tinyint(1) NOT NULL DEFAULT '0',
  `MaxLength` smallint(5) unsigned NOT NULL,
  `Pattern` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Content` (`Content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_radio_option`
--

CREATE TABLE IF NOT EXISTS `pc_forms_radio_option` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `RadioField` bigint(20) unsigned NOT NULL,
  `Previous` bigint(20) unsigned DEFAULT NULL,
  `Value` varchar(128) NOT NULL,
  `Text` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Previous` (`Previous`),
  KEY `RadioField` (`RadioField`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pc_forms_select_option`
--

CREATE TABLE IF NOT EXISTS `pc_forms_select_option` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `SelectField` bigint(20) unsigned NOT NULL,
  `Previous` bigint(20) unsigned DEFAULT NULL,
  `Value` varchar(255) NOT NULL,
  `Text` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Previous` (`Previous`),
  KEY `SelectField` (`SelectField`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;