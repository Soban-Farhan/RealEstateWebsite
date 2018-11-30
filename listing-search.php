<?php

/*
File name: listing-search.php
Student: Richard Ocampo (100587995)
Prof. Darren Puffer and Prof. Austin Garrod
Date Modified: October, 2018
Description: File created as part of Deliverable 1. This file will display a webpage that serves a purpose in specifying a location to provide available houses. ONLY the Agent has access to this
*/

	$title = "Listing Search Page";
	$file = "listing-search.php";
	$description = "Webpage that lets the agent to specify a location for searching available houses";
	$date = "Oct 5, 2018";
	$banner = "Listing";
	include("./header.php");
	require("./includes/db.php");

	if(isset($_GET['city'])){

		$city = $_GET['city'];
		setcookie('city', $city, time() + COOKIE_LIFESPAN);
	}
	elseif (isset($_COOKIE['city'])) {

		$city = $_COOKIE['city'];

	} else {
		header("Location:./listing-city-select.php");
		ob_flush();
	}

	$minPrice = "";
	$maxPrice = "";
	$bedroom = "";
	$bathroom = "";
	$status = OPEN;

	$sql = "";
	$result = "";

	$error = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){

	$minPrice = trim($_POST["min_price"]);;
	$maxPrice = trim($_POST["max_price"]);;
	$bedroom = trim($_POST["listing_bedrooms"]);
	$bathroom = trim($_POST["listing_bathrooms"]);

	if(!isset($minPrice) || $minPrice == ""){
		$error .= "Please enter something for minimum price.<br/>";
	} elseif (!intval($minPrice)) {
		$error .= "The minimun price should be an integer.<br/>";
	}

	if(!isset($maxPrice) || $maxPrice == ""){
		$error .= "Please enter something for maximum price.<br/>";
	} elseif (!intval($maxPrice)) {
		$error .= "The maximun price should be an integer.<br/>";
	}

	if (!isset($bedroom) || $bedroom == "") {
		$error .= "Please select something from the bedroom.<br/>";
	}

	if (!isset($bathroom) || $bathroom == "") {
		$error .= "Please select something from the bathroom.<br/>";
	}
	if ($error === "") {

		$conn = db_Connect();
		$query = "listing_query";
		$sql = 'SELECT listing_id FROM listings
						WHERE price BETWEEN $1 AND $2 AND status = $3 AND city = $4 AND bedrooms = $5 AND bathrooms = $6';
		$result = db_prepare($conn, $query, $sql);

		$result =  pg_execute($conn, $query, array($minPrice, $maxPrice, $status, $city,$bedroom, $bathroom));

		if (pg_num_rows($result) === 0) {
			$error = "No listing found. Please try again.<br/>";
		} else {

			$_POST['sql_statement'] = $sql;

			while ($row = pg_fetch_assoc($result)) {
				$array[] = $row;
			}

			$_SESSION['listing_array'] = $array;

			header("Location:./listing-search-results.php");

		}
	}
}

?>

<div class="heading">
	<p>Search criteria</p>
	<hr/>
</div>

<div class="error">
	<h3><?php echo $error;?></h3>
	<h3><?php echo $_SESSION['error_message']; $_SESSION['error_message'] = ""; ?></h3>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="register-style">
	<table>
	<tr>
		 <td>Min-price: </td>
		 <td><p><input type="text" name="min_price" value="<?php echo $minPrice; ?>" size="15" placeholder="Min price"/></p></td>
	</tr>
	<tr>
		<td>Max-price: </td>
		<td><p><input type="text" name="max_price" value="<?php echo $maxPrice; ?>" size="15" placeholder="Max price"/></p></td>
	</tr>
	<tr>
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
	</table>
</div>
	<div class="login-button"><p><input type="submit" value="Search"/></p></div>

</form>

<?php include("./footer.php");
