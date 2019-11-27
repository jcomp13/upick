<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - Join League</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>
<div class="container">
  <h2>UPick Football - Join League</h2>

<?php

  require_once('connectvars.php');

session_start();

   // Make sure sessions are set, otherwise pick out
   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }

   include_once 'foot_nav.php'; 

  $user = $_SESSION['id'];
  if (isset($_POST['submit'])) {
	  $hvalue = $_POST['hashvalue'];
	  $leagueinfo = $_POST['league'];
	  
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	  //  Check if the hash value is the same
	  $query="select * from invites where uid='$user' and leagueid = '$leagueinfo'";
	  $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 
	  $row=mysqli_fetch_assoc($result);
	  $hashnum=$row["hashkey"];
	  if ($hashnum == $hvalue) {
		  echo 'Invitation has been accepted';
		  $qyear="select * from football_league where lnum= '$leagueinfo'";
		  $linfo=mysqli_query ($dbc, $qyear) or die ("Error in query: $qyear " . mysqli_error()); 
		  $ldate=mysqli_fetch_assoc($linfo);
		  $leagueyear=$ldate['year'];
		  
	  	  //   add the value to the userleague table
	      $query="insert into userleague(uid, league, wins, loses, ties, syear)values ('$user', '$leagueinfo', 0, 0, 0, '$leagueyear')";
	      mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 
		  $query="delete from invites where uid='$user' and leagueid = '$leagueinfo'";
		  mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 



           // check if multi flag needs to be set
           $query = "select * from userleague where uid = " . $user . " and syear = '" . $leagueyear . "'";
           $result  = mysqli_query($dbc, $query);
           $num_results = mysqli_num_rows($result); 
           if ($num_results > 1) {
               $query = "update multileague set multiflag = 'Y' where uid = " . $user . " and syear = '" . $leagueyear . "'";
               mysqli_query($dbc, $query);
           }



	  }
	  else
		  echo 'Invitation is invalid, Hash values do not match';
      mysqli_close($dbc);

  }
 
?>

  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
     <?php
	    
	    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");
        //mysqli_select_db(DB_NAME)or die("Connection Failed"); 
	    $query="select * from invites where uid=$user"; 
	    $result = mysqli_query ($con, $query) or die ("Error in query: $query " . mysqli_error()); 
	    $num_results = mysqli_num_rows($result); 
        if ($num_results > 0){      /*  invites exist    */
		   $query = "SELECT * FROM `invites` join football_league on lnum = leagueid WHERE uid =$user and year = (select curryear from footconfig where cfgid=1)";
		   $result = mysqli_query ($con, $query) or die ("Error in query: $query " . mysqli_error()); 
	      echo '<label for="league">League:</label>';
          echo '<select name="league">';
          // printing the list box select command   lnum holds the value to pass and lname is isplayed
          while($nt=mysqli_fetch_array($result)){     //Array or records stored in $nt
            echo '<option value="'.htmlspecialchars($nt['lnum']).'">'.htmlspecialchars($nt['lname']).'</option>';
          }
          echo "</select>";// Closing of list box
		
		  echo '<br />';
	      echo '<hr />';
      
	  
	  
  
          echo '<label for="hash">League Key:</label>';
		  ?>
		   <input type="text" id="hashnum" name="hashvalue" value="" /><br />
		  <?php 
		  echo '<input type="submit" value="Join" name="submit" />';
          echo '<br />';
          echo '<hr />';
		  //  These fields do not have an input box, so hide then and the form submit will grab the value
           // echo '<input type="hidden"     name ="lnum"   value="' . $nt['lnum']. '" />';
              echo '<input type="hidden"     name ="lnum"   value="5" />';
		} 
		else {
		    echo '<p>There are no invitations to any leagues</p>';
		}
		mysqli_close($con);
	?>
  </form>
 	   <br />
	 
 <!--      <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>   -->
	</div> 
  
</body> 
</html>