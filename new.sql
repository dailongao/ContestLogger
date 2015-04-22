CREATE TABLE team(
	id integer PRIMARY KEY NOT NULL UNIQUE,
	name TEXT 			NOT NULL,
	school TEXT  NOT NULL,
	member1 TEXT,
	member2 TEXT,
	member3 TEXT
);

CREATE TABLE position (
	id integer PRIMARY KEY NOT NULL UNIQUE,
	pos integer NOT NULL UNIQUE
);
