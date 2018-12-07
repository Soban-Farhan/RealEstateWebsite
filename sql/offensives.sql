DROP TABLE IF EXISTS offensives CASCADE;

CREATE TABLE offensives (
	user_id VARCHAR(20) NOT NULL,
	listing_id INTEGER NOT NULL,
	reported_on DATE NOT NULL,
	status CHAR(1) NOT NULL,
	PRIMARY KEY (user_id, listing_id)
);
