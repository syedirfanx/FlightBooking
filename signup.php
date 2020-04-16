<?php include('server.php') ?>
<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration | SNTL Airlines</title>
<link rel="icon" href="img/icon.png">
<link href="styles.css" type="text/css" rel="stylesheet" />
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
            </ul>
        </div>
        
        <div id="menubar_space">
        
        </div>
        
        
        
        <div id="login_space">
        
        </div>
        
        <div class="quick_book">
        	<h3 id="booking_header">Register</h3>
			
        	
    		<form method="post" action="signup.php">
				<?php include('errors.php'); ?>
				<div class="input-group">
				  <label>Username</label>
				  <input type="text" name="username" value="<?php echo $username; ?>">
				</div><br>
				<div class="input-group">
				  <label>Email</label>
				  <input type="email" name="email" value="<?php echo $email; ?>">
				</div><br>
				<div class="input-group">
				  <label>Password</label>
				  <input type="password" name="password_1">
				</div><br>
				<div class="input-group">
				  <label>Confirm password</label>
				  <input type="password" name="password_2">
				</div><br>
				<div class="input-group">
				  <button id="search" type="submit" class="btn" name="reg_user">Register</button>
				</div>
				<p>
					Already a member? <a href="login.php">Sign in</a>
				</p>
			</form>
        		
        
        </div>
     
	 </div>
        
</div>       
<div class="footer">
  <p>CSE311 | This website is made with &#128147; by Syed, Nafis, Tamanna & Lamia</p>
</div>
</body>

</html>
