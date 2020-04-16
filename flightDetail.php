<?php

include 'searchModel.php';

$id = $_GET["id"];

$arr1 = $theDBA->getDepartDetails($id);
$arr2 = $theDBA->getArrivalDetails($id);


echo  json_encode(array_merge($arr1,$arr2));
?>
