<?php
/*
File name: constants.php
Student: Richard Ocampo (100587995), Soban Farhan
Prof. Darren Puffer and Prof. Austin Garrod
Date Modified: September 29, 2018
Description: File created as part of Deliverable 1
*/

//Defining User Type constants
define("ADMIN", 's');
define("AGENT", 'a');
define("CLIENT", 'c');
define("PENDING", 'p');
define("DISABLED", 'd');

//Defining Database Constants
define("DB_HOST", "127.0.0.1"); //Database host connection required
define("DB_NAME", "group25_db"); //Database name required
define("DB_PORT", "5432"); //Database Port required
define("DB_PASSWORD", "WebdGRouP25"); //Database Password required
define("DB_USER", 'group25_admin'); //Database owner required

define("MINIMUM_ID_LENGTH","3");
define("MAXIMUM_ID_LENGTH","50");
define("MINIMUM_PASSWORD_LENGTH","6");
define("MAXIMUM_PASSWORD_LENGTH","32");
define("MAXIMUM_EMAIL_LENGTH","250");

define("MAXIMUM_FIRST_NAME_LENGTH","25");
define("MAXIMUM_LAST_NAME_LENGTH","50");

define("MAXIMUM_STREET_ADDRESS_LENGTH","75");

define("MAXIMUM_HEADLINE_LENGTH","75");

define("MAXIMUM_DESCRIPTION_LENGTH","1000");

//State Maintenance Constants
define("COOKIE_LIFESPAN", 2592000); //2592000 seconds equals 30 days of cookie lifespan
?>
