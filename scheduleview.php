<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - View Schedule</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  
    
</head>
<body>
<div class="container">
  <h2>UPick Football - View Schedule</h2>
<?php


  require_once('connectvars.php');

session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }
   
 ?>
<?php
   include_once 'foot_nav.php'; 
?>


  <form name="schedv" method="post" action="displaysched.php">

 <label for="">Week:</label>
 <input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value="1" />

 <label for="">Year:</label>
 <input type="number" id="gameyear" name="gameyear"  min="2016" max="2020" step="1" value="2017" />

       <input type="submit" value="go" name="submit" />
    <br />
    <hr />
	<!--  <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>  -->
  </form>
  </div>
</body> 
</html>