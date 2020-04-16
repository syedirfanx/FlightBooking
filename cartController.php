<?php

include 'searchModel.php';
$depart_id = htmlspecialchars($_GET["depart_id"]);
$return_id = htmlspecialchars($_GET["return_id"]);

$arr = $theDBA->getCartItems($depart_id, $return_id);


echo  json_encode($arr);
?>