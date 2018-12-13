<?php
  $title = "Change Password";
  include("./header.php");

  $userId = "";
  $newPassword = "";
  $oldPassword  = "";
  $confirmPassword = "";
	$error = "";
  $output = "";

	$sql = "";

  if (!isset($_SESSION['user_id'])) {
    header("Location:./login.php");
    ob_flush();
  } else {
    $userId = $_SESSION['user_id'];
  }

  if($_SERVER["REQUEST_METHOD"] == "POST") {

 	$oldPassword =  trim($_POST["old_password"]);
  $newPassword =  trim($_POST["new_password"]);
  $confirmPassword =  trim($_POST["confirm_password"]);

 	if(!isset($oldPassword) || $oldPassword == ""){
 		$error .= "Please enter something for the password.<br/>";
 	}

  if(!isset($newPassword) || $newPassword == ""){
 		$error .= "Please enter something for the new password.<br/>";
 	}

  if(!isset($confirmPassword) || $confirmPassword == ""){
 		$error .= "Please enter something fr the confirm password.<br/>";
 	} elseif ($confirmPassword != $newPassword) {
    $error .= "New password doesn't match with confirm password.<br/>";
  }

  if($error === "") {

    $conn = db_Connect();
   	$query = "password_exist_query";
   	$result = db_prepare($conn, $query, 'SELECT * FROM users WHERE user_id = $1 AND password = $2');

   	$result =  pg_execute($conn, $query, array( $userId, md5($oldPassword)));

    if (pg_num_rows($result) > 0) {

      $conn = db_Connect();
     	$query = "update_password_query";
     	$result = db_prepare($conn, $query, 'UPDATE users SET password = $1 WHERE user_id = $2');

     	$result =  pg_execute($conn, $query, array( md5($newPassword), $userId ));

    	//Setting the cookie
    	setcookie('id', $userId, time() + COOKIE_LIFESPAN);
    	setcookie('user_password', md5($newPassword), time() + COOKIE_LIFESPAN);

      $output = "Your password has been updated.";

    } else {
      $error .= "The password doesn't match with your previous one. Try again.";
    }
	}
}
?>


<div class="row justify-content-center">
	<h5><?php echo $error; ?></h5>
	<br/><br/>
  <h5><?php echo $output; ?></h5>
</div>

<div class="row">
	<div class="col-lg">
	</div>
	<div class="col-lg">
	<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">
	  <div class="form-group">
	    <label>Old Password: </label>
	    <input type="password" name="old_password" value="" class="form-control">
	  </div>
	  <div class="form-group">
      <div class="row">
        <div class="col-6">
          <label>New Password: </label>
          <input type="password" name="new_password" value="" class="form-control">
        </div>
        <div class="col-6">
          <label>Confirm Password: </label>
          <input type="password" name="confirm_password" value="" class="form-control">
        </div>
      </div>
	  </div>
		<div class="text-center">
			<label><a style="color: #fec222;" href="./password-reset.php"><b>Forgot Password?</b></a></label><br/>
	  	<button type="submit" class="btn btn-primary btn-md">Update</button><br/><br/>
		</div>
	</form>
	</div>
	<div class="col-lg">
	</div>
</div>
<?php
  include("./footer.php");
?>
