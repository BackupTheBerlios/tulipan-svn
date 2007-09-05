CREATE TABLE prefix_polls (
ident int(38) NOT NULL AUTO_INCREMENT,
question TEXT(100) NOT NULL,
title varchar(50) NOT NULL ,
description varchar(50) NOT NULL ,
owner_name varchar(50) NOT NULL ,
owner int(38) NOT NULL,
kind varchar(50) NOT NULL ,
access VARCHAR(50) NOT NULL,
published VARCHAR(50) NOT NULL,
finish varchar(50) NOT NULL,
date_start TIMESTAMP(16) NOT NULL ,
date_end TIMESTAMP(16) NOT NULL,
actual_date TIMESTAMP(16) NOT NULL,
state varchar(50) NOT NULL,
PRIMARY KEY(ident),
FOREIGN KEY(owner_id) references elggusers(ident));

CREATE TABLE prefix_poll_vote (
id_poll INT(38) NOT NULL,
id_user INT(10) NOT NULL,
FOREIGN KEY(id_poll) references elggpolls(ident),
FOREIGN KEY(id_user) references elggusers(ident));

CREATE TABLE prefix_poll_answer (
ident int(38) NOT NULL AUTO_INCREMENT ,
id_poll int(38) NOT NULL,
answer TEXT(25) NOT NULL,
quantity INT(32),
index_number INT(32) NOT NULL,
PRIMARY KEY(ident),
FOREIGN KEY(id_poll) references elggpoll(id_poll));


