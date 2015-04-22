CREATE TABLE teams(
	id integer PRIMARY KEY NOT NULL UNIQUE,
	name TEXT 			NOT NULL,
	school TEXT  NOT NULL,
	member1 TEXT,
	member2 TEXT,
	member3 TEXT,
	pid integer key unique default NULL
);

