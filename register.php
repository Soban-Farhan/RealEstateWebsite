<?php
  $title = "Register";
  include("./header.php");

  //Personal-information variable
	$salutation = "";
	$firstName = "";
	$lastName = "";
	$streetAddress1 = "";
	$streetAddress2 = "";
	$city = "";
	$province = "";
	$postalCode = "";
	$primaryPhoneNum = "";
	$secondaryPhoneNum = "";
	$faxNumber = "";
	$contactMethod = "";

	$table = "";
	$value = "";

  $login = "";
	$password = "";
  $confirm = "";
  $email = "";

	$output = "";
	$error = "";
	$query = "";
	$sql = "";

	if (isset($_SESSION['user_type'])) {

		header("Location:./dashboard.php");
		ob_flush();
	}

 if($_SERVER["REQUEST_METHOD"] == "POST"){
	//Users
	$login = trim($_POST["id"]);
	$password = trim($_POST["user_password"]);
  $confirm = trim($_POST["confirm_password"]);
	$email =  trim($_POST["email_address"]);

	//Personal
	$salutation = trim($_POST["salutation"]);
	$firstName = trim($_POST["first_name"]);
	$lastName = trim($_POST["last_name"]);
	$streetAddress1 = trim($_POST["first_address"]);
	$streetAddress2 = trim($_POST["second_address"]);
	$city = trim($_POST["listing_city"]);
	$province = trim($_POST["provinces"]);
	$postalCode = trim($_POST["postal_code"]);
	$primaryPhoneNum = trim($_POST["primary_phone_number"]);
	$secondaryPhoneNum = trim($_POST["secondary_phone_number"]);
	$faxNumber = trim($_POST["fax_number"]);
	$contactMethod = trim($_POST["preferred_contact_method"]);


	//User Details
	if(!isset($login) || $login == ""){
		$error .= "Please enter the Username for the login.<br/>";
	} elseif (strlen($login) < MINIMUM_ID_LENGTH || strlen($login) > MAXIMUM_ID_LENGTH ) {
    $error .= "Please enter the Username which is between ".MINIMUM_ID_LENGTH." and ".MAXIMUM_ID_LENGTH."<br/>";
  }

	if(!isset($password) || $password == ""){
		$error .= "Please enter the Password of the user.<br/>";
	} elseif (strlen($password) < MINIMUM_PASSWORD_LENGTH || strlen($password) > MAXIMUM_PASSWORD_LENGTH ) {
    $error .= "Please enter the password which is between ".MINIMUM_PASSWORD_LENGTH." and ".MAXIMUM_PASSWORD_LENGTH."<br/>";
  }

  if(!isset($confirm) || $confirm == ""){
    $error .= "You forgot to confirm the password.<br/>";
  } elseif (strcmp($password, $confirm) !== 0) {
    $error .= "The password doesn't match up with the password entered before.<br/>";
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

  if (isset($_POST["userType"]) && $_POST["userType"] == 'Yes')
  {
    $user_type = PENDING;
  }else {
    $user_type = CLIENT;
  }

	if(!isset($firstName) || $firstName == ""){
		$error .= "Please enter your first name.<br/>";
	} elseif (strlen($firstName) > MAXIMUM_FIRST_NAME_LENGTH ) {
		$error .= "The first name should be less than ".MAXIMUM_FIRST_NAME_LENGTH." length.<br/>";
	}

	if(!isset($lastName) || $lastName == ""){
		$error .= "Please enter your last name.<br/>";
	} elseif (strlen($lastName) > MAXIMUM_LAST_NAME_LENGTH ) {
		$error .= "The last name should be less than ".MAXIMUM_LAST_NAME_LENGTH." length.<br/>";
	}

	if (strlen($streetAddress1) > MAXIMUM_STREET_ADDRESS_LENGTH ) {
		$error .= "The first address should be less than ".MAXIMUM_STREET_ADDRESS_LENGTH." length.<br/>";
	}

	if (strlen($streetAddress2) > MAXIMUM_STREET_ADDRESS_LENGTH ) {
		$error .= "The second address should be less than ".MAXIMUM_STREET_ADDRESS_LENGTH." length.<br/>";
	}

	if (!isset($postalCode) || $postalCode == "") {}
	elseif (!preg_match("/^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/", $postalCode)) {
		$error .= "The postal code entered is invalid.<br/>";
	}

	if (!isset($primaryPhoneNum) || $primaryPhoneNum == "") {
		$error .= "The primary phone is required.<br/>";
	} elseif (!preg_match("/^([(][2-9]{1}[0-9]{2}[)])([2-9]{1}[0-9]{2}[-])[0-9]{4}$/", $primaryPhoneNum)) {
		$error .= "Your primary phone number is invalid. Please follow the format.<br/>";
	}

	if (!isset($secondaryPhoneNum) || $secondaryPhoneNum == "") {}
		elseif (!preg_match("/^([2-9]{1}[0-9]{2}?){2}[0-9]{4}$/", $secondaryPhoneNum)) {
		$error .= "Your secondary phone number is invalid. Please follow the format.<br/>";
	}

	if (!isset($faxNumber) || $faxNumber == "") {}
	elseif (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $faxNumber)) {
		$error .= "Your fax number is invalid.<br/>";
	}

	if (!isset($contactMethod) || $contactMethod == "") {
  	$error .= "Please select something from the contact method.<br/>";
  }

	$conn = db_Connect();
	$query = "login_query";
	$result = db_prepare($conn, $query, 'SELECT user_id, user_type, last_access, email_address  FROM users WHERE user_id = $1 AND password = $2');

	$result =  pg_execute($conn, $query, array($login, md5($password)));

if ($error === "") {
		if (pg_num_rows($result) > 0) {
			$output = "This user already exist. Try again.<br/>";
		} else {

			$query = "register_query";
			$result = db_prepare($conn, $query, 'INSERT INTO users(user_id, password, email_address, user_type, enrol_date, last_access) VALUES ($1, $2, $3, $4, $5, $6)');

			$result =  pg_execute($conn, $query, array( $login, md5($password), $email, $user_type, date("Y-m-d",time()), date("Y-m-d",time())));


			$query = "person_register_query";
			$result = db_prepare($conn, $query, 'INSERT INTO persons(user_id, salutation,	first_name, last_name, street_address1,	street_address2, city,
																															 province, postal_code,	primary_phone_number, secondary_phone_number,	fax_number,	preferred_contact_method)
                 													 										 VALUES ( $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12,$13 )');

			$result =  pg_execute($conn, $query, array( $login, $salutation, $firstName, $lastName, $streetAddress1, $streetAddress2, $city, $province,
																									$postalCode, $primaryPhoneNum, $secondaryPhoneNum, $faxNumber, $contactMethod));

			header("location:./login.php");
      ob_flush();

			}
    }
  }
