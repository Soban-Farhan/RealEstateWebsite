DROP TABLE IF EXISTS property_parking;

CREATE TABLE property_parking(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE property_parking OWNER TO group25_admin;

INSERT INTO property_parking (value, property) VALUES (1, 'Single car port');

INSERT INTO property_parking (value, property) VALUES (2, 'Double car port');

INSERT INTO property_parking (value, property) VALUES (4, 'Reserved');

INSERT INTO property_parking (value, property) VALUES (8, 'lor systemt');
