DROP TABLE IF EXISTS listings;

CREATE TABLE listings(
	listing_id INTEGER PRIMARY KEY NOT NULL,
	user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
	status CHAR(1) NOT NULL,
	price NUMERIC NOT NULL,
	headline VARCHAR(100) NOT NULL,
	description VARCHAR(1000) NOT NULL,
	postal_code CHAR(6) NOT NULL,
	images SMALLINT NOT NULL DEFAULT 0,
	city INTEGER NOT NULL,
	property_options INTEGER NOT NULL,
	bedroom INTEGER NOT NULL,
	bathroom INTEGER NOT NULL,
	building_type INTEGER NOT NULL DEFAULT 0,
	building_style INTEGER NOT NULL DEFAULT 0
);

ALTER TABLE listings OWNER TO group25_admin;

SELECT * FROM listings;
