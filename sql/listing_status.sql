DROP TABLE IF EXISTS listing_status CASCADE;

CREATE TABLE listing_status(
value CHAR(1) PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE listing_status OWNER TO sobanfar;

INSERT INTO listing_status(value, property) VALUES ('o', 'Open');

INSERT INTO listing_status(value, property) VALUES ('c', 'Closed');

INSERT INTO listing_status(value, property) VALUES ('s', 'Sold');

INSERT INTO listing_status(value, property) VALUES ('h', 'Hidden');
