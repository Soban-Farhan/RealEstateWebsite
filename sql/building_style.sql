DROP TABLE IF EXISTS listing_building_style CASCADE;

CREATE TABLE listing_building_style(
	value INTEGER PRIMARY KEY,
	property VARCHAR(20) NOT NULL
);

ALTER TABLE listing_building_style OWNER TO group25_admin;

INSERT INTO listing_building_style (value, property) VALUES (0, 'Duplex');

INSERT INTO listing_building_style (value, property) VALUES (1, 'Semi-Detached');

INSERT INTO listing_building_style (value, property) VALUES (2, 'Attached');

SELECT * FROM listing_building_style;
