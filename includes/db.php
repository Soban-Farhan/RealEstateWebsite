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

 function build_simple_dropdown($table)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);

   echo "<select name='".$table."' style='width:50%;'></option>";
   echo "<option value='" . "" ."'>" .""."</option>";
   while ($row = pg_fetch_assoc($result)) {
   echo "<option value='" . $row['value'] ."'>" . $row['value'] ."</option>";
 }
 echo "</select>";
 }

 function build_dropdown($table)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);


   echo "<select name='".$table."' style='width:50%;'>";
   echo "<option value='" . "" ."'>" .""."</option>";
   while ($row = pg_fetch_assoc($result)) {
   echo "<option value='". $row['value'] ."'>" . $row['property'] ."</option>";
 }
 echo "</select>";
 }

 function build_radio($table, $value)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);

   while ($row = pg_fetch_assoc($result)) {
   echo "<input type='radio' name='".$value."' value='". $row['value'] ."' checked>" . $row['property'] ."</input>";
 }
 }

 ?>
