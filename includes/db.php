<?php

 require("constants.php");

 function db_Connect()
 {
   return pg_connect("host=127.0.0.1 dbname=group25_db user=group25_admin password=WebdGRouP25");
 }

 function db_prepare($conn, $query, $sql)
 {
 	 $result = pg_prepare($conn, $query, $sql);

   return $result;
 }

 function build_listing($value)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM listings WHERE listing_id = $value ";
   $result = pg_query($conn, $sql);

   $row = pg_fetch_assoc($result);

     echo "<a href=\"./listing-display.php?listing_id=". $row['listing_id'] ."\"><div class=\"projectMemberBody\">
             <div class=\"projectMemberImage\" style=\"background-image: url(./picture/house1.jpg)\">
             </div>
             <div class=\"projectMemberDescription\">
             	<p style=\"color: black;\">". $row['headline'] ."
             		<br/>
             		<br/>
             			<span style=\"color:#fec222;\">Cost: $". $row['price'] ."</span>
             		<br/>
             			<span style=\"color: black;\">Bedroom: ". $row['bedrooms'] ."</span>
             		<br/>
             			<span style=\"color: black;\">Bathroom: ". $row['bathrooms'] ."</span>
             	 </p>
             </div>
             </div></a>";
 }

 function build_simple_dropdown($table, $value)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);

   //echo $value;

   echo "<select name='".$table."' style='width:50%;'>";
   echo "<option value='" . "" ."'>" .""."</option>";
   while ($row = pg_fetch_assoc($result)) {
     if ($value == $row['value']) { $checked="selected=selected"; } else { $checked=""; }
   echo "<option value='" . $row['value'] ."' $checked >" . $row['value'] ."</option>";
  }
 echo "</select>";
 }

 function build_dropdown($table, $value)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);


   echo "<select name='".$table."' style='width:50%;'>";
   echo "<option value='" . "" ."'>" .""."</option>";
   while ($row = pg_fetch_assoc($result)) {
     if ($value == $row['value']) { $checked="selected=selected"; } else { $checked=""; }
   echo "<option value='". $row['value'] ."' $checked >" . $row['property'] ."</option>";
 }
 echo "</select>";
 }

 function build_radio($table, $value)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);

   while ($row = pg_fetch_assoc($result)) {
     if ($value == $row['value']) { $checked="checked"; } else { $checked=""; }
   echo "<input type='radio' name='".$table."' value='". $row['value'] ."' $checked >" . $row['property'] ."</input>";
 }
 }

 ?>
