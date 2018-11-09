<?php

/*
File name: admin.php
Student: Richard Ocampo (100587995)
Prof. Darren Puffer and Prof. Austin Garrod
Date Modified: October, 2018
Description: File created as part of Deliverable 1. This file will display an exclusive webpage for the admin when they log in.
*/

	$title = "Agent";
	$file = "agent.php";
	$description = "Exclusive login page for the agent";
	$date = "Oct 5, 2018";
	$banner = "Agent";
	include("./header.php");

	if ($_SESSION['user_type'] != AGENT )
	{
		header("Location:./login.php");
		ob_flush();
	}

?>

<div class="note"><p> NOTE: Welcome back to your agent page, <?php echo $_SESSION['first_name'];?>.</p></div>;

<?php include("./footer.php") ?>
