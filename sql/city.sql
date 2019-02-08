DROP TABLE IF EXISTS listing_city CASCADE;

CREATE TABLE listing_city(
value INTEGER PRIMARY KEY,
property VARCHAR(15) NOT NULL
);

ALTER TABLE listing_city OWNER TO sobanfar;

INSERT INTO listing_city (value, property) VALUES (1, 'Ajax');

INSERT INTO listing_city (value, property) VALUES (2, 'Brooklin');

INSERT INTO listing_city (value, property) VALUES (4, 'Bowmanville');

INSERT INTO listing_city (value, property) VALUES (8, 'Oshawa');

INSERT INTO listing_city (value, property) VALUES (16, 'Pickering');

INSERT INTO listing_city (value, property) VALUES (32, 'Port Perry');

INSERT INTO listing_city (value, property) VALUES (64, 'Whitby');
