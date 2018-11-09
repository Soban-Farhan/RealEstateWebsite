DROP TABLE IF EXISTS salutation CASCADE;

CREATE TABLE salutation(
	value VARCHAR(10) PRIMARY KEY
);

ALTER TABLE salutation OWNER TO group25_admin;

INSERT INTO salutation(value) VALUES ('Master');
INSERT INTO salutation(value) VALUES ('Mr.');
INSERT INTO salutation(value) VALUES ('Miss');
INSERT INTO salutation(value) VALUES ('Mrs.');
INSERT INTO salutation(value) VALUES ('Ms.');
