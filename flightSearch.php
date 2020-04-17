<?php

$origin = $_POST["origin"];
$destination = $_POST["destination"];
$depart = $_POST["depart"];
$return = $_POST["return"];
$passengers = $_POST["passengernumber"];
$type = $_POST["trip_type"];

?>

<?php
  session_start();
?>

<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home | SNTL Airlines</title>
<link rel="icon" href="img/icon.png">
<link href="styles.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<div id="menubar-id">
        
        <div class="menubar-class">
        <a href="index.php"><img id="menu_logo" src="img/logo.png"/></a>  
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="status.php">Flight Status</a></li>
                <li><a href="reservation.php">Reservations</a></li>
                <li><a href="contact.html">Contact Us</a></li>
				<li>
					<?php  if (isset($_SESSION['username'])) : ?>
						<a>Welcome <a style="text-transform: uppercase;" href="profile.php"><strong><?php echo $_SESSION['username']; ?></strong></a></a>
						 <a style="color: white;">|</a><a href="index.php?logout='1'" style="color: #fe28a2;"> Logout</a>
						 
					<?php endif ?>
				</li>
				
            </ul>
        </div>
        
        <div id="menubar_space">
        
        </div>
        
        
        
        
        <div class="search_result">
        
        	<div id="search_head">Select your flight from <?=$origin?> to <?=$destination?> on <?=$depart?></div>
        	
        	<div id="toChange"></div>
        	
        	<div id="selectedDiv">
        	
        	</div>
        	
        	<div id="nextButtonDiv">
				
        		<button onclick='goBack();' id='search' class='nextButton'>Back</button>|
				
        		<button onclick='advancePageReturn();' id='search' class='nextButton'>Next</button>
        	</div>
        
        </div>
        
        
        
</div>
<div class="footer">
  <p>CSE311 | This website is made with &#128147; by Syed, Nafis, Tamanna & Lamia</p>
</div>

<script>
var divToChange = document.getElementById("toChange");
var changeSelected = document.getElementById("selectedDiv");
var depart_id = null; 
var return_id = null; 
var totalPrice = 0.0; 
var finalPrice = 0.0;

var status = 0;

var origin = "<?=$origin?>";
var destination = "<?=$destination?>";
var depart = "<?=$depart?>";
var return_flight = "<?=$return?>";
var passengers = <?=$passengers?>;

var anObj = new XMLHttpRequest();
		
if("<?=$type?>" == "ROUND"){
	nextButtonDiv.innerHTML = "<button onclick='goBack()' id='backButton' class='nextButton'>Back</button>"
		+ "<button onclick='advancePageReturn()' class='nextButton'>Next</button>";

	anObj.open("GET", "searchController.php?origin=" + origin + "&destination=" + destination
			+ "&depart=" + depart + "&passengers=" + passengers, true);
	anObj.send();

	anObj.onreadystatechange = function() {
		
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);
			var str = "";
			
			str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
			str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
			for (i = 0; i < array.length; i++){
				var temp = JSON.stringify(array[i]);
				str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
				"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
				"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
				"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
				"</td><td>TK" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
				"</td><td><button onclick='pickDepartFlight(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
			}
			str += "</table>";
			if (array.length == 0){
				divToChange.innerHTML = "Sorry, no flights were found.";
			}
			else{
				divToChange.innerHTML = str;
			}
		}
	}

}

else if("<?=$type?>" == "ONE"){
	nextButtonDiv.innerHTML = "<button onclick='goBack()' id='backButton' class='nextButton'>Back</button>"
	+ "<button onclick='toShoppingCart()' class='nextButton'>Next</button>";

	anObj.open("GET", "searchController.php?origin=" + origin + "&destination=" + destination
			+ "&depart=" + depart + "&passengers=" + passengers, true);
	anObj.send();

	anObj.onreadystatechange = function() {
		
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);
			var str = "";
			
			str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
			str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
			for (i = 0; i < array.length; i++){
				var temp = JSON.stringify(array[i]);
				str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
				"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
				"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
				"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
				"</td><td>TK" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
				"</td><td><button onclick='pickDepartFlight(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
			}
			str += "</table>";
			if (array.length == 0){
				divToChange.innerHTML = "Sorry, no flights were found.";
			}
			else{
				divToChange.innerHTML = str;
			}
		}
	}

}


function pickDepartFlight(num){
	var element = document.getElementById(num);
	var myArr = JSON.parse(element.value);
	var string = "You have selected: " + myArr.flight_number + " from " + myArr.origin + " to " + myArr.destination + " for TK" +
	myArr.price + "<br/><br/>Click next to continue with your purchase.";
			changeSelected.innerHTML = string;

	depart_id = myArr.flight_id;
	
	}

function pickReturnFlight(num){
	var element = document.getElementById(num);
	var myArr = JSON.parse(element.value);
	var string = "You have selected: " + myArr.flight_number + " from " + myArr.origin + " to " + myArr.destination + " for TK" +
	myArr.price + "<br/><br/>Click next to continue with your purchase.";
			changeSelected.innerHTML = string;

	return_id = myArr.flight_id;

	console.log(return_id);
	
	}

