<?php
include 'searchModel.php';
$id = htmlspecialchars($_GET["id"]);

$theDBA->deleteReservation($id);

?>
