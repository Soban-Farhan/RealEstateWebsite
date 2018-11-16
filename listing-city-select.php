<?php

/*
File name: listing-city-select.php
Student: Richard Ocampo (100587995)
Prof. Darren Puffer and Prof. Austin Garrod
Date Modified: November 14, 2018
Description: File created as part of Deliverable 3. This page asks the user to click the image to select a certain portion of the 
*/

	$title = "Listing Select Page";
	$file = "listing-create.php";
	$description = "A page design that is used to create a post/listing for the website";
	$date = "November 14, 2018";
	$banner = "Listing Select";
	include("./header.php");
	//require("./includes/db.php");


?>

<!-- <img src="planets.gif" width="145" height="126" alt="Planets" usemap="#planetmap">

<map name="planetmap">
  <area shape="rect" coords="0,0,82,126" alt="Sun" href="sun.htm">
  <area shape="circle" coords="90,58,3" alt="Mercury" href="mercur.htm">
  <area shape="circle" coords="124,58,8" alt="Venus" href="venus.htm">
</map> -->


<h2> Please select a city </h2>
<img src="./picture/citymap.png" style="margin-right:auto;" border="0" width="496" height="406"usemap="#citymap"  alt="" />

<map name="citymap">
<area shape="rect" coords="494,404,496,406" alt="Image Map" href="" />
<area  alt="" title="" href="" shape="poly" coords="0,360,37,375,86,362,79,310,12,323" />
<area  alt="" title="" href="" shape="poly" coords="231,28,263,59,330,61,338,7,269,11"  />
<area  alt="" title="" href="" shape="poly" coords="175,207,227,250,295,225,264,180,206,182" />
<area  alt="" title="" href="" shape="poly" coords="493,328,427,324,399,350,435,398,493,382"  />
<area  alt="" title="" href="" shape="poly" coords="276,316,300,334,343,339,339,292,297,296"  />
<area  alt="" title="" href="" shape="poly" coords="99,344,104,376,161,373,153,341,124,329"  />
<area  alt="" title="" href="" shape="poly" coords="187,310,218,335,254,327,266,298,213,278"  />
</map>

<?php include("./footer.php");