CREATE TABLE elggnews (
   ident integer NOT NULL auto_increment,
   title   varchar(32) NOT NULL,
   description  varchar(32) NOT NULL,
   body   text NOT NULL,
   creation_date  date NOT NULL,
   source_news varchar(32),
   id_user int NOT NULL default '0',
   tag varchar(32) NOT NULL,
   primary key (ident),
   FOREIGN KEY(id_user) references elggusers(ident),
   FOREIGN KEY(tag) references elggtags(ident)
);


CREATE TABLE elggnews_qualification (
   news integer NOT NULL,
   user integer NOT NULL,
   type varchar(10) NOT NULL,
   FOREIGN KEY(news) references elggnews(ident),
   FOREIGN KEY(user) references elggusers(ident)
);

CREATE TABLE elggnews_register (
   news integer NOT NULL,
   user integer NOT NULL,
   FOREIGN KEY(news) references elggnews(ident),
   FOREIGN KEY(user) references elggusers(ident)
);

CREATE TABLE elggnews_comment (
   news integer NOT NULL,
   user integer NOT NULL,
   comment text NOT NULL,
   FOREIGN KEY(news) references elggnews(ident),
   FOREIGN KEY(user) references elggusers(ident)
);