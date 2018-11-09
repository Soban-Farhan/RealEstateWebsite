DROP TABLE IF EXISTS listing_building_type CASCADE;

CREATE TABLE listing_building_type(
	value INTEGER PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

ALTER TABLE listing_building_type OWNER TO group25_admin;

INSERT INTO listing_building_type(value, property) VALUES (0, 'House');

INSERT INTO listing_building_type(value, property) VALUES (1, 'Row/Townhouse');

INSERT INTO listing_building_type(value, property) VALUES (2, 'Apartment');

INSERT INTO listing_building_type(value, property) VALUES (3, 'Duplex');

SELECT * FROM listing_building_type;
