<?php
// Author: Ryan Nyborg
//
class DatabaseAdaptor {
	// The instance variable used in every one of the functions in class DatbaseAdaptor
	private $DB;
	// Make a connection to an existing data based named 'imdb_small' that has
	// table . In this assignment you will also need a new table named 'users'
	public function __construct() {
		$db = 'mysql:dbname=bookaflight;host=127.0.0.1';
		$user = 'root';
		$password = '';

		try {
			$this->DB = new PDO ( $db, $user, $password );
			$this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			echo ('Error establishing Connection');
			exit ();
		}
	}

	// Return all flights in search as an associative array.
	public function getFlights($origin, $destination, $depart, $passengers) {
		$stmt = $this->DB->prepare ("SELECT * FROM flights WHERE origin = :origin AND destination = :destination 
				AND depart_day = :depart_day AND seats_available >= :seats_available");
		$stmt->bindParam('origin', $origin);
		$stmt->bindParam('destination', $destination);
		$stmt->bindParam('depart_day', $depart);
		$stmt->bindParam('seats_available', $passengers);
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	public function findStatus($number, $date) {
		$stmt = $this->DB->prepare ("SELECT * FROM flights WHERE flight_number = :flight_number AND depart_day = :depart_day");
		$stmt->bindParam('flight_number', $number);
		$stmt->bindParam('depart_day', $date);
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	public function getCartItems($depart_id, $return_id){
		$stmt = $this->DB->prepare ("SELECT * FROM flights WHERE `flight_id` IN (:depart_id, :return_id)");
		$stmt->bindParam('depart_id', $depart_id);
		$stmt->bindParam('return_id', $return_id);
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	public function createReservation($id, $totalCost, $tripType, $depart_id, $return_id, $passengers){
		$sql = "INSERT into reservation(id, totalCost, tripType, depart_id, return_id, passengers)";
		$sql = $sql."values('$id', '$totalCost', '$tripType', '$depart_id', '$return_id', '$passengers')";
		if($this->DB->query($sql)){
			echo "<script>alert(\"Reservation created successfully.\");</script>";
			echo "<script> document.location.href='reservation_login.php';</script>";
			exit;
		}else{
			echo "<script>alert(\"Reservation failed.\");</script>";
			echo "<script> document.location.href='Home_login.php';</script>";
			exit;
		}
	}

	public function getReservations($id) {
		$stmt = $this->DB->prepare ("SELECT reservation.memberSeq, flights.origin, flights.destination, reservation.totalCost, reservation.passengers,
	 reservation.tripType FROM reservation JOIN flights ON reservation.depart_id = flights.flight_id WHERE reservation.id = :id");
		$stmt->bindParam('id', $id);
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	public function getDepartDetails($id){
		$stmt = $this->DB->prepare ("SELECT flights.flight_number, flights.origin, flights.depart_day, flights.depart, flights.destination, flights.arrival_day, flights.arrival, flights.length FROM reservation JOIN flights ON reservation.depart_id = flights.flight_id WHERE reservation.memberSeq = :id");
		$stmt->bindParam('id', $id);
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	public function getArrivalDetails($id){
		$stmt = $this->DB->prepare ("SELECT flights.flight_number, flights.origin, flights.depart_day, flights.depart, flights.destination, flights.arrival_day, flights.arrival, flights.length FROM reservation JOIN flights ON reservation.return_id = flights.flight_id WHERE reservation.memberSeq = :id");
		$stmt->bindParam('id', $id);
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	
	public function deleteReservation($id){
		$sql = "DELETE FROM `reservation` WHERE memberSeq=$id";
		
		if($this->DB->query($sql)){
			echo "<script>alert(\"Reservation removed successfully.\");</script>";
			echo "<script> document.location.href='reservation_login.php';</script>";
			exit;
		}else{
			echo "<script>alert(\"Reservation failed.\");</script>";
			echo "<script> document.location.href='Home_login.php';</script>";
			exit;
		}
	}
	
	
	/* SELECT reservation.memberSeq, flights.origin, flights.destination, reservation.totalCost, reservation.passengers,
	 reservation.tripType FROM reservation JOIN flights ON reservation.depart_id = flights.flight_id WHERE reservation.id = "rnyborg";*/

} // End class DatabaseAdaptor

// Testing code that should not be run when a part of MVC
$theDBA = new DatabaseAdaptor ();
//$theDBA->createReservation("rnyborg", 200.00, "ROUND", 156, 162, 3);
//$theDBA->deleteReservation(1);
// $arr = $theDBA->getDepartDetails(5);
// print_r($arr);

?>