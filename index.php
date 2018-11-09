<?php
	$title = "Home Page";
	$file = "index.php";
	$description = "index page for our real estate website.";
	$date = "October 3, 2018";
	$banner = "Index";
	include("./header.php");

?>

			<br/>
			<br/>

			<a href="./login.php">
          <div class="projectBody">
          <div class="project_title">
          <h3>Login Page</h3>
          </div>
          <div class="project_info">
          <span></span>
          <p>A page designed to have the user login and locate the user to their user type page</p>
          </div>
      </div>
      </a>

			<a href="./register.php">
          <div class="projectBody">
          <div class="project_title">
          <h3>Register Page</h3>
          </div>
          <div class="project_info">
          <span></span>
          <p>A page designed to have the user resgister to access the website.</p>
          </div>
      </div>
      </a>

			<a href="./welcome.php">
          <div class="projectBody">
          <div class="project_title">
          <h3>Welcome Page</h3>
          </div>
          <div class="project_info">
          <span></span>
          <p>A page designed to introduce our Agents, Clients and Admin to the website.</p>
          </div>
      </div>
      </a>

			<a href="./dashboard.php">
          <div class="projectBody">
          <div class="project_title">
          <h3>Dashboard Page</h3>
          </div>
          <div class="project_info">
          <span></span>
          <p>A page design similar to welcome. But, is listed with less details.</p>
          </div>
      </div>
      </a>

			<a href="./listing-search.php">
          <div class="projectBody">
          <div class="project_title">
          <h3>Search Listing Page</h3>
          </div>
          <div class="project_info">
          <span></span>
          <p>A page design to have the user search for houses in a given location.</p>
          </div>
      </div>
      </a>

			<a href="./listing-create.php">
          <div class="projectBody">
          <div class="project_title">
          <h3>Create Listing Page</h3>
          </div>
          <div class="project_info">
          <span></span>
          <p>A page design is used to create a post/listing for the website.</p>
          </div>
      </div>
      </a>

			<a href="./change-password.php">
          <div class="projectBody">
          <div class="project_title">
          <h3>Security Page</h3>
          </div>
          <div class="project_info">
          <span></span>
          <p>A page made to check for if the user was ever logged in and
					 if they were, they can change thier password.</p>
          </div>
      </div>
      </a>

			<a href="./logout.php">
          <div class="projectBody">
          <div class="project_title">
          <h3>Logout Page</h3>
          </div>
          <div class="project_info">
          <span></span>
          <p>A page made to check for if the user was ever logged in and
					 if they were, log them out.</p>
          </div>
      </div>
      </a>

<?php
  include("./footer.php");
?>
