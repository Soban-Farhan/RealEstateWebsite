<?php
  $title = "Listing Search";
  include("./header.php");

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

      while ($row = pg_fetch_assoc($result)) {
        $array[] = $row;
      }

      $_SESSION['listing_array'] = $array;

      header("Location:./listing-search-results.php");

    }
  }
}
?>

<div class="row justify-content-center">
    <h5><?php echo $error;?></h5>
</div>

<div class="row">
  <div class="col-lg">
  </div>
    <div class="col-lg">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label>Minimum price: </label>
          <input type="text" name="min_price" value="<?php echo $minPrice; ?>" class="form-control" />
        </div>
        <div class="form-group">
          <label>Maximum price: </label>
          <input type="text" name="max_price" value="<?php echo $maxPrice; ?>" class="form-control" />
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
            		$value = $bathroom;
            		build_simple_dropdown("listing_bathrooms", $value, $title);
            	?>
            </div>
          </div>
        </div>
        <div class="text-center">
    	  	<button type="submit" class="btn btn-primary btn-md"> Search </button><br/><br/>
    		</div>
      </form>
    </div>
  <div class="col-lg">
  </div>
</div>
<br/>

<?php include("./footer.php"); ?>
