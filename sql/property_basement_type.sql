DROP TABLE IF EXISTS property_basement_type;

CREATE TABLE property_basement_type(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE property_basement_type OWNER TO group25_admin;


INSERT INTO property_basement_type (value, property) VALUES (1, 'Finished');

INSERT INTO property_basement_type (value, property) VALUES (2, 'Part-finished');

INSERT INTO property_basement_type (value, property) VALUES (4, 'Walkout');

INSERT INTO property_basement_type (value, property) VALUES (8, 'Walk-up');
