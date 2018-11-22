<?php

/*
File name: admin.php
Student: Richard Ocampo (100587995)
Prof. Darren Puffer and Prof. Austin Garrod
Date Modified: October, 2018
Description: File created as part of Deliverable 1. Dashboard page created as part for deliverable 1. Since there is no specific instruction on what the dashboard page should include, it does not have any content at the moment and is only a blank page for now
*/

	$title = "Dashboard Page";
	$file = "dashboard.php";
	$date = "Oct 5, 2018";
	$banner = "Dashboard";
	include("./header.php");
	require("./includes/db.php");

?>


<div class="error" style="padding-top:30px;">
	<h3><?php echo $_SESSION['error_message'];
	$_SESSION['error_message'] = ""; ?></h3>

</div>

<div class="note"><p> NOTE: Welcome back to your dashboard page.</p></div>

<?php include("./footer.php") ?>
