DROP TABLE IF EXISTS preferred_contact_method CASCADE;

CREATE TABLE preferred_contact_method(
value CHAR(1) PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE preferred_contact_method OWNER TO group25_admin;

INSERT INTO preferred_contact_method(value, property) VALUES ('e', 'E-Mail');

INSERT INTO preferred_contact_method(value, property) VALUES ('p', 'Phone call');

INSERT INTO preferred_contact_method(value, property) VALUES ('l', 'Letter post');

ALTER TABLE preferred_contact_method OWNER TO group25_admin;

SELECT * FROM preferred_contact_method
