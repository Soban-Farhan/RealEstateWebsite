<?php
  $title = "Disabled Agent";
  include("./header.php");

  $result = "";
  $output = "";

  if (!isset($_SESSION['user_type'])) {
    header("./login.php");
    ob_flush();
  } elseif ($_SESSION['user_type'] != AGENT ) {
    header("./welcome.php");
    ob_flush();
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['re-enable-agent'])) {

      $user_id = $_POST['re-enable-agent'];

			$conn = db_Connect();
		 	$query = "update_type_query";
		 	$result = db_prepare($conn, $query, 'UPDATE users SET user_type = $1 WHERE user_id = $2');

		 	$result =  pg_execute($conn, $query, array( AGENT, $user_id ));

			$output .= "The user has been re-enabled to agent.<br/>";

    }
      $user_id = "";
  }

  $conn = db_Connect();
  $query = "disable_users_query";
  $sql = 'SELECT user_id FROM users WHERE user_type = $1';
  $result = db_prepare($conn, $query, $sql);

  $result =  pg_execute($conn, $query, array( DISABLED_AGENT ));

  if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
    $user_id[] = $row;
    }
  } else {
    $output .= "No other disabled agent found.<br/>";
  }
 ?>

 <div class="row justify-content-center">
     <h4><?php echo $output;?></h4>
 </div>

 <div class="row">

   <?php
 if (!empty($user_id)) {
   	for ($index = 0; $index < sizeof($user_id); $index++) {
   			disabled_agent($user_id[$index]['user_id'], $title);
   	}
 }
   ?>
 </div>

 <div class="row justify-content-center">
     <p>Want to view reported listing or pending agents? Click <a style="color: #fec222;" href="./admin.php"><b>Here</b></a>.</p>
 </div>

<?php
  include("./footer.php");
 ?>
