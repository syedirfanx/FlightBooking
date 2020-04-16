<?php

include 'searchModel.php'; 
$originForm = $_GET["origin"];
$destinationForm = $_GET["destination"];
$depart = $_GET["depart"];
$passengers = $_GET["passengers"];

if($originForm == "Dhaka"){
	$origin = "HSI";
}
else if($originForm == "Chattogram"){
	$origin = "SAI";
}
else if($originForm == "Sylhet"){
	$origin = "OIA";
}
else if($originForm == "Cox's Bazar"){
	$origin = "CBA";
}
else if($originForm == "Rajshahi"){
	$origin = "SMA";
}
else{
	$origin = "error";
}

if($destinationForm == "Dhaka"){
	$destination = "HSI";
}
else if($destinationForm == "Chattagram"){
	$destination = "SAI";
}
else if($destinationForm == "Sylhet"){
	$destination = "OIA";
}
else if($destinationForm == "Cox's Bazar"){
	$destination = "CBA";
}
else if($destinationForm == "Rajshahi"){
	$destination = "SMA";
}
else{
	$destination = "error";
}

$arr = $theDBA->getFlights ($origin, $destination, $depart, $passengers);


echo  json_encode($arr);
?>
