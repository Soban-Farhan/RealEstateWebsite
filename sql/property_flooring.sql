DROP TABLE IF EXISTS property_flooring;

CREATE TABLE property_flooring(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE property_flooring OWNER TO group25_admin;


INSERT INTO property_flooring (value, property) VALUES (1, 'Carpeted');

INSERT INTO property_flooring (value, property) VALUES (2, 'Laminated Hardwood');

INSERT INTO property_flooring (value, property) VALUES (4, 'Marble');

INSERT INTO property_flooring (value, property) VALUES (8, 'Tiles');
