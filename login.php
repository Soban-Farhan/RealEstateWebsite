<?php
/*
Soban Farhan
WEBD2201
13 April, 2018
*/
	$title = "Login";
	include("./header.php");

	if (isset($_SESSION['user_type'])) {
		header("./welcome.php");
    ob_flush();
	}

	$login = "";
	$password = "";
	$error = "";

	$sql = "";

  if($_SERVER["REQUEST_METHOD"] == "POST") {

	$login = trim($_POST["id"]);
 	$password =  trim($_POST["user_password"]);


 	if(!isset($login) || $login == ""){
 		$error .= "Please enter the Username for the login.<br/>";
 	}

 	if(!isset($password) || $password == ""){
 		$error .= "Please enter the password of the user.<br/>";
 	}

	if($error === "") {

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
			if ($_SESSION['user_type'] == PENDING)
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

 		} else {
 			$error .= "Login Failed. incorrent username or password. Please try again.";
 			}
		}
 	}
?>


<div class="row justify-content-center">
	<h5><?php echo $error; ?></h5>
	<br/><br/>
</div>

<div class="row">
	<div class="col-lg">
	</div>
	<div class="col-lg">
	<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">
	  <div class="form-group">
	    <label>Login username: </label>
	    <input type="text" name="id" value="<?php echo $login; ?>" class="form-control" placeholder="Enter email">
	  </div>
	  <div class="form-group">
	    <label>Password: </label>
	    <input type="password" name="user_password" value="<?php echo $password; ?>" class="form-control" placeholder="Password">
	  </div>
		<div class="text-center">
			<label><a style="color: #fec222;" href="./password-reset.php"><b>Forgot Password?</b></a></label><br/>
	    <label>Don't have an account? Get <a style="color: #fec222;" href="register.php"><b>Registed</b></a>.</label><br/>
	  	<button type="submit" class="btn btn-primary btn-md">Login</button><br/><br/>
		</div>
	</form>
	</div>
	<div class="col-lg">
	</div>
</div>
<?php
  include("./footer.php");
?>
