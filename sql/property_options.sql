DROP TABLE IF EXISTS property_option;

CREATE TABLE property_option(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);


ALTER TABLE property_option OWNER TO group25_admin;

INSERT INTO property_option (value, property) VALUES (1, 'Garage');

INSERT INTO property_option (value, property) VALUES (2, 'AC');

INSERT INTO property_option (value, property) VALUES (4, 'Pool');

INSERT INTO property_option (value, property) VALUES (8, 'Acreage');

INSERT INTO property_option (value, property) VALUES (16, 'Waterfront');
