DROP TABLE IF EXISTS listing_bedrooms CASCADE;

CREATE TABLE listing_bedrooms(
value INTEGER PRIMARY KEY
);

ALTER TABLE listing_bedrooms OWNER TO sobanfar;

INSERT INTO listing_bedrooms(value) VALUES (1);

INSERT INTO listing_bedrooms(value) VALUES (2);

INSERT INTO listing_bedrooms(value) VALUES (3);

INSERT INTO listing_bedrooms(value) VALUES (4);

INSERT INTO listing_bedrooms(value) VALUES (5);

SELECT * FROM listing_bedrooms;
