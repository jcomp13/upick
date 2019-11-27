<!DOCTYPE html>
<html lang="en">
<head>
  <title>U-Pick Football</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
       session_start();
?>
<?php
   include_once 'foot_nav.php'; 
?>
<div class="container">
<!--
  <h3>Collapsible Navbar</h3>
  <p>In this example, the navigation bar is hidden on small screens and replaced by a button in the top right corner (try to re-size this window).
  <p>Only when the button is clicked, the navigation bar will be displayed.</p>
  -->
  	 <?php  if (!isset($_SESSION['id'])) {	
	           // echo '<h1>Incorrect Login/Password<h1>';
	        } else {
		        if (isset($_SESSION['name'])) {
                   echo  '<p>Welcome back ' . $_SESSION['name'] . '</p>';
                }
                else {
                   echo '<p>Welcome back</p>';
                }
	        }

          if (isset($_GET['err'])) {
            $errcode = $_GET['err'];
            if ($errcode == 1) {
               echo "<h1>Invalid login credentials<h1>";
             }
          }

		?>
		
</div>

</body>
</html>