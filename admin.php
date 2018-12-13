<?php
  $title = "Admin";
  include("./header.php");

  $user_id = "";
  $sql = "";
  $result = "";
  $listing_id_array = "";
  $user_id_array = "";

  $error = "";
  $output = "";

  if (!isset($_SESSION['user_type']))
	{
		header("Location:./login.php");
		ob_flush();
	}
	elseif ($_SESSION['user_type'] != ADMIN )
	{
		header("Location:./logout.php");
		ob_flush();
	}

  $conn = db_Connect();
  $query = "reported_listing_query";
  $sql = 'SELECT listing_id FROM offensives ORDER BY reported_on';
  $result = db_prepare($conn, $query, $sql);

  $result =  pg_execute($conn, $query, array());

    if (pg_num_rows($result) > 0) {
      while ($row = pg_fetch_assoc($result)) {
      $listing_id_array[] = $row;
    }
  }

  $conn = db_Connect();
  $query = "pending_agent_query";
  $sql = 'SELECT user_id FROM users WHERE user_type = $1';
  $result = db_prepare($conn, $query, $sql);

  $result =  pg_execute($conn, $query, array( PENDING ));

  if (pg_num_rows($result) > 0) {
  while ($row = pg_fetch_assoc($result)) {
    $user_id_array[] = $row;
  }
}

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['accept-agent'])) {

      $user_id = $_POST['accept-agent'];

			$conn = db_Connect();
		 	$query = "update_type_query";
		 	$result = db_prepare($conn, $query, 'UPDATE users SET user_type = $1 WHERE user_id = $2');

		 	$result =  pg_execute($conn, $query, array( AGENT, $user_id));

			$output = "The user has been promoted to agent.";

    } elseif (isset($_POST['decline-agent'])) {

      $user_id = $_POST['decline-agent'];

			$conn = db_Connect();
		 	$query = "declie_agent_query";
		 	$result = db_prepare($conn, $query, 'DELETE FROM users WHERE user_id = $1');

		 	$result =  pg_execute($conn, $query, array( $user_id ));

      $result = db_prepare($conn, $query, 'DELETE FROM persons WHERE user_id = $1');

		 	$result =  pg_execute($conn, $query, array( $user_id ));

			$output = "The user has been promoted to agent.";

    }

  }

?>

<div class="row justify-content-center">
    <h4><?php echo $error;?></h4>
    <h4><?php echo $output;?></h4>
</div>

<div class="container-fluid">
  <ul class="nav nav-pills-light">
    <li class="nav-item active"><a data-toggle="pill" style="border: none;" class="nav-link" href="#reportListing"><button type="button" class="btn btn-primary btn-sl"> Repoted Listing </button></a></li>
    <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#pendingAgent"><button type="button" class="btn btn-primary btn-sl"> Pending Agent </button></a></li>
  </ul>

  <div class="tab-content">
    <div id="reportListing" class="tab-pane fade in">
      <h3 class="display-4">Reported Listing</h3>
      <p>All the listing that have been reported by the other user.</p>
      <div class="row">
        <?php
            if (empty($listing_id_array)) {
              $error .= "No reported listing found. Please try again.<br/>";
            } else {
            for ($index = 0; $index < sizeof($listing_id_array); $index++) {
          			offensive_listing($listing_id_array[$index]['listing_id'], $title);
            	}
            }
         ?>
      </div>
    </div>
    <div id="pendingAgent" class="tab-pane fade">
      <h3 class="display-4">Pending Agents</h3>
      <p>The recent agents that have registered as agents who are waiting to be approved.</p>
      <div class="row">
        <?php
            if (empty($user_id_array)) {
              $error .= "No reported listing found. Please try again.<br/>";
            } else {
            for ($index = 0; $index < sizeof($user_id_array); $index++) {
          			pending_agent($user_id_array[$index]['user_id']);
            	}
            }
         ?>
      </div>
    </div>
  </div>
</div>

<?php
  include("./footer.php");
 ?>
