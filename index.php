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
<title>Home | SNTL Airlines</title>
<link rel="icon" href="img/icon.png">
<link href="styles.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	
	var today = new Date();
	
	 $(function(){
	        $("#return_date").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0, maxDate: '2020-05-31', showButtonPanel: true, changeMonth: true, changeYear: true, showAnim: "slideDown" });
	        $("#depart_date").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0, maxDate: '2020-05-31', showButtonPanel: true, changeMonth: true, changeYear: true, showAnim: "slideDown" }).bind("change",function(){
	            var minValue = $(this).val();
	            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
	            minValue.setDate(minValue.getDate());
	            $("#return_date").datepicker( "option", "minDate", minValue );
	        })
	    });

</script>
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
        

        
        <div id="login_space">
        
        </div>
       
        <div class="quick_book">
        	<h3 id="booking_header">Book A Flight</h3>
        	
    		<form action="flightSearch.php" method="post">
	        	<div id="from_block">
	        	FROM: <br/><br/><select id="origin_drop" onchange="updateSelect(this,'destination_drop')" name="origin" required>
	        			  <option value="" selected="selected"></option>
						  <option value="Dhaka">Hazrat Shahjalal International Airport, Dhaka</option>
						  <option value="Chattogram">Shah Amanat International Airport, Chattogram</option>
						  <option value="Sylhet">Osmani International Airport, Sylhet</option>
						  <option value="Cox's Bazar">Cox's Bazar Airport</option>
						  <option value="Rajshahi">Shah Makhdum Airport, Rajshahi</option>
						</select>
				</div>
				
				<div id="to_block">
	        	TO: <br/><br/><select id="destination_drop" onchange="updateSelect(this,'origin_drop')" name="destination" required>
	        			  <option value="" selected="selected"></option>
						  <option value="Dhaka">Hazrat Shahjalal International Airport, Dhaka</option>
						  <option value="Chattogram">Shah Amanat International Airport, Chattogram</option>
						  <option value="Sylhet">Osmani International Airport, Sylhet</option>
						  <option value="Cox's Bazar">Cox's Bazar Airport</option>
						  <option value="Rajshahi">Shah Makhdum Airport, Rajshahi</option>
						</select>
				</div>
			<br/>
				<div id="depart_block">
	        	Depart Date:<br/><br/> <input id="depart_date" name="depart" type="text" placeholder="yyyy-mm-dd" required>
	        	</div>
	        	<br/>
	        	<div id="return_block">
	        	Return Date:<br/><br/> <input id="return_date" name="return" type="text" placeholder="yyyy-mm-dd" required> 	
	        	</div>
	        	<br/>
	        	<div id="passenger_block">
	        	Passengers:<br/> <br/>
	        			<select id="passenger_drop" name="passengernumber" required>
	        			  <option value=""></option>
						  <option value=1>1</option>
						  <option value=2>2</option>
						  <option value=3>3</option>
						  <option value=4>4</option>
						  <option value=5>5</option>
						  <option value=6>6</option>
						</select>
	        	</div>
	        	<br/>
	        	<div id="trip_block">
	        	Type: <br/><br/>
	        		<select id="trip_drop" name="trip_type" onchange="displayChange()" required>
	        			  <option value=""></option>
						  <option value="ROUND">Round Trip</option>
						  <option value="ONE">One Way</option>
						</select>
	        	</div>
    <br/>
        		<button id="search"  onclick="getFlights()" type="submit" >Find Flights</button>
        		</form>
        		
        
        </div>
        
        </div>
        
</div>       
<div class="footer">
  <p>CSE311 | This website is made with &#128147; by Syed, Nafis, Tamanna & Lamia</p>
</div>
<script>


		var type = document.getElementById("trip_drop");
    	var returnDate = document.getElementById("return_block");
    	var returnElement = document.getElementById("return_date");
    	
    	if(type.value == "ROUND"){
    		returnDate.style.visibility = 'visible';
    		returnElement.required = true;
    	}
    	else if(type.value == "ONE"){
    		returnDate.style.visibility = 'hidden';
    		returnElement.required = false;
    	}
    	
    	
	

    function updateSelect(changedSelect, selectId) {
      var otherSelect = document.getElementById(selectId);
      for (var i = 0; i < otherSelect.options.length; ++i) {
        otherSelect.options[i].disabled = false;
      }
      if (changedSelect.selectedIndex == 0) {
        return;
      }
      otherSelect.options[changedSelect.selectedIndex].disabled = true;
    }
  
    
   function displayChange(){
    	var type = document.getElementById("trip_drop");
    	var returnDate = document.getElementById("return_block");
    	var returnElement = document.getElementById("return_date");
    	
    	if(type.value == "ROUND"){
    		returnDate.style.visibility = 'visible';
    		returnElement.required = true;
    	}
    	else if(type.value == "ONE"){
    		returnDate.style.visibility = 'hidden';
    		returnElement.required = false;
    		returnElement.value = '';
    	}
    }
    
 </script>
</body>

</html>