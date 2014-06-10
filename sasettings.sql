
-- 
-- Tabellenstruktur für Tabelle `modules_sasettings_desc`
-- 

DROP TABLE IF EXISTS `modules_sasettings_desc`;
CREATE TABLE `modules_sasettings_desc` (
  `preferenceid` int(11) unsigned NOT NULL default '0',
  `language` varchar(30) NOT NULL default '',
  `desc_short` varchar(30) NOT NULL default '',
  `desc_long` mediumtext NOT NULL,
  PRIMARY KEY  (`preferenceid`,`language`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `modules_sasettings_preferences`
-- 

DROP TABLE IF EXISTS `modules_sasettings_preferences`;
CREATE TABLE `modules_sasettings_preferences` (
  `preferenceid` int(11) unsigned NOT NULL auto_increment,
  `preferencename` varchar(30) NOT NULL default '',
  `used` enum('Y','N') NOT NULL default 'Y',
  `type` enum('string','int','float','enum','boolean') NOT NULL default 'string',
  `enum_settings` mediumtext NOT NULL,
  `maxsize` tinyint(4) NOT NULL default '30',
  PRIMARY KEY  (`preferenceid`),
  UNIQUE KEY `preference-name` (`preferencename`),
  KEY `used` (`used`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `modules_sasettings_rights`
-- 

DROP TABLE IF EXISTS `modules_sasettings_rights`;
CREATE TABLE `modules_sasettings_rights` (
  `domainid` int(11) unsigned NOT NULL default '0',
  `preferenceid` int(11) unsigned NOT NULL default '0',
  `available` enum('Y','N') NOT NULL default 'Y',
  PRIMARY KEY  (`domainid`,`preferenceid`)
) TYPE=MyISAM;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `modules_sasettings_sa`
-- 

DROP TABLE IF EXISTS `modules_sasettings_sa`;
CREATE TABLE `modules_sasettings_sa` (
  `username` varchar(100) NOT NULL default '',
  `preference` varchar(30) NOT NULL default '',
  `value` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`username`,`preference`)
) TYPE=MyISAM;
