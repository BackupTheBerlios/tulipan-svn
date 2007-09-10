CREATE TABLE prefix_suggest_tracking (
	ident int(11) NOT NULL auto_increment,
	userid int(11) NOT NULL default -1,
 	contentid int(11) NOT NULL default -1,
	type varchar(20) NOT NULL default 'user',
	visited int(11) NOT NULL default '1' COMMENT 'unix timestamp',
	PRIMARY KEY (ident),
	KEY userid (userid)
);
