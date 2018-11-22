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

	//Personal-information variable
	$salutation = "";
	$firstName = "";
	$lastName = "";
	$streetAddress1 = "";
	$streetAddress2 = "";
	$city = "";
	$province = "";
	$postalCode = "";
	$primaryPhoneNum = "";
	$secondaryPhoneNum = "";
	$faxNumber = "";
	$contactMethod = "";

	$table = "";
	$value = "";

  $login = "";
	$password = "";
  $confirm = "";
  $email = "";

	$output = "";
	$error = "";
	$query = "";
	$sql = "";

	if (isset($_SESSION['user_type'])) {

		$_SESSION['error_message'] = "You are not allowed to register once logged in. Please Logout and register.";

		header("Location:./dashboard.php");
		ob_flush();
	} else {
		$_SESSION['error_message'] = "";
	}

 if($_SERVER["REQUEST_METHOD"] == "POST"){
	//Users
	$login = trim($_POST["id"]);
	$password = trim($_POST["user_password"]);
  $confirm = trim($_POST["confirm_password"]);
	$email =  trim($_POST["email_address"]);

	//Personal
	$salutation = trim($_POST["salutation"]);
	$firstName = trim($_POST["first_name"]);
	$lastName = trim($_POST["last_name"]);
	$streetAddress1 = trim($_POST["first_address"]);
	$streetAddress2 = trim($_POST["second_address"]);
	$city = trim($_POST["listing_city"]);
	$province = trim($_POST["provinces"]);
	$postalCode = trim($_POST["postal_code"]);
	$primaryPhoneNum = trim($_POST["primary_phone_number"]);
	$secondaryPhoneNum = trim($_POST["secondary_phone_number"]);
	$faxNumber = trim($_POST["fax_number"]);
	$contactMethod = trim($_POST["preferred_contact_method"]);


	//User Details
	if(!isset($login) || $login == ""){
		$error .= "Please enter the Username for the login.<br/>";
	} elseif (strlen($login) < MINIMUM_ID_LENGTH || strlen($login) > MAXIMUM_ID_LENGTH ) {
    $error .= "Please enter the Username which is between ".MINIMUM_ID_LENGTH." and ".MAXIMUM_ID_LENGTH."<br/>";
  }

	if(!isset($password) || $password == ""){
		$error .= "Please enter the Password of the user.<br/>";
	} elseif (strlen($password) < MINIMUM_PASSWORD_LENGTH || strlen($password) > MAXIMUM_PASSWORD_LENGTH ) {
    $error .= "Please enter the password which is between ".MINIMUM_PASSWORD_LENGTH." and ".MAXIMUM_PASSWORD_LENGTH."<br/>";
  }

  if(!isset($confirm) || $confirm == ""){
    $error .= "You forgot to confirm the password.<br/>";
  } elseif (strcmp($password, $confirm) !== 0) {
    $error .= "The password doesn't match up with the password entered before.<br/>";
  }

  if(!isset($email) || $email == ""){
    $error .= "You forgot to enter in your email address.<br/>";
  } elseif (strlen($email) > MAXIMUM_EMAIL_LENGTH)
  {
    $error .= "Please enter the email which is less than ".MAXIMUM_EMAIL_LENGTH." in lenght.<br/>";
  }
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error .= "The email enter is not valid. Please try again.<br/>";
	}

  if (isset($_POST["userType"]) && $_POST["userType"] == 'Yes')
  {
    $user_type = AGENT;
  }else {
    $user_type = CLIENT;
  }

	if(!isset($firstName) || $firstName == ""){
		$error .= "Please enter your first name.<br/>";
	} elseif (strlen($firstName) > MAXIMUM_FIRST_NAME_LENGTH ) {
		$error .= "The first name should be less than ".MAXIMUM_FIRST_NAME_LENGTH." length.<br/>";
	}

	if(!isset($lastName) || $lastName == ""){
		$error .= "Please enter your last name.<br/>";
	} elseif (strlen($lastName) > MAXIMUM_LAST_NAME_LENGTH ) {
		$error .= "The last name should be less than ".MAXIMUM_LAST_NAME_LENGTH." length.<br/>";
	}

	if (strlen($streetAddress1) > MAXIMUM_STREET_ADDRESS_LENGTH ) {
		$error .= "The first address should be less than ".MAXIMUM_STREET_ADDRESS_LENGTH." length.<br/>";
	}

	if (strlen($streetAddress2) > MAXIMUM_STREET_ADDRESS_LENGTH ) {
		$error .= "The second address should be less than ".MAXIMUM_STREET_ADDRESS_LENGTH." length.<br/>";
	}

	if (!isset($postalCode) || $postalCode == "") {}
	elseif (!preg_match("/^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/", $postalCode)) {
		$error .= "The postal code entered is invalid.<br/>";
	}

	if (!isset($primaryPhoneNum) || $primaryPhoneNum == "") {
		$error .= "The primary phone is required.<br/>";
	} elseif (!preg_match("/^([(][2-9]{1}[0-9]{2}[)])([2-9]{1}[0-9]{2}[-])[0-9]{4}$/", $primaryPhoneNum)) {
		$error .= "Your primary phone number is invalid. Please follow the format.<br/>";
	}

	if (!isset($secondaryPhoneNum) || $secondaryPhoneNum == "") {}
		elseif (!preg_match("/^[2-9]{1}+[0-9]{2} [2-9]{1}+[0-9]{2} [0-9]{4}$/", $secondaryPhoneNum)) {
		$error .= "Your secondary phone number is invalid. Please follow the format.<br/>";
	}

	if (!isset($faxNumber) || $faxNumber == "") {}
	elseif (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $faxNumber)) {
		$error .= "Your fax number is invalid.<br/>";
	}

	if (!isset($contactMethod)) {
  	$error .= "Please select something from the contact method.<br/>";
  }

	$conn = db_Connect();
	$query = "login_query";
	$result = db_prepare($conn, $query, 'SELECT user_id, user_type, last_access, email_address  FROM users WHERE user_id = $1 AND password = $2');

	$result =  pg_execute($conn, $query, array($login, md5($password)));

