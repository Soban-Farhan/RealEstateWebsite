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
	$banner = "Login";
	include("./header.php");
	require("./includes/db.php");

	$login = "";
	$password = "";
	$error = "";

	$sql = "";


 if($_SERVER["REQUEST_METHOD"] == "POST"){
	$login = trim($_POST["id"]);
	$password =  trim($_POST["user_password"]);


	if(!isset($login) || $login == ""){
		$error .= "Please enter the Username for the login.<br/>";
	}

	if(!isset($password) || $password == ""){

		$error = "Please enter the password of the user.<br/>";

	}

	$conn = db_Connect();
	$query = "login_query";
	$result = db_prepare($conn, $query, 'SELECT user_id, user_type, last_access, email_address  FROM users WHERE user_id = $1 AND password = $2');

	$result =  pg_execute($conn, $query, array($login, md5($password)));

		if (pg_num_rows($result) > 0) {

			//Setting the cookie
			setcookie('id', $login, time() + COOKIE_LIFESPAN);
			setcookie('user_password', md5($password), time() + COOKIE_LIFESPAN);

		$row = pg_fetch_assoc($result);

		$_SESSION['user_id'] = $row['user_id'];

		$_SESSION['email_address'] = $row['email_address'];

		$_SESSION['user_type'] = $row['user_type'];

		$query = "persons_query";
		$result = db_prepare($conn, $query, 'SELECT * FROM persons WHERE user_id = $1');

		$result =  pg_execute($conn, $query, array($login));

		$row = pg_fetch_assoc($result);

	  $_SESSION['salutation'] = $row['salutation'];
		$_SESSION['first_name'] = $row['first_name'];
		$_SESSION['last_name'] = $row['last_name'];
		$_SESSION['first_address'] = $row['street_address1'];
		$_SESSION['second_address'] = $row['street_address2'];
		$_SESSION['city'] = $row['city'];
		$_SESSION['provinces'] = $row['province'];
		$_SESSION['postal_code'] = $row['postal_code'];
		$_SESSION['primary_phone_number'] = $row['primary_phone_number'];
		$_SESSION['secondary_phone_number'] = $row['secondary_phone_number'];
		$_SESSION['fax_number'] = $row['fax_number'];
		$_SESSION['contact_method'] = $row['preferred_contact_method'];

			if ($_SESSION['user_type'] == CLIENT)
			{
				header("Location:./welcome.php");
				ob_flush();
			}
			elseif ($_SESSION['user_type'] == AGENT)
			{
				header("Location:./dashboard.php");
				obflush();
			}
			elseif ($_SESSION['user_type'] == ADMIN)
			{
				header("Location:./admin.php");
				ob_flush();
			}

		}else{
			$error .= "Login Failed. incorrent username or password. Please try again.";
		}
	}

 ?>

<div class="error">
	<?php echo $error;?>
	<h3><?php echo $_SESSION['error_message']; $_SESSION['error_message'] = ""; ?></h3>
</div>


<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">

<div class="login-style">
	<table>
		<tr>
			<td>Login ID: </td>
			<td><p><input type="text" name="id" value="<?php echo $login; ?>"/></p></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><p><input type="password" name="user_password" value="" size="15" /></p></td>
		</tr>
	</table>
	<div class="register-text"><p>Don't have an account? Get <a href="register.php">Registed</a>.</p></div>
</div>
	<div class="login-button"><p><input type="submit" value="Login"/><span></span><input type="reset" value="Reset"/></p></div>
</form>

<?php
include("./footer.php")
 ?>
