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
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Find Flight | SNTL Airlines</title>
<link rel="icon" href="img/icon.png">
<link href="styles.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/styles.css">

<script>
	var today = new Date();
	
	 $(function(){
	        $("#depart_date").datepicker({ dateFormat: 'yy-mm-dd', showButtonPanel: true, changeMonth: true, changeYear: true, showAnim: "slideDown" });
	    });

</script>

</head>

<body>

<div id="menubar-id">
        
        <div class="menubar-class">
        
        <a href="index.php"><img id="menu_logo" src="img/logo.png" alt="Delta"/></a>
            
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="status.php">Flight Status</a></li>
                <li><a href="reservation.html">Reservations</a></li>
                <li><a href="contact.html">Contact Us</a></li>
				<li>
				<?php  if (isset($_SESSION['username'])) : ?>
						<a>Welcome <a style="text-transform: uppercase;"  href="profile.php"><strong><?php echo $_SESSION['username']; ?></strong></a></a>
						 <a style="color: white;">|</a><a href="index.php?logout='1'" style="color: #fe28a2;"> Logout</a>
						 
					<?php endif ?>
				</li>
            </ul>
        
        </div>
        
        <div id="menubar_space">
        
        </div>
        

        
        <div class="search_result">
        	<h3 id="booking_header">Find Flight Status</h3>
        	
        	<div id="toChange">
        	
        	Flight Number<br> <input type="text" id="flight_number" name="number" placeholder="BG###" required>
        	<br><br>
        	Date <br> <input type="text" id="depart_date" name="depart"  placeholder="yyyy-mm-dd" required>
        	<br>&nbsp;<br>
        	<button id="search">Search</button>
        	
        	</div>
        	
        </div>
        
</div>

<div class="footer">
  <p>CSE311 | This website is made with &#128147; by Syed, Nafis, Tamanna & Lamia</p>
</div>
</body>
</html>
