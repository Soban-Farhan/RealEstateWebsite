<?php

/*
File name: listing-display.php
Student: Richard Ocampo (100587995)
Prof. Darren Puffer and Prof. Austin Garrod
Date Modified: October, 2018
Description: File created as part of Deliverable 1. This file will list available houses depending on the location specified
*/

	$title = "Listing Display Page";
	$file = "listing-display.php";
	$description = "Webpage that lists the available houses specific to a location";
	$date = "Oct 5, 2018";
	$banner = "Listing Display";
	include("./header-display-listing.php");
	require("./includes/db.php");

	$listing_id = $_GET['listing_id'];

	$conn = db_Connect();

	$sql = "SELECT * FROM listings WHERE listing_id = $listing_id ";
	$result = pg_query($conn, $sql);

	$row = pg_fetch_assoc($result);

	$table = "";
	$value = "";

	//Personal
	$picture = "0";

	$status = $row['status'];
	$price = $row['price'];
	$headline = $row['headline'];
	$description = $row['description'];
	$postalCode = $row['postal_code'];
	$city = $row['city'];
	$propertyOptions = $row['property_options'];
	$bedroom = $row['bedrooms'];
	$bathroom = $row['bathrooms'];
	$propertyType = $row['property_type'];
	$flooring = $row['flooring'];
	$parking = $row['parking'];
	$buildingType = $row['building_type'];
	$basementType = $row['basement_type'];
	$interiorType = $row['interior_type'];

	$query = "";
	$sql = "";

?>

	<h1 class="heading">View Listing</h1>
	<hr/>

<form action="" method="post">
	<div class="register-style">
	<table>
	<tr>
		<td>Status: </td>
		<td><?php
		$value = $status;
		build_dropdown("listing_status", $value);
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
		<td><p><input type="text" name="description" value="<?php echo $description; ?>" size="15" style="overflow-wrap: break-word;height: 300px;" placeholder="Enter Headline"/></p></td>
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

</form>
<?php include("./footer.php");