if ($error === "") {
		if (pg_num_rows($result) > 0) {
			$output = "This user already exist. Try again.<br/>";
		}else{

			$query = "register_query";
			$result = db_prepare($conn, $query, 'INSERT INTO users(user_id, password, email_address, user_type, enrol_date, last_access) VALUES ($1, $2, $3, $4, $5, $6)');

			$result =  pg_execute($conn, $query, array( $login, md5($password), $email, $user_type, date("Y-m-d",time()), date("Y-m-d",time())));


			$query = "person_register_query";
			$result = db_prepare($conn, $query, 'INSERT INTO persons(user_id, salutation,	first_name, last_name, street_address1,	street_address2, city,
																															 province, postal_code,	primary_phone_number, secondary_phone_number,	fax_number,	preferred_contact_method)
                 													 										 VALUES ( $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12,$13 )');

			$result =  pg_execute($conn, $query, array( $login, $salutation, $firstName, $lastName, $streetAddress1, $streetAddress2, $city, $province,
																									$postalCode, $primaryPhoneNum, $secondaryPhoneNum, $faxNumber, $contactMethod));

			$_SESSION['error_message'] = "User was made successfully.";
      header("Location:./login.php");
			ob_flush();
		}
    }
  }

?>

<div class="error">
	<h2><?php echo $output; ?></h2>
	<h3><?php echo $error; ?></h3>
</div>

	<h1 class="heading">User Details</h1>
	<hr/>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="register-style">
	<table>
	<tr>
		<td>Login ID: </td>
		<td><p><input type="text" name="id" value="<?php echo $login ?>" size="15" placeholder="Enter User ID"/></p></td>
  </tr>
  <tr>
     <td>Password: </td>
     <td><p><input type="password" name="user_password" value="" size="15" placeholder="Enter Password"/></p></td>
  </tr>
  <tr>
    <td>Confirm Password: </td>
    <td><p><input type="password" name="confirm_password" value="" size="15" placeholder="Confirm Password"/></p></td>
  </tr>
  <tr>
    <td>Email Address: </td>
    <td><p><input type="text" name="email_address" value="<?php echo $email ?>" size="15" placeholder="Enter Email Address"/></p></td>
  </tr>
  </table>
</div>

<div class="agent-button"><p>Are you an Agent: <span></span><input type="checkbox" name="userType" value="Yes"></p></div>

<div class="register-text"><p>Have an account? <a href="login.php">Sign in</a>.</p></div>

	<h1 class="heading">Personal Information</h1>
	<hr/>

	<div class="register-style">
	<table>
	<tr>
		<td>Salutation: </td>
		<td><?php
		$value = $salutation;
		build_simple_dropdown("salutation", $value);
		?></td>
	</tr>
	<tr>
		<td>First Name: </td>
		<td><p><input type="text" name="first_name" value="<?php echo $firstName ?>" size="15" placeholder="Enter First Name"/></p></td>
	</tr>
	<tr>
		 <td>Last Name: </td>
		 <td><p><input type="text" name="last_name" value="<?php echo $lastName ?>" size="15" placeholder="Enter Last Name"/></p></td>
	</tr>
	<tr>
		<td>Street address 1: </td>
		<td><p><input type="text" name="first_address" value="<?php echo $streetAddress1 ?>" size="15" placeholder="Enter Street Address#1"/></p></td>
	</tr>
	<tr>
		<td>Street address 2: </td>
		<td><p><input type="text" name="second_address" value="<?php echo $streetAddress2 ?>" size="15" placeholder="Enter Street Address#2"/></p></td>
	</tr>
	<tr>
		<td>City: </td>
		<td><?php
		$value = $city;
		build_dropdown("listing_city", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Province: </td>
		<td><?php
		$value = $province;
		build_simple_dropdown("provinces", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Postal code: </td>
		<td><p><input type="text" name="postal_code" value="<?php echo $postalCode ?>" size="15" placeholder="R0R0R0"/></p></td>
	</tr>
	<tr>
		<td>Primary phone number: </td>
		<td><p><input type="text" name="primary_phone_number" value="<?php echo $primaryPhoneNum ?>" size="15" placeholder="(###)###-####"/></p></td>
	</tr>
	<tr>
		<td>Secondary phone number: </td>
		<td><p><input type="text" name="secondary_phone_number" value="<?php echo $secondaryPhoneNum ?>" size="15" placeholder="0123456789"/></p></td>
	</tr>
	<tr>
		<td>FAX number: </td>
		<td><p><input type="text" name="fax_number" value="<?php echo $faxNumber ?>" size="15" placeholder="0123456789"/></p></td>
	</tr>
	<tr>
		<td>Prefferd Contact Method: </td>
		<td><div class="radio"><p><?php
		$value = $contactMethod;
		build_radio("preferred_contact_method", $value);
		 ?></p></div></td>
	</tr>
	</table>
</div>
	<div class="login-button"><p><input type="submit" value="Register"/><span></span><input type="reset" value="Reset"/></p></div>

</form>

<?php

	include("footer.php");
?>
