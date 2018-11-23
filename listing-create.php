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

	if (!isset($_SESSION['user_type']))
	{
		$_SESSION['error_message'] = "Please login as an Agent to view that page.";
		header("Location:./login.php");
		ob_flush();
	}
	elseif ($_SESSION['user_type'] == CLIENT )
	{
		$_SESSION['error_message'] = "Client user's aren't allowed to view listing-create page. Please login as Agent.";
		header("Location:./logout.php");
		ob_flush();
	}
	else
	{
		$_SESSION['error_message'] = "";
	}

	$table = "";
	$value = "";

	//Personal
	$status = "";
	$price = "";
	$headline = "";
	$description = "";
	$postalCode = "";
	$picture = "0";
	$city = "";
	$propertyOptions = "";
	$bedroom = "";
	$bathroom = "";
	$propertyType = "";
	$flooring = "";
	$parking = "";
	$buildingType = "";
	$basementType = "";
	$interiorType = "";

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
	$propertyOptions = trim($_POST["listing_property_options"]);
	$bedroom = trim($_POST["listing_bedrooms"]);
	$bathroom = trim($_POST["listing_bathrooms"]);
	$propertyType = trim($_POST["property_type"]);
	$flooring = trim($_POST["property_flooring"]);
	$parking = trim($_POST["property_parking"]);
	$buildingType = trim($_POST["property_building_type"]);
	$basementType = trim($_POST["property_basement_type"]);
	$interiorType = trim($_POST["property_interior_type"]);

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

	if (!isset($postalCode) || $postalCode == "") { $error .= "The postal code cannot be empty.<br/>"; }
	elseif (!preg_match("/^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/", $postalCode)) {
		$error .= "The postal code entered is invalid.<br/>";
	}

	if (!isset($city) || $city == "") {
		$error .= "Please select something from the city.<br/>";
	}

	if (!isset($propertyOptions) || $propertyOptions == "") {
		$error .= "Please select something from the property option.<br/>";
	}

	if (!isset($bedroom) || $bedroom == "") {
		$error .= "Please select something from the bedroom.<br/>";
	}

	if (!isset($bathroom) || $bathroom == "") {
		$error .= "Please select something from the bathroom.<br/>";
	}

	if (!isset($propertyType) || $propertyType == "") {
		$error .= "Please select something from the property type.<br/>";
	}

	if (!isset($flooring) || $flooring == "") {
		$error .= "Please select something from the flooring.<br/>";
	}

	if (!isset($parking) || $parking == "") {
		$error .= "Please select something from the parking.<br/>";
	}

	if (!isset($buildingType) || $buildingType == "") {
		$error .= "Please select something from the building type.<br/>";
	}

	if (!isset($basementType) || $basementType == "") {
		$error .= "Please select something from the basement type.<br/>";
	}

	if (!isset($interiorType) || $interiorType == "") {
		$error .= "Please select something from the interior.<br/>";
	}

if ($error === "") {

			$conn = db_Connect();

			$query = "listing_create_query";
			$result = db_prepare($conn, $query, 'INSERT INTO listings(user_id, status, price, headline, description, postal_code, images, city,
																																property_options, bedrooms, bathrooms, property_type, flooring, parking,
																																building_type, basement_type, interior_type)
                 													 										 VALUES ( $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17 )');

			$result =  pg_execute($conn, $query, array( $login, $status, $price, $headline, $description, $postalCode, $picture, $city,
																									$propertyOptions, $bedroom, $bathroom, $propertyType, $flooring, $parking, $buildingType,
																									$basementType, $interiorType ));

			$_SESSION['error_message'] = "listing created successfully.";
		}
  }

?>

	<h1 class="heading">Create Listing</h1>
	<hr/>

	<div class="error">
		<h2><?php echo $output; ?></h2>
		<h3><?php echo $error; ?></h3>
		<h3><?php echo $_SESSION['error_message']; $_SESSION['error_message'] = "";?></h3>
	</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="register-style">
	<table>
	<tr>
		<td>Status: </td>
		<td><?php
		$value = $status;
		build_simple_dropdown("listing_status", $value);
		?></td>
  </tr>
  <tr>
     <td>Price: </td>
     <td><p><input type="text" name="property_price" value="<?php echo $price; ?>" size="15" placeholder="Enter price"/></p></td>
  </tr>
  <tr>
    <td>Headline: </td>
    <td><p><input type="text" name="head_line" value="<?php echo $headline; ?>" size="15" placeholder="Enter Headline"/></p></td>
  </tr>
  <tr>
    <td>Description: </td>
    <td><p><input type="text" name="description" value="<?php echo $description; ?>" size="15" placeholder="Enter Headline"/></p></td>
  </tr>
	<tr>
		<td>Postal Code: </td>
		<td><p><input type="text" name="postal_code" value="<?php echo $postalCode; ?>" size="15" placeholder="Enter Postal Code"/></p></td>
	</tr>
	<tr>
		<td>City: </td>
		<td><?php
		$value = $city;
		build_dropdown("listing_city", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Property Options: </td>
		<td><?php
		$value = $propertyOptions;
		build_dropdown("listing_property_options", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Bedroom: </td>
		<td><?php
		$value = $bedroom;
		build_simple_dropdown("listing_bedrooms", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Bathroom: </td>
		<td><?php
		$value = $bathroom;
		build_simple_dropdown("listing_bathrooms", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Property Type: </td>
		<td><?php
		$value = $propertyType;
		build_dropdown("property_type", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Flooring: </td>
		<td><?php
		$value = $flooring;
		build_dropdown("property_flooring", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Parking: </td>
		<td><?php
		$value = $parking;
		build_dropdown("property_parking", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Building Type: </td>
		<td><?php
		$value = $buildingType;
		build_dropdown("property_building_type", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Basement Type: </td>
		<td><?php
		$value = $basementType;
		build_dropdown("property_basement_type", $value);
		 ?></td>
	</tr>
	<tr>
		<td>Interior Type: </td>
		<td><?php
		$value = $interiorType;
		build_dropdown("property_interior_type", $value);
		 ?></td>
	</tr>
	</table>
</div>
	<div class="login-button"><p><input type="submit" value="Create"/></p></div>

</form>

<?php

	include("footer.php");
?>