?>

<div class="row justify-content-center">
    <h3><?php echo $error;?></h3>
    <h3><?php echo $output;?></h3>
</div>

<div class="row">
  <div class="col-1">
  </div>
  <div class="col-lg">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  	  <div class="form-group">
  	    <label>Login Id: </label>
  	    <input type="text" name="id" value="<?php echo $login; ?>" class="form-control" placeholder="ID">
  	  </div>
  	  <div class="form-group">
  	    <label>Password: </label>
  	    <input type="password" name="user_password" value="" class="form-control" placeholder="Password">
  	  </div>
      <div class="form-group">
  	    <label>Confirm Password: </label>
  	    <input type="password" name="confirm_password" value="" class="form-control" placeholder="">
  	  </div>
      <div class="form-group">
  	    <label>Email Address: </label>
  	    <input type="text" name="email_address" value="<?php echo $email; ?>" class="form-control" placeholder="Email">
  	  </div>
      <div class="text-center">
        <label><p>Are you an Agent: <input type="checkbox" name="userType" value="Yes"></label>
        <label><p>Already have an account? <a style="color: #fec222;" href="./login.php"><b>Sign in.</b></a></label>
      </div>
  </div>
  <div class="col-1">
  </div>
  <div class="col-lg">
    <div class="form-group">
      <label>Salutation: </label>
      <?php
  		$value = $salutation;
  		build_simple_dropdown("salutation", $value, $title);
  		?>
    </div>
	  <div class="row">
      <div class="col-6">
        <div class="form-group">
    	    <label>First Name: </label>
    	    <input type="text" name="first_name" value="<?php echo $firstName; ?>" class="form-control" placeholder="First name"/>
  	    </div>
      </div>
      <div class="col-6">
        <div class="form-group">
    	    <label>Last Name: </label>
    	    <input type="text" name="last_name" value="<?php echo $lastName; ?>" class="form-control" placeholder="Last name"/>
    	  </div>
      </div>
    </div>
    <div class="form-group">
	    <label>Street Address 1: </label>
	    <input type="text" name="first_address" value="<?php echo $streetAddress1; ?>" class="form-control" placeholder="Address 1"/>
	  </div>
    <div class="form-group">
	    <label>Street Address 2: </label>
	    <input type="text" name="second_address" value="<?php echo $streetAddress2; ?>" class="form-control" placeholder="Address 2"/>
	  </div>
    <div class="row">
      <div class="col-4">
        <div class="form-group">
          <label>City: </label>
          <?php
      		$value = $city;
      		build_dropdown("listing_city", $value, $title);
      		 ?>
        </div>
      </div>
      <div class="col-4">
        <div class="form-group">
          <label>Province: </label>
          <?php
      		$value = $province;
      		build_simple_dropdown("provinces", $value, $title);
      		 ?>
        </div>
      </div>
      <div class="col-4">
        <div class="form-group">
    	    <label>Postal Code: </label>
    	    <input type="text" name="postal_code" value="<?php echo $postalCode; ?>" class="form-control" />
    	  </div>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <div class="form-group">
    	    <label>Primary Number: </label>
    	    <input type="text" name="primary_phone_number" value="<?php echo $primaryPhoneNum; ?>" placeholder="(012)345-6789" class="form-control" />
    	  </div>
      </div>
      <div class="col-4">
        <div class="form-group">
    	    <label>Secondary Number: </label>
    	    <input type="text" name="secondary_phone_number" value="<?php echo $secondaryPhoneNum; ?>" class="form-control" />
    	  </div>
      </div>
      <div class="col-4">
        <div class="form-group">
    	    <label>FAX: </label>
    	    <input type="text" name="fax_number" value="<?php echo $faxNumber; ?>" class="form-control" />
    	  </div>
      </div>
    </div>
    <div class="form-group">
	    <label>Preferred Contact Method: </label>
        <?php
    		$value = $contactMethod;
    		build_radio("preferred_contact_method", $value, $title);
    		 ?>
	  </div>
    <div class="text-center">
	  	<button type="submit" class="btn btn-primary btn-md">Register</button><br/><br/>
		</div>
  	</form>
  </div>
  <div class="col-1">
  </div>
</div>

<?php
  include("./footer.php");
?>
