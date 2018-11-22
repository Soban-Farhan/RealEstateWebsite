<?php
/*
Soban Farhan
WEBD2201
13 April, 2018
*/
	$title = "Update";
	$file = "update.php";
	$description = "Update page our real estate website";
	$date = "Oct 4, 2018";
	$banner = "Update";
	include("./header.php");
  require("./includes/db.php");

	if (!isset($_SESSION['user_type'])) {

		$_SESSION['error_message'] = "Can't access that page until you login.";

		header("Location:./login.php");
		ob_flush();
	} else {
		$_SESSION['error_message'] = "";
	}


  $login = $_SESSION['user_id'];
  $email = $_SESSION['email_address'];

  //Personal-information variable
	$salutation = $_SESSION['salutation'];
	$firstName = $_SESSION['first_name'];
	$lastName = $_SESSION['last_name'];
	$streetAddress1 = $_SESSION['first_address'];
	$streetAddress2 = $_SESSION['second_address'];
	$city = $_SESSION['city'];
	$province = $_SESSION['provinces'];
	$postalCode = $_SESSION['postal_code'];
	$primaryPhoneNum = $_SESSION['primary_phone_number'];
	$secondaryPhoneNum = $_SESSION['secondary_phone_number'];
	$faxNumber = $_SESSION['fax_number'];
	$contactMethod = $_SESSION['contact_method'];

	$table = "";
	$value = "";

  $user_type = $_SESSION['user_type'];;

	$output = "";
	$error = "";
	$query = "";
	$sql = "";

 if($_SERVER["REQUEST_METHOD"] == "POST"){
	//Users
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
	elseif (!preg_match("/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/", $postalCode)) {
		$error .= "The postal code entered is invalid.<br/>";
	}

	if (!isset($primaryPhoneNum) || $primaryPhoneNum == "") {
		$error .= "The primary phone is required.<br/>";
	} elseif (!preg_match("/^([(][2-9]{1}[0-9]{2}[)])([2-9]{1}[0-9]{2}[-])[0-9]{4}$/", $primaryPhoneNum)) {
		$error .= "Your primary phone number is invalid. It should be in format.(### ### ####)<br/>";
	}

	if (!isset($secondaryPhoneNum) || $secondaryPhoneNum == "") {}
		elseif (!preg_match("/^([2-9]{1}[0-9]{2}?){2}[0-9]{4}$/", $secondaryPhoneNum)) {
		$error .= "Your secondary phone number is invalid. It should be in format.(### ### ####)<br/>";
	}

	if (!isset($faxNumber) || $faxNumber == "") {}
	elseif (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $faxNumber)) {
		$error .= "Your fax number is invalid.<br/>";
	}

	if (!isset($contactMethod) || $contactMethod == "") {
  	$error .= "Please select something from the contact method.<br/>";
  }

if ($error === "") {

      $conn = db_Connect();

			$sql = "UPDATE users SET email_address = '".$email."' WHERE user_id = '".$login."'";

      $result = pg_query($conn, $sql);

      $sql = "UPDATE persons SET
              salutation = '".$salutation."',
              first_name = '".$firstName."',
              last_name = '".$lastName."',
              street_address1 = '".$streetAddress1."',
              street_address2 = '".$streetAddress2."',
              city = '".$city."',
              province = '".$province."',
              postal_code = '".$postalCode."',
              primary_phone_number = '".$primaryPhoneNum."',
              secondary_phone_number = '".$secondaryPhoneNum."',
              fax_number = '".$faxNumber."',
              preferred_contact_method = '".$contactMethod."'

              WHERE user_id = '".$login."'";

        $result = pg_query($conn, $sql);

        $_SESSION['user_id'] = $login;
        $_SESSION['email_address'] = $email;

        //Personal-information variable
        $_SESSION['salutation'] = $salutation;
        $_SESSION['first_name'] = $firstName;
        $_SESSION['last_name'] = $lastName;
        $_SESSION['first_address'] = $streetAddress1;
        $_SESSION['second_address'] = $streetAddress2;
        $_SESSION['city'] = $city;
        $_SESSION['provinces'] = $province;
        $_SESSION['postal_code'] = $postalCode;
        $_SESSION['primary_phone_number'] = $primaryPhoneNum;
        $_SESSION['secondary_phone_number'] = $secondaryPhoneNum;
        $_SESSION['fax_number'] = $faxNumber;
        $_SESSION['contact_method'] = $contactMethod;

        $output = "Your personal information was updated successful.";
		  }
  }

?>

<div class="error">
	<h2><?php echo $output; ?></h2>
	<h3><?php echo $error; ?></h3>
</div>

	<p><?php print_r($_SESSION); ?></p>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
		<td><p><input type="text" name="first_name" value="<?php echo $firstName ?>" size="15"/></p></td>
	</tr>
	<tr>
		 <td>Last Name: </td>
		 <td><p><input type="text" name="last_name" value="<?php echo $lastName ?>" size="15"/></p></td>
	</tr>
  <tr>
		 <td>Email address: </td>
		 <td><p><input type="text" name="email_address" value="<?php echo $email ?>" size="15"/></p></td>
	</tr>
	<tr>
		<td>Street address 1: </td>
		<td><p><input type="text" name="first_address" value="<?php echo $streetAddress1 ?>" size="15"/></p></td>
	</tr>
	<tr>
		<td>Street address 2: </td>
		<td><p><input type="text" name="second_address" value="<?php echo $streetAddress2 ?>" size="15"/></p></td>
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
		<td><p><input type="text" name="postal_code" value="<?php echo $postalCode ?>" size="15"/></p></td>
	</tr>
	<tr>
		<td>Phone Number#1: </td>
		<td><p><input type="text" name="primary_phone_number" value="<?php echo $primaryPhoneNum ?>" size="15"/></p></td>
	</tr>
	<tr>
		<td>Phone Number#2: </td>
		<td><p><input type="text" name="secondary_phone_number" value="<?php echo $secondaryPhoneNum ?>" size="15"/></p></td>
	</tr>
	<tr>
		<td>FAX number: </td>
		<td><p><input type="text" name="fax_number" value="<?php echo $faxNumber ?>" size="15"/></p></td>
	</tr>
	<tr>
		<td>Contact Method: </td>
    <td><div class="radio"><p><?php
		$value = $contactMethod;
		build_radio("preferred_contact_method", $value);
		 ?></p></div></td>
	</tr>
	</table>
</div>

	<div class="login-button"><p><input type="submit" value="Update"/><span></span><input type="reset" value="Reset"/></p></div>

</form>

<?php

	include("footer.php");
?>
