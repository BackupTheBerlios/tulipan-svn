# SQL script for Elgg calendar feature
#
# This will be merged into the main elgg.sql script shortly but for now run this script AFTER the elgg.sql script is run


CREATE TABLE `prefix_calendar_events`(
	`ident` int(10) unsigned NOT NULL auto_increment,
	`owner` int(10) unsigned NOT NULL default 0,
	`calendar` int(10) unsigned NOT NULL default 0,
	`title` varchar(255) default '',
	`description` text NOT NULL,
	`access` varchar(255) default '',
	`location` varchar(50) default '',
	`date_start` int(11) NOT NULL default 0,
	`date_end` int(11) NOT NULL default 0,
	
	PRIMARY KEY(`ident`)
);