function advancePageReturn(){	

	console.log(status);

	if(depart_id == null){
		alert("Please select a flight.");
	}

	else{

		if(status == 0){
		status = parseFloat(status) + 1;
		}

		changeSelected.innerHTML = ""; // clear selected
		nextButtonDiv.innerHTML = "<button onclick='goBack()' id='backButton' class='nextButton'>Back</button>"
			+ "<button onclick='toShoppingCart()' class='nextButton'>Next</button>";
	
		if("<?=$type?>" == "ROUND"){
			// advance to select other flight
			anObj.open("GET", "searchController.php?origin=" + destination + "&destination=" + origin
					+ "&depart=" + return_flight + "&passengers=" + passengers, true);
			anObj.send();
	
			
	
			anObj.onreadystatechange = function() {
				
				if (anObj.readyState == 4 && anObj.status == 200) {
					var array = JSON.parse(anObj.responseText);
					var str = "";
					// create a table of flights
					str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
					str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
					for (i = 0; i < array.length; i++){
						var temp = JSON.stringify(array[i]);
						str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
						"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
						"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
						"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
						"</td><td>TK" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
						"</td><td><button onclick='pickReturnFlight(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
					}
					str += "</table>";
					search_head.innerHTML = "Select your flight from " + "<?=$destination?>" + " to " + "<?=$origin?>" + " on " + "<?=$return?>";
					if (array.length == 0){
						divToChange.innerHTML = "Sorry, no flights were found.";
					}
					else{
						divToChange.innerHTML = str;
					}
				}
			}
			
			
		}
	
		else if(<?=$type?> == "ONE"){
			
			anObj.open("GET", "searchController.php?origin=" + destination + "&destination=" + origin
					+ "&depart=" + return_flight + "&passengers=" + passengers, true);
			anObj.send();
	
			
	
			anObj.onreadystatechange = function() {
				
				if (anObj.readyState == 4 && anObj.status == 200) {
					var array = JSON.parse(anObj.responseText);
					var str = "";
					
					str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
					str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
					for (i = 0; i < array.length; i++){
						var temp = JSON.stringify(array[i]);
						str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
						"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
						"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
						"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
						"</td><td>TK" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
						"</td><td><button onclick='toShoppingCart(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
					}
					str += "</table>";
					search_head.innerHTML = "Select your flight from " + "<?=$destination?>" + " to " + "<?=$origin?>" + " on " + "<?=$return?>";
					if (array.length == 0){
						divToChange.innerHTML = "Sorry, no flights were found.";
					}
					else{
						divToChange.innerHTML = str;
					}
				}
			}
			
		}
		
		
	}
}

function toShoppingCart(){
	if(return_id == null && ("<?=$type?>" == "ROUND")){
		alert("Please select a flight.");
	}

	else if(depart_id == null && ("<?=$type?>" == "ONE")){
		alert("Please select a flight.");
	}

	else{
		
		
		anObj.open("GET", "cartController.php?depart_id=" + depart_id + "&return_id=" + return_id, true);
		anObj.send();


		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				var array = JSON.parse(anObj.responseText);
				var str = "";
				var priceStr = "";
				var finalStr = "";
			
				str = "<table><tr><th></th><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
				str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th></th>";
				for (i = 0; i < array.length; i++){
					var temp = JSON.stringify(array[i]);
					str += "<tr><td>" + (parseFloat(i)+1) + "</td><td>" + array[i]['flight_number'] + 
					"</td><td>" + array[i]['origin'] + "</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
					"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
					"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
					"</td><td>TK" + array[i]['price'] + "</td></tr>";
					totalPrice = totalPrice + parseFloat(array[i]['price']);
				}
				search_head.innerHTML = "Please review your selected flights!";
				str += "</table>";
				totalPrice = totalPrice.toFixed(2);
				finalPrice = (totalPrice * <?=$passengers?>).toFixed(2);
				priceStr = totalPrice.toString();
				finalStr = finalPrice.toString();
				divToChange.innerHTML = str;
				changeSelected.innerHTML = "Total Cost: <b>TK" + priceStr + " x <?=$passengers?> = TK" + finalStr + "</b>";
				changeSelected.style.textAlign = "right";
				changeSelected.style.fontSize = "19px";
			}
		
		}
		
		nextButtonDiv.innerHTML = "<button onclick='location.href = \"index.php\";' id='backButton' class='nextButton'>Start Over</button>"
			+ "<button onclick='purchaseFlights()' class='nextButton'>Purchase</button>";
	}
}

function purchaseFlights(){

	if (confirm("Continue purchasing the flight(s) selected?") == true) {



		anObj.open("GET", "reservationController.php?id=" + "<?=$_SESSION['id']?>" + "&totalCost=" + finalPrice + "&tripType=" + "<?=$type?>" 
				+ "&depart_id=" + depart_id + "&return_id=" + return_id + "&passengers=" + passengers, true);
		anObj.send();


		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				alert("Reservation created successfully. Thank you.");
				document.location.href='reservation.php';
			}
			else{
				
			}
		}


		
    } else {
        
    }
	
	
}

function goBack(){

	console.log(status);

	if(status == 0){
		window.location.assign("index.php");
	}
	else if(status == 1){
				
		anObj.open("GET", "searchController.php?origin=" + origin + "&destination=" + destination
				+ "&depart=" + depart + "&passengers=" + passengers, true);
		anObj.send();

		

		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				var array = JSON.parse(anObj.responseText);
				var str = "";

				str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
				str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
				for (i = 0; i < array.length; i++){
					var temp = JSON.stringify(array[i]);
					str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
					"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
					"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
					"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
					"</td><td>TK" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
					"</td><td><button onclick='pickFlight(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
				}
				str += "</table>";
				search_head.innerHTML = "Select your flight from " + "<?=$origin?>" + " to " + "<?=$destination?>" + " on " + "<?=$depart?>";
				if (array.length == 0){
					divToChange.innerHTML = "Sorry, no flights were found.";
				}
				else{
					divToChange.innerHTML = str;
				}
			}
		}
	}

	if(status == 1){
		status--;
	}
	
}

</script>




</body>
</html>