<?php

/*
File name: listing-city-select.php
Student: Richard Ocampo (100587995)
Prof. Darren Puffer and Prof. Austin Garrod
Date Modified: November 14, 2018
Description: File created as part of Deliverable 3. This page asks the user to click the image to select a certain portion of the
*/

	$title = "Listing City Select";
	include("./header.php");
?>

<img src="./picture/imageMap.jpg" usemap="#image-map" style="display:block; margin-left:auto; margin-right:auto;" alt="Image-map">

<map name="image-map" >
    <area alt="Whitby" title="Whitby" href="./listing-search.php?city=64" coords="407,476,224,530,317,827,333,800,342,780,379,795,382,766,443,788,459,785,470,775,493,775,501,779" shape="poly">
    <area alt="Ajax" title="Ajax" href="./listing-search.php?city=1" coords="128,575,224,546,313,825,292,841,260,842,243,854,218,869" shape="poly">
    <area alt="Oshawa" title="Oshawa" href="./listing-search.php?city=8" coords="410,476,608,410,712,729,647,718,619,730,602,747,590,758,503,778" shape="poly">
    <area alt="Bowmanville" title="Bowmanville" href="./listing-search.php?city=4" coords="611,410,714,728,781,724,818,735,855,716,882,713,892,685,943,665,975,660,1011,641,913,365,759,412,745,367" shape="poly">
    <area alt="Pickering" title="Pickering" href="./listing-search.php?city=16" coords="137,616,214,868,187,869,169,875,150,888,134,899,102,884,67,889,55,901,49,908,1,908,3,658" shape="poly">
    <area alt="Port Perry" title="Port Perry" href="./listing-search.php?city=32" coords="114,2,176,190,286,154,334,102,449,73,446,1" shape="poly">
    <area alt="Brooklin" title="Brooklin" href="./listing-search.php?city=2" coords="221,528,162,345,411,266,401,320,445,462" shape="poly">
</map>
<br/>

<?php include("./footer.php"); ?>
