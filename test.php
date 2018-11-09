<?php
/*
Soban Farhan
WEBD2201
13 April, 2018
*/
	$title = "Register";
	$file = "register.php";
	$description = "Register page our real estate website";
	$date = "Oct 4, 2018";
	$banner = "Register";
	include("./header.php");
  require("./includes/db.php");
 ?>

<?php
 $city = '64';

 $_SESSION['city'] = get_property("listing_city", $city);

 print_r($_SESSION);

?>
<?php
include("./footer.php"); ?>
