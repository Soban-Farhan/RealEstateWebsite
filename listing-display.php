<?php

	$title = "Listing Display";
	include("./header.php");

	$output = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){

			$listing_id = $_POST['hide-listing-id'];

			$conn = db_Connect();
		 	$query = "login_query";
		 	$result = db_prepare($conn, $query, 'UPDATE listings SET status = $1 WHERE listing_id = $2');

		 	$result =  pg_execute($conn, $query, array( HIDDEN, $listing_id));

			$output = "Listing status has been changed to hidden";

	}
	elseif (!isset($_GET['listing_id'])) {
		header("Location:./listing-search.php");
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
				 <input type="text" name="property_price" value="<?php echo $price; ?>" class="form-control" placeholder="$ 0.00" disabled/>
			 </div>
			 <div class="form-group">
				 <label>Headline: </label>
				 <input type="text" name="head_line" value="<?php echo $headline; ?>" class="form-control" disabled/>
			 </div>
			 <div class="form-group">
				 <label>Description: </label>
				 <textarea name="description" style="height: 10em;" wrap="soft" class="form-control" disabled> <?php echo $description; ?> </textarea>
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
							<input type="text" name="postal_code" value="<?php echo $postalCode; ?>" class="form-control" disabled/>
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
		<?php if (!isset($_SESSION['user_type'])) { }
		elseif ( $_SESSION['user_type'] === ADMIN ) {
			echo "<button action=\"submit\" name=\"hide-listing-id\" value=".$row['listing_id']." class=\"btn btn-primary btn-md\">Hide Listing</button><br/><br/>";
		} ?>
		</div>
		</form>
	</div>
</div>


<?php include("./footer.php"); ?>
