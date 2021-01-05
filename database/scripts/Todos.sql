CREATE TABLE todos (
  id serial NOT NULL PRIMARY KEY,
	name varchar(100),
	email varchar(200) not null,
	password varchar(100) not null,
	remember_token varchar(100) null,
	active integer default 1
);