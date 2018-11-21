<?php
/*
Soban Farhan
WEBD2201
13 April, 2018
*/
	$title = "Login";
	$file = "login.php";
	$description = "Login page our real estate website";
	$date = "Oct 4, 2018";
	$banner = "logout";
	include("./header.php");

	if ($_SESSION['user_type'] == "" )
	{
		header("Location:./login.php");
		ob_flush();
	}

	unset($_SESSION);
	session_destroy();
	ob_flush();

  ?>

	<div class="logout"><p>You have been logged out. Thanks for using viewing our website and not group24's. <a href="./login.php">Login again?</a></p></div>

<?php

	include("./footer.php");

	?>
