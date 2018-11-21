<?php

/*
File name: listing-create.php
Student: Richard Ocampo (100587995)
Prof. Darren Puffer and Prof. Austin Garrod
Date Modified: October, 2018
Description: File created as part of Deliverable 1. This page gives the user the option to change their password
*/

	$title = "Listing Create Page";
	$file = "listing-create.php";
	$description = "A page design that is used to create a post/listing for the website";
	$date = "Oct 5, 2018";
	$banner = "Listing Create";
	include("./header.php");
	require("./includes/db.php");

	if ($_SESSION['user_type'] != AGENT )
	{
		header("Location:./login.php");
		ob_flush();
	}

	$table = "";
	$value = "";

	//Personal
	$status = "";
	$price = "";
	$headline = "";
	$description = "";
	$postalCode = "";
	$picture = "";
	$city = "";
	$bedroom = "";
	$bathroom = "";
	$buildingType = "";
	$buildingStyle = "";

  $login = $_SESSION['user_id'];
  $user_type = $_SESSION['user_type'];

	$output = "";
	$error = "";
	$query = "";
	$sql = "";

 if($_SERVER["REQUEST_METHOD"] == "POST"){

	//Personal
	$status = trim($_POST["listing_status"]);
	$price = trim($_POST["property_price"]);
	$headline = trim($_POST["head_line"]);
	$description = trim($_POST["description"]);
	$postalCode = trim($_POST["postal_code"]);
	$city = trim($_POST["listing_city"]);
	$bedroom = trim($_POST["listing_bedrooms"]);
	$bathroom = trim($_POST["listing_bathrooms"]);
	$buildingType = trim($_POST["listing_building_type"]);
	$buildingStyle = trim($_POST["listing_building_style"]);

	if (!isset($status) || $status == "") {
  	$error .= "Please select something for status.<br/>";
  }

	if(!isset($price) || $price == ""){
		$error .= "Please enter the price for the listing.<br/>";
	} elseif (!is_numeric($price)) {
    $error .= "Price just be a numeric value.<br/>";
  }

  if(!isset($headline) || $headline == ""){
    $error .= "Please enter something for headline.<br/>";
  } elseif (strlen($headline) > MAXIMUM_HEADLINE_LENGTH) {
    $error .= "The headline cannot be greater than ".MAXIMUM_HEADLINE_LENGTH.".<br/>";
  }

  if(!isset($description) || $description == ""){
    $error .= "Please enter the description for listing.<br/>";
  } elseif (strlen($description) > MAXIMUM_DESCRIPTION_LENGTH)
  {
    $error .= "Please enter the description which is less than ".MAXIMUM_DESCRIPTION_LENGTH." in lenght.<br/>";
  }

	if (!isset($postalCode) || $postalCode == "") {}
	elseif (!preg_match("/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/", $postalCode)) {
		$error .= "The postal code entered is invalid.<br/>";
	}

	if (!isset($city) || $city == "") {
		$error .= "Please select something from the city.<br/>";
	}

	if (!isset($bedroom) || $bedroom == "") {
		$error .= "Please select something from the bedroom.<br/>";
	}

	if (!isset($bathroom) || $bathroom == "") {
		$error .= "Please select something from the bathroom.<br/>";
	}

	if (!isset($buildingType) || $buildingType == "") {
		$error .= "Please select something from the type.<br/>";
	}

	if (!isset($buildingStyle) || $buildingStyle == "") {
		$error .= "Please select something from the style.<br/>";
	}

if ($error === "") {

			/*$query = "register_query";
			$result = db_prepare($conn, $query, 'INSERT INTO users(user_id, password, email_address, user_type, enrol_date, last_access) VALUES ($1, $2, $3, $4, $5, $6)');

			$result =  pg_execute($conn, $query, array( $login, md5($password), $email, $user_type, date("Y-m-d",time()), date("Y-m-d",time())));


			$query = "person_register_query";
			$result = db_prepare($conn, $query, 'INSERT INTO persons(user_id, salutation,	first_name, last_name, street_address1,	street_address2, city,
																															 province, postal_code,	primary_phone_number, secondary_phone_number,	fax_number,	preferred_contact_method)
                 													 										 VALUES ( $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12,$13 )');

			$result =  pg_execute($conn, $query, array( $login, $salutation, $firstName, $lastName, $streetAddress1, $streetAddress2, $city, $province,
																									$postalCode, $primaryPhoneNum, $secondaryPhoneNum, $faxNumber, $contactmethod));

      header("Location:./login.php");*/
		}
  }

?>

<div class="error">
	<h2><?php echo $output; ?></h2>
	<h3><?php echo $error; ?></h3>
</div>

	<h1 class="heading">Create Listing</h1>
	<hr/>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="register-style">
	<table>
	<tr>
		<td>Status: </td>
		<td><?php
		$value = "";
		build_simple_dropdown("listing_status", $value);
		?></td>
  </tr>
  <tr>
     <td>Price: </td>
     <td><p><input type="text" name="property_price" value="" size="15" placeholder="Enter price"/></p></td>
  </tr>
  <tr>
    <td>Headline: </td>
    <td><p><input type="text" name="head_line" value="" size="15" placeholder="Enter Headline"/></p></td>
  </tr>
  <tr>
    <td>Description: </td>
    <td><p><input type="text" name="description" value="" size="15" placeholder="Enter Headline"/></p></td>
  </tr>
	<tr>
		<td>Postal Code: </td>
		<td><p><input type="text" name="postal_code" value="" size="15" placeholder="Enter Postal Code"/></p></td>
	</tr>
	<tr>
		<td>City: </td>
		<td><?php
		$value = "";
		build_dropdown("listing_city", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Property Options: </td>
		<td><?php
		$value = "";
		build_dropdown("listing_property_options", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Bedroom: </td>
		<td><?php
		$value = "";
		build_simple_dropdown("listing_bedrooms", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Bathroom: </td>
		<td><?php
		$value = "";
		build_simple_dropdown("listing_bathrooms", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Build Type: </td>
		<td><?php
		$value = "";
		build_dropdown("listing_building_type", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Build stype: </td>
		<td><?php
		$value = "";
		build_dropdown("listing_building_style", $value);
		 ?></td>
	</tr>
	</table>
</div>
	<div class="login-button"><p><input type="submit" value="Register"/><span></span><input type="reset" value="Reset"/></p></div>

</form>

<?php

	include("footer.php");
?>
