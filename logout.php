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
		$_SESSION['error_message'] = "You need to login first.";
		header("Location:./login.php");
		ob_flush();
	} else {
		$error = $_SESSION['error_message'];
		echo "<div class=\"error\" style=\"padding-top:10px;\">
							<h3> $error </h3>
					</div>";
			unset($_SESSION);
			session_destroy();
			ob_flush();

			session_start();
			$_SESSION['error_message'] = "";

			header("Refresh:5; url=./login.php", true, 303);
	}

	?>

	<div class="logout"><p>You have been logged out. Thanks for using viewing our website and not group24's. <a href="./login.php">Login again?</a></p></div>

<?php

	include("./footer.php");

	?>
