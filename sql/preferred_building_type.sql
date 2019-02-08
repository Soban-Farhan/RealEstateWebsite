DROP TABLE IF EXISTS property_building_type;

CREATE TABLE property_building_type(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE property_building_type OWNER TO sobanfar;

INSERT INTO property_building_type (value, property) VALUES (1, 'House');

INSERT INTO property_building_type (value, property) VALUES (2, 'Apartment');

INSERT INTO property_building_type (value, property) VALUES (4, 'Condominuim');

INSERT INTO property_building_type (value, property) VALUES (8, 'Farm');

INSERT INTO property_building_type (value, property) VALUES (16, 'Cottage');
