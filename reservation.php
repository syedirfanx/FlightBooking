<?php
session_start();
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reservations | SNTL Airlines</title>
<link rel="icon" href="img/icon.png">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>
<div id="background_contain">
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
			<h3 id="booking_header">Your Reservations</h3>
        	
        	<div id="toChange">
			
        	</div>
			
			</div>
        	
        	<div id="nextButtonDiv"></div>
        	
		</div>
	
	</div>
 <div class="footer">
  <p>CSE311 | This website is made with &#128147; by Syed, Nafis, Tamanna & Lamia</p>
</div>

 <script>

 var divToChange = document.getElementById("toChange");
 var buttonToAdd = document.getElementById("nextButtonDiv");
 var id = 0;

 var anObj = new XMLHttpRequest();

	anObj.open("GET", "searchReservationController.php?id=" + "<?=$_SESSION['id']?>", true);
	anObj.send();

	anObj.onreadystatechange = function() {
		
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);
			var str = "";
		
			str = "<table><tr><th>Reservation ID</th><th>From</th><th>To</th><th>Total Cost</th><th>Passengers</th>";
			str += "<th>Trip Type</th><th></th><th></th>";
			for (i = 0; i < array.length; i++){
				var temp = JSON.stringify(array[i]);
				var res_id = array[i]['memberSeq'];
				str += "<tr><td>" + array[i]['memberSeq'] + "</td><td>" + array[i]['origin'] + 
				"</td><td>" + array[i]['destination'] + "</td><td>TK" + array[i]['totalCost'] + 
				"</td><td>" + array[i]['passengers'] + "</td><td>" + array[i]['tripType'] +
				"</td><td><button onclick='getDetails(" + res_id + ")' value='' class='nextButton' id='" + i + "'>Details</button></td>"
				+ "</td><td><button onclick='deleteReservation(" + res_id + ")' value='' class='nextButton' id='" + i + "'>Cancel</button></td></tr>";
			}
			str += "</table>";
			if (array.length == 0){
				divToChange.innerHTML = "You have not made a reservation yet!";
			}
			else{
				divToChange.innerHTML = str;
			}
		}
	}


	
	function getDetails(id){
		
		anObj.open("GET", "flightDetail.php?id=" + id, true);
		anObj.send();

		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				var array = JSON.parse(anObj.responseText);
				var str = "";
			
				str = "<table><tr><th>Flight #</th><th>From</th><th>Depart Date</th><th>Depart Time</th><th>To</th><th>Arrival Date</th><th>Arrival Time</th><th>Length</th>";
				for (i = 0; i < array.length; i++){
					var temp = JSON.stringify(array[i]);
					str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
					"</td><td>" + array[i]['depart_day'] + "</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['destination'] + 
					"</td><td>" + array[i]['arrival_day'] + "</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + "</td></tr>";
				}
				str += "</table>";
				
				if (array.length == 0){
					divToChange.innerHTML = "Error showing detail!";
				}
				else{
					divToChange.innerHTML = str;
				}
			}
		}
	}


	
	function deleteReservation(id){
		if (confirm("There is a TK200.00 change fee for canceling your flight.\n\nAre you sure you want to remove this reservation?") == true) {
		

		anObj.open("GET", "deleteReservationController.php?id=" + id, true);
		anObj.send();


		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				alert("Reservation deleted successfully.");
				document.location.href='reservation.php';
			}
			else{
				
			}
		}


			
		}
		else{
			
		}
	}



 </script>
 </body>
 </html>