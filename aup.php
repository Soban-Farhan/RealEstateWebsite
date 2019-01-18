<?php
  $title = "AUP";
  include("./header.php");

  if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != DISABLED) {
    header("location:./welcome.php");
  } else {
    unset($_SESSION);
    session_destroy();
    header("Refresh:5; url=./login.php", true, 303);
    ob_flush();
  }
?>

<div class="container-fluid">
  <div class="text-center">
    <h3 class="display-5"> You are not authorized to view our website. </h3>
  </div>
</div>

<?php
  include("./footer.php");
?>
