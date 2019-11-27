<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - User Standings</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</script>
</head>

<body>
<div class="container">
  <h2>UPick Football - User Standings </h2>

<?php

require_once('connectvars.php');
 session_start();
   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }
    $owner = $_SESSION['id'];
 ?>
<?php
   include_once 'foot_nav.php'; 
?>
 
<hr />
<?php

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//  get current configurations
$query="select * from footconfig where cfgid = 1";
$cfg = mysqli_query ($dbc, $query) or die ("Error in config query: $query " . mysqli_error() . " ". $query );
$cfg_rec=mysqli_fetch_assoc($cfg);
$sys_year= $cfg_rec['curryear'];
$sys_week= $cfg_rec['currweek'];

   $query = "select * from multileague where uid=$owner and syear = $sys_year";
   $result = mysqli_query ($dbc, $query) or die ("Error in league query: $query " . mysqli_error());
   $currleague=mysqli_fetch_array($result);
   $selleague = $currleague['selectleague'];

   $query = "select * from football_league where lnum=$selleague and year = $sys_year";
   $result = mysqli_query ($dbc, $query) or die ("Error in league query: $query " . mysqli_error());
   $leaguename=mysqli_fetch_array($result);


	 echo '<div class="container">';  

	    $sqlplay="SELECT ul.wins+ul.loses as gamesPlayed
                        FROM userleague ul
                        join footballuser fu on ul.uid=fu.uid
                        WHERE ul.league = $selleague
                        and syear = $sys_year";
      $tmpPlay = mysqli_query ($dbc, $sqlplay) or die ("Error in user query: $sqlplay " . mysqli_error() . " ". $sqlplay);
      $complete=mysqli_fetch_array($tmpPlay);
      if ($complete['gamesPlayed'] > 0) {

///            if ($sys_week > 1) {	   

			$sqlrate="SELECT fu.uname, ul.*, (ul.wins/(ul.wins+ul.loses)) as average FROM userleague ul
                        join footballuser fu on ul.uid=fu.uid
                        WHERE ul.league = $selleague
                        and syear = $sys_year
                        and (ul.wins >0 or ul.loses > 0)
                       order by average desc";	
  
          }
           else {
                       $sqlrate="SELECT fu.uname, ul.*, 0 as average FROM userleague ul
                        join footballuser fu on ul.uid=fu.uid
                        WHERE ul.league = $selleague
                        and syear = $sys_year
                        order by average desc";	
           }
            $rate = mysqli_query ($dbc, $sqlrate) or die ("Error in user query: $sqlpick " . mysqli_error() . " ". $sqlrate);
            echo '<h3>'. $leaguename['lname'] . '</h3>';
            echo '<table  class="table  table-responsive table-striped ratetable">';
            echo "<tr>";
            echo "<td>User</td>";
            echo "<td>Wins</td>";
            echo "<td>Loses</td>";
            echo "<td>Ties</td>";
            echo "<td>Average</td>";
            echo "</tr>";			
			while($standings=mysqli_fetch_array($rate)){ 
				   echo '<tr>';			   
                  echo '<td><strong>' . $standings['uname'] . '</td>';
                   echo '<td>' . $standings['wins'] . '</td>';
                   echo '<td>' . $standings['loses'] . '</td>';
                   echo '<td>' . $standings['ties'] . '</td>';
                  echo '<td>' . $standings['average'] . '</td>';				   
     			   echo '</tr>';
			}
			echo '</table>';
?>

    <br />
    <hr />
	 <!-- <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>  -->

 </div>	 
</body>

</html>

