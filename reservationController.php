<?php

include 'searchModel.php';  
$id = htmlspecialchars($_GET["id"]);
$totalCost = htmlspecialchars($_GET["totalCost"]);
$tripType = htmlspecialchars($_GET["tripType"]);
$depart_id = htmlspecialchars($_GET["depart_id"]);
$return_id = htmlspecialchars($_GET["return_id"]);
$passengers = htmlspecialchars($_GET["passengers"]);

$theDBA->createReservation($id, $totalCost, $tripType, $depart_id, $return_id, $passengers );

?>