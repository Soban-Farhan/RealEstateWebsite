DROP TABLE IF EXISTS listing_bathrooms CASCADE;

CREATE TABLE listing_bathrooms(
value INTEGER PRIMARY KEY
);

ALTER TABLE listing_bathrooms OWNER TO group25_admin;

INSERT INTO listing_bathrooms(value) VALUES (1);

INSERT INTO listing_bathrooms(value) VALUES (2);

INSERT INTO listing_bathrooms(value) VALUES (3);

INSERT INTO listing_bathrooms(value) VALUES (4);

INSERT INTO listing_bathrooms(value) VALUES (5);

SELECT * FROM listing_bathrooms;
