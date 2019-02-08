DROP TABLE IF EXISTS property_types;

CREATE TABLE property_types(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE property_types OWNER TO sobanfar;

INSERT INTO property_types (value, property) VALUES (1, 'Single');

INSERT INTO property_types (value, property) VALUES (2, 'Detached');

INSERT INTO property_types (value, property) VALUES (4, 'Bungalow');

INSERT INTO property_types (value, property) VALUES (8, 'Townhome');

INSERT INTO property_types (value, property) VALUES (16, 'Duplex');
