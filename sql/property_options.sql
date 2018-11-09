DROP TABLE IF EXISTS listing_property_options CASCADE;

CREATE TABLE listing_property_options(
value INTEGER PRIMARY KEY,
property VARCHAR(15) NOT NULL
);

ALTER TABLE listing_property_options OWNER TO group25_admin;

INSERT INTO listing_property_options (value, property) VALUES (1, 'Garage');

INSERT INTO listing_property_options (value, property) VALUES (2, 'AC');

INSERT INTO listing_property_options (value, property) VALUES (4, 'Pool');

INSERT INTO listing_property_options (value, property) VALUES (8, 'Acreage');

INSERT INTO listing_property_options (value, property) VALUES (16, 'Waterfront');

SELECT * FROM listing_property_options;
