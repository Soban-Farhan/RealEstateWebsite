<?php
  $title = "Logout";
  include("./header.php");

  if (!isset($_SESSION['user_type']))
	{
		header("Location:./login.php");
		ob_flush();
	} else {
		unset($_SESSION);
		session_destroy();
		header("Refresh:5; url=./login.php", true, 303);
    ob_flush();
	}

?>

<div class="text-center"><p>You have been logged out. Thanks for using viewing our website and not group24's. <a href="./login.php">Login again?</a></p></div>

<?php
  include("./footer.php");
?>
