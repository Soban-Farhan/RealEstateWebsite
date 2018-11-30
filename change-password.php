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
	require("./includes/db.php");


	$login = "";
	$password = "";
	$output = "";
	$error = "";
	$sql = "";

	$newPassword = "";
	$confirm = "";

	$conn = db_Connect();
	$query = "login_query";
	$result = db_prepare($conn, $query, 'SELECT user_id  FROM users WHERE user_id = $1 AND password = $2');

	$result =  pg_execute($conn, $query, array($login, md5($password)));


	if (!isset($_SESSION['user_type'])) {

		$_SESSION['error_message'] = "Can't access that page until you login.";

		header("Location:./login.php");
		ob_flush();
	} else {
		$_SESSION['error_message'] = "";
		//$password = $row['user_password'];
	}



	if($_SERVER["REQUEST_METHOD"] == "POST"){

		//Passwords
		$password = md5($_POST["user_password"]);
		$newPassword = md5($_POST["newPassword"]);
		$confirm = md5($_POST["confirmNewPassword"]);

		//Validation

		//Current Password is empty and current password does not match password to records

		if(!isset($password) || $password == "")
			{
				$error .= "Please enter your current old password.<br/>";
			}
		elseif($password != $password)
		{
			$error .= "The old password you entered does not match our records. Please enter your current password <br/>";
		}

		//NEW Password is empty and new password does not meet requirements
		if(!isset($newPassword) || $newPassword == "")
			{
				$error .= "Please enter a new password.<br/>";
			}

		elseif (strlen($newPassword) < MINIMUM_PASSWORD_LENGTH || strlen($newPassword) > MAXIMUM_PASSWORD_LENGTH )
		 	{
   				 $error .= "Please enter the password which is between ". MINIMUM_PASSWORD_LENGTH ." and ". MAXIMUM_PASSWORD_LENGTH."<br/>";
  			}

		
  			 if(!isset($confirm) || $confirm == "")
  			{
   					$error .= "You forgot to confirm the password.<br/>";
  			}
  			 elseif (strcmp($newPassword, $confirm) !== 0) 
  			 {
  					$error .= "The password doesn't match up with the password entered before.<br/>";
  			}

  			if($error === "")
  			{
  					$query = ("UPDATE users SET password = '$newPassword' WHERE user_id = $1");
					//session_destroy();
					$error .= "Your password has been changed.";
				

  			}

  		

	}


?>

<div class="error">
	<h3><?php echo $error; ?></h3>
	<!-- <h3><?php// echo $_SESSION['error_message']; ?></h3> -->
</div>



<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">

<div class="login-style">
	<table>
		<tr>
			<td>Current Password: </td>
			<td><p><input type="password" name="user_password" value="<?php echo $login; ?>"/></p></td>
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
