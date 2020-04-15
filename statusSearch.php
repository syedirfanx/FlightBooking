<?php

include 'searchModel.php';

$flight_num = htmlspecialchars($_GET["number"]);
$depart = htmlspecialchars($_GET["depart"]);

$arr = $theDBA->findStatus($flight_num,$depart);

echo  json_encode($arr);
?>







