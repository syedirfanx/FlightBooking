<?php

include 'searchModel.php';  
$id = htmlspecialchars($_GET["id"]);

	$arr = $theDBA->getReservations($id);
	echo  json_encode($arr);
?>
