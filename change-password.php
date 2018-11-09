<?php

/*
File name: change-password.php
Student: Richard Ocampo (100587995)
Prof. Darren Puffer and Prof. Austin Garrod
Date Modified: October, 2018
Description: File created as part of Deliverable 1. This page gives the user the option to change their password
*/

	$title = "Change Password Page";
	$file = "change-password.php";
	$description = "This page gives the user the option to change their password.";
	$date = "Oct 5, 2018";
	$banner = "Password/Security";
	include("./header.php");
	//require("./includes/db.php");

	$login = "";
	$password = "";
	$output = "";
	$error = "";
	$sql = "";


?>

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">

<div class="login-style">
	<table>
		<tr>
			<td>Current Password: </td>
			<td><p><input type="text" name="user_password" value="<?php echo $login; ?>"/></p></td>
		</tr>
		<tr>
			<td>New Password: </td>
			<td><p><input type="password" name="newPassword" value="" size="15" /></p></td>
		</tr>
		<tr>
			<td>Confirm Password: </td>
			<td><p><input type="password" name="confirmNewPassword" value="" size="15" /></p></td>
		</tr>
	</table>

</div>
	<!--<div class="change-pass-button"><p></span><input type="reset" value="Reset"/></p></div> -->

	<div class="login-button"><p><!--<input type="submit" value="Login"/><span></span>--><input type="submit" value="Reset"/></p></div>

</form>






<?php include("./footer.php");