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

 function generateRandomString($length = 8) {
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $charactersLength = strlen($characters);
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, $charactersLength - 1)];
     }
     return $randomString;
 }

 function offensive_listing($value, $title)
 {
   $userID = "";
   $favourite = "";
   $unFavourite = "";

   $conn = db_Connect();

   $sql = "SELECT * FROM listings WHERE listing_id = $value ";
   $result = pg_query($conn, $sql);

   $row = pg_fetch_assoc($result);

   echo "<div class=\"col-4 pt-2 pb-3\">
         <a class=\"text-dark\" style=\"text-decoration: none;\"  href=\"./listing-display.php?listing_id=". $row['listing_id'] ."\" >
         <div class=\"card\">
           <img class=\"card-img-top\" src=\"./picture/house1.jpg\" alt=\"House Image\"/>
                 <div class=\"card-body\">
                   <h5 class=\"card-title\">". $row['headline'] ."</h5>
                   <p class=\"card-text\" style=\"color: #fec222; \"><b>Price: ". $row['price'] ."</b></p>
                   <p class=\"card-text\">Bedroom: ". $row['bedrooms'] ."</p>
                   <p class=\"card-text\">Bathroom: ". $row['bathrooms'] ."</p>
                 </div>
            </div>
           </a>
          </div>";
 }

 function disabled_agent($value)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM users WHERE user_id = '$value' ";
   $result = pg_query($conn, $sql);

   $row = pg_fetch_assoc($result);

   echo "<div class=\"col-4 pt-2 pb-3\">
         <div class=\"card\">
                 <div class=\"card-body\">
                   <p class=\"card-text\" style=\"color: #fec222; \"><b>Name: ". $row['user_id'] ."</b></p>
                   <p class=\"card-text\">Email: ". $row['email_address'] ."</p>
                   <p class=\"card-text\">Start date: ". $row['enrol_date'] ."</p>
                   <form action=". $_SERVER['PHP_SELF'] ." method=\"post\">
                    <div class=\"row\">
                    <div class=\"col-lg\">
                    <button type=\"submit\" name=\"re-enable-agent\" value=". $row['user_id'] ." class=\"btn btn-primary btn-md\" > Re - Enable </button>
                    </div>
                    <div class=\"col-lg\">
                    </div>
                    </div>
                    </form>
                 </div>
            </div>
          </div>";
 }

 function pending_agent($value)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM persons WHERE user_id = '$value' ";
   $result = pg_query($conn, $sql);

   $row = pg_fetch_assoc($result);

   echo "<div class=\"col-4 pt-2 pb-3\">
         <div class=\"card\">
                 <div class=\"card-body\">
                   <p class=\"card-text\" style=\"color: #fec222; \"><b>Name: ". $row['first_name'] ." ". $row['last_name'] ."</b></p>
                   <p class=\"card-text\">Phone: ". $row['primary_phone_number'] ."</p>
                   <form action=". $_SERVER['PHP_SELF'] ." method=\"post\">
                    <div class=\"row\">
                    <div class=\"col-lg\">
                    <button type=\"submit\" name=\"accept-agent\" value=". $row['user_id'] ." class=\"btn btn-primary btn-md\" > Accept </button>
                    </div>
                    <div class=\"col-lg\">
                       <button type=\"submit\" name=\"decline-agent\" value=". $row['user_id'] ." class=\"btn btn-primary btn-md\" > Decline </button>
                    </div>
                    <div class=\"col-lg\">
                    </div>
                    </div>
                    </form>
                 </div>
            </div>
          </div>";
 }

 function build_listing($value, $title)
 {
   $userID = "";
   $favourite = "";
   $unFavourite = "";

   $conn = db_Connect();

   $sql = "SELECT * FROM listings WHERE listing_id = $value ";
   $result = pg_query($conn, $sql);

   $row = pg_fetch_assoc($result);

   echo "<div class=\"col-4 pt-2 pb-3\">
         <a class=\"text-dark\" style=\"text-decoration: none;\"  href=\"./listing-display.php?listing_id=". $row['listing_id'] ."\" >
         <div class=\"card\">
           <img class=\"card-img-top\" src=\"./picture/house1.jpg\" alt=\"House Image\"/>
                 <div class=\"card-body\">
                   <h5 class=\"card-title\">". $row['headline'] ."</h5>
                   <p class=\"card-text\" style=\"color: #fec222; \"><b>Price: ". $row['price'] ."</b></p>
                   <p class=\"card-text\">Bedroom: ". $row['bedrooms'] ."</p>
                   <p class=\"card-text\">Bathroom: ". $row['bathrooms'] ."</p>
                     <form action=". $_SERVER['PHP_SELF'] ." method=\"post\">
                      <div class=\"row\">";
                     if ($title === "Search-Result" || $title === "Home") {

                       if (!isset($_SESSION['user_id'])) {
                         $report = "disabled";
                       } else {

                         $userID = $_SESSION['user_id'];

                         $sql = "SELECT * FROM favourites WHERE user_id = '$userID' AND listing_id = $value";
                         $result = pg_query($conn, $sql);

                         if (pg_num_rows($result) > 0) { $favourite = "disabled"; $unFavourite = ""; } else { $favourite = ""; $unFavourite = "disabled"; }

                           $sql = "SELECT * FROM offensives WHERE user_id = '$userID' AND listing_id = $value";
                           $result = pg_query($conn, $sql);

                           if (pg_num_rows($result) > 0) { $report = "disabled"; } else { $report = ""; }
                        }
                       echo "<div class=\"col-lg\">
                                <button type=\"submit\" name=\"favourite-listing-id\" value=". $row['listing_id'] ." class=\"btn btn-primary btn-md\" $favourite > Favourite it </button>
                             </div>
                             <div class=\"col-lg\">
                                <button type=\"submit\" name=\"unfavourite-listing-id\" value=". $row['listing_id'] ." class=\"btn btn-primary btn-md\" $unFavourite > Un-Favourite it </button>
                             </div>
                             <div class=\"col-lg\">
                                <input type=\"hidden\" name=\"report-listing-status\" value=". $row['status'] ." />
                                <button type=\"submit\" name=\"report-listing-id\" value=". $row['listing_id'] ." class=\"btn btn-primary btn-md\" $report > Report it </button>
                             </div>";
                           } elseif($title === "Dashboard") {
                              echo "<div class=\"col-lg\">
                                      <button type=\"submit\" name=\"delete-listing\" value=". $row['listing_id'] ." class=\"btn btn-primary btn-md\"> Delete Listing </button>
                                    </div>
                                    <div class=\"col-lg\">
                                        <button class=\"btn btn-primary btn-md\"> <a class=\"text-light\" href=\"./listing-update.php?listing_id=". $row['listing_id'] ."\"> Update Listing </a> </button>
                                    </div>";
                           } else {
                             echo "<div class=\"col-lg\">
                                     <button type=\"submit\" name=\"remove-favourite-listing\" value=". $row['listing_id'] ." class=\"btn btn-primary btn-md\"> Remove from favourites </button>
                                   </div>";
                           }
                        echo "</div>
                         </form>
                        </div>
                      </div>
                     </a>
                    </div>";
 }

 function build_simple_dropdown($table, $value, $title)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);

   if ($title === "Listing Display") {
     $disabled="disabled";
   } else { $disabled=""; }

   echo "<select class=\"form-control\" name='".$table."' style='width:50%;' $disabled >";
   echo "<option value='" . "" ."'>" .""."</option>";
   while ($row = pg_fetch_assoc($result)) {
     if ($value == $row['value']) { $checked="selected=selected"; } else { $checked=""; }
   echo "<option value='" . $row['value'] ."' $checked >" . $row['value'] ."</option>";
  }
 echo "</select>";
 }

 function build_dropdown($table, $value, $title)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);

   if ($title === "Listing Display") {
     $disabled="disabled";
   } else { $disabled=""; }

   echo "<select class=\"form-control\" name='".$table."' style='width:50%;' $disabled >";
   echo "<option value='" . "" ."'>" .""."</option>";
   while ($row = pg_fetch_assoc($result)) {
     if ($value == $row['value']) { $checked="selected=selected"; } else { $checked=""; }
   echo "<option value='". $row['value'] ."' $checked >" . $row['property'] ."</option>";
 }
 echo "</select>";
 }

 function build_checkbox($table, $value)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);

   while ($row = pg_fetch_assoc($result)) {
     if ($value == $row['value']) { $checked="checked"; } else { $checked=""; }
   echo "<input type='checkbox' name='".$table."' value='". $row['value'] ."' $checked >" . $row['property'] ."</input>";
 }
}

 function build_radio($table, $value)
 {
   $conn = db_Connect();

   $sql = "SELECT * FROM $table";
   $result = pg_query($conn, $sql);


   echo "<input type='hidden' name='".$table."' value='". "" ."' checked />";
   while ($row = pg_fetch_assoc($result)) {
     if ($value == $row['value']) { $checked="checked"; } else { $checked=""; }
   echo "<label class=\"pr-3 pl-3\"><input type='radio' name='".$table."' value='". $row['value'] ."' $checked />" . $row['property'] ."</label>";
 }
 }

 ?>
