<?php

	$title = "Listing Update";
	include("./header.php");

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

	$output = "";
	$error = "";
	$query = "";
	$sql = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){

 	//Personal
	$listing_id = $_POST["update-listing-id"];
	$login = $_SESSION['user_id'];
 	$status = trim($_POST["listing_status"]);
 	$price = trim($_POST["property_price"]);
 	$headline = trim($_POST["head_line"]);
 	$description = trim($_POST["description"]);
 	$postalCode = trim($_POST["postal_code"]);
 	$city = trim($_POST["listing_city"]);
 	$propertyOptions = trim($_POST["property_option"]);
 	$bedroom = trim($_POST["listing_bedrooms"]);
 	$bathroom = trim($_POST["listing_bathrooms"]);
 	$propertyType = trim($_POST["property_types"]);
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

 			$query = "listing_update_query";
 			$result = db_prepare($conn, $query, 'UPDATE listings SET status = $1, price = $2, headline = $3, description = $4, postal_code = $5, images = $6, city = $7,
 																															 property_options = $8, bedrooms = $9, bathrooms = $10, property_type = $11, flooring = $12, parking = $13,
 																															 building_type = $14, basement_type = $15, interior_type = $16 WHERE user_id = $17 AND listing_id = $18');

 			$result =  pg_execute($conn, $query, array( $status, $price, $headline, $description, $postalCode, $picture, $city,
 																									$propertyOptions, $bedroom, $bathroom, $propertyType, $flooring, $parking, $buildingType,
 																									$basementType, $interiorType, $login, $listing_id ));

   		$output = "listing updated successfully.";
 		}
  } elseif (!isset($_GET['listing_id'])) {
		header("Location:./dashboard.php");
	} else {
		$listing_id = $_GET['listing_id'];
	}

	$conn = db_Connect();

	$sql = "SELECT * FROM listings WHERE listing_id = $listing_id ";
	$result = pg_query($conn, $sql);

	$row = pg_fetch_assoc($result);

	$table = "";
	$value = "";

	if ($row['status'] !== OPEN) {
		if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] === CLIENT) {
			header("location:./listing-search.php");
			ob_flush();
		}
	}

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

<div class="row justify-content-center">
		<h5><?php echo $error;?></h5>
    <h5><?php echo $output;?></h5>
</div>

<div class="row">
	<div class="col-lg">
	</div>
	<div class="col-lg">
		 <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">
			 <div class="form-group">
				 <label>Status: </label>
				 <?php
					 $value = $status;
					 build_dropdown("listing_status", $value, $title);
				 ?>
			 </div>
			 <div class="form-group">
				 <label>Price: </label>
				 <input type="text" name="property_price" value="<?php echo $price; ?>" class="form-control" placeholder="$ 0.00"/>
			 </div>
			 <div class="form-group">
				 <label>Headline: </label>
				 <input type="text" name="head_line" value="<?php echo $headline; ?>" class="form-control"/>
			 </div>
			 <div class="form-group">
				 <label>Description: </label>
				 <textarea name="description" style="height: 10em;" wrap="soft" class="form-control"> <?php echo $description; ?> </textarea>
			 </div>
			 <div class="row">
				 <div class="col-6">
					 <div class="form-group">
						 <label>City: </label>
						 <?php
							$value = $city;
							build_dropdown("listing_city", $value, $title);
						 ?>
					 </div>
				 </div>
					<div class="col-6">
						<div class="form-group">
							<label>Postal Code: </label>
							<input type="text" name="postal_code" value="<?php echo $postalCode; ?>" class="form-control"/>
						</div>
					</div>
			 </div>
			 <div class="form-group">
				 <label>Property Options: </label>
				 <?php
					$value = $propertyOptions;
					build_dropdown("property_option", $value, $title);
				 ?>
			 </div>
				 <div class="row">
					 <div class="col-6">
						 <div class="form-group">
							 <label>Bedroom: </label>
							 <?php
								$value = $bedroom;
								build_simple_dropdown("listing_bedrooms", $value, $title);
								?>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>Bathroom: </label>
								<?php
								$value = $bedroom;
								build_simple_dropdown("listing_bathrooms", $value, $title);
								?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Property Type: </label>
						<?php
						 $value = $propertyType;
						 build_dropdown("property_types", $value, $title);
						 ?>
					 </div>
						<div class="form-group">
							<label>Parking: </label>
							<?php
							 $value = $parking;
							 build_dropdown("property_parking", $value, $title);
							 ?>
						 </div>
						<div class="form-group">
							<label>Flooring: </label>
							<?php
							 $value = $flooring;
							 build_dropdown("property_flooring", $value, $title);
							 ?>
						</div>
						<div class="form-group">
							<label>Building Type: </label>
							<?php
							 $value = $buildingType;
							 build_dropdown("property_building_type", $value, $title);
							 ?>
						</div>
						<div class="form-group">
							<label>Basement Type: </label>
							<?php
								$value = $basementType;
								build_dropdown("property_basement_type", $value, $title);
							?>
						</div>
						<div class="form-group">
							<label>Interior Type: </label>
							<?php
						 $value = $interiorType;
						 build_dropdown("property_interior_type", $value, $title);
							?>
						</div>
	</div>
	<div class="col-lg">
		<div class="text-center">
			<button action="submit" name="update-listing-id" value="<?php echo $listing_id; ?>" class="btn btn-primary btn-md">Update Listing</button><br/><br/>
		</div>
		</form>
	</div>
</div>


<?php include("./footer.php"); ?>
