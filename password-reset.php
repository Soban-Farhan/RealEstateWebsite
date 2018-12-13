<?php
  $title = "Reset";
  include("./header.php");


  $login = "";
  $randPassword = "";
  $email = "";
  $error = "";
  $output = "";
  $result = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

  $login = trim($_POST["id"]);
  $email =  trim($_POST["email_address"]);

  if(!isset($login) || $login == ""){
		$error .= "Please enter the Username for the login.<br/>";
	} elseif (strlen($login) < MINIMUM_ID_LENGTH || strlen($login) > MAXIMUM_ID_LENGTH ) {
    $error .= "Please enter the Username which is between ".MINIMUM_ID_LENGTH." and ".MAXIMUM_ID_LENGTH."<br/>";
  }

  if(!isset($email) || $email == ""){
      $error .= "You forgot to enter in your email address.<br/>";
    } elseif (strlen($email) > MAXIMUM_EMAIL_LENGTH)
    {
      $error .= "Please enter the email which is less than ".MAXIMUM_EMAIL_LENGTH." in lenght.<br/>";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error .= "The email enter is not valid. Please try again.<br/>";
    }

    $conn = db_Connect();
  	$query = "reset_query";
  	$result = db_prepare($conn, $query, 'SELECT user_id, email_address FROM users WHERE user_id = $1 AND email_address = $2');

  	$result =  pg_execute($conn, $query, array( $login , $email ));

    if ($error === "") {
    		if (pg_num_rows($result) == 0) {
    			$error = "No email address found. PLease try again.<br/>";
    		} else {

          $query = "register_query";

          $randPassword = generateRandomString();

    			$result = db_prepare($conn, $query, 'UPDATE users SET password = $1 WHERE user_id = $2 AND email_address = $3');

    			$result = pg_execute($conn, $query, array( md5($randPassword), $login, $email));

          $to = $email;
          $subject = "Password Reset";
          $txt = "Your password has been reset. Here is the new one: " . $randPassword;
          $headers = "From: sobanfarhan@gmail.com" . "\r\n";

          mail($to,$subject,$txt,$headers);

          $output = "Password was reset. <br/> For testing purposes, your new password is: " . $randPassword;
        }

    }
  }

  ?>

  <div class="row justify-content-center">
      <h3><?php echo $error;?></h3>
      <h3><?php echo $output;?></h3>
  </div>

<div class="row">
  <div class="col-lg">
  </div>
  <div class="col-lg">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
      <label>Login Id: </label>
      <input type="text" name="id" value="<?php echo $login; ?>" class="form-control" placeholder="ID">
    </div>
      <div class="form-group">
  	    <label>Email Address: </label>
  	    <input type="text" name="email_address" value="<?php echo $email; ?>" class="form-control" placeholder="Email">
  	  </div>
    <div class="text-center">
	  	<button type="submit" class="btn btn-primary btn-md">Reset</button><br/><br/>
		</div>
  </form>
  </div>
  <div class="col-lg">
  </div>
</div>



  <?php include("./footer.php"); ?>
