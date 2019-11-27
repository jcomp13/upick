<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - Weekly Picks</title>
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

<h2>UPick Football - Weekly Picks </h2>

<?php
require_once('connectvars.php');
 
 session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.html';
      header('Location: ' . $home_url);
   }
    $owner = $_SESSION['id'];
 

   include_once 'foot_nav.php'; 
?>

<hr />
  
<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//  get current configurations
$query="select * from footconfig where cfgid = 1";
$cfg = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
$cfg_rec=mysqli_fetch_assoc($cfg);
$sys_year= $cfg_rec['curryear'];
$sys_week= $cfg_rec['currweek'];


 // check how many leagues the user is in
 //  $sql1="select * from userleague where uid=$owner and syear = $sys_year";  
 //  $result = mysqli_query ($dbc, $sql1) or die ("Error in query: $sql1 " . mysqli_error());
 //  $num_results = mysqli_num_rows($result); 
 //  if ($num_results > 1)   //  multiple leagues for user 
 //  {      
 //       echo '<p>multiple league user</p>';
 //  }
 //  else                    // single league user
 //  {
//	       echo '<p>single league user</p>'; 

    //   $leagueinfo=mysqli_fetch_assoc($result);
    //       $leaguenum = $leagueinfo['league'];

   $query = "select * from multileague where uid=$owner and syear = $sys_year";
   $result = mysqli_query ($dbc, $query) or die ("Error in league query: $query " . mysqli_error());
   $currleague=mysqli_fetch_array($result);
   $leaguenum = $currleague['selectleague'];

   $query = "select * from football_league where lnum=$leaguenum and year = $sys_year";
   $result = mysqli_query ($dbc, $query) or die ("Error in league query: $query " . mysqli_error());
   $leaguename=mysqli_fetch_array($result); 
   echo '<h3>'. $leaguename['lname'] . '</h3>';
			
			$sqlrate = "select syear, weeknum,leaguenum, ul.uid, win,loss,ties
            			from football_results ul
			            join footballuser fu on ul.uid=fu.uid
                        WHERE ul.leaguenum = " . $leaguenum . 
                        " and syear = '"  . $sys_year . 
                        "' order by weeknum,  ul.uid";	

		
			$sqlusers = "select uname, ul.uid from userleague ul 
			             join footballuser fu on ul.uid=fu.uid
			             where ul.league = " . $leaguenum . 
                        " and syear = '"  . $sys_year . 
                        "' order by ul.uid";


						
			$result = mysqli_query ($dbc, $sqlusers) or die ("Error in query: $sqlusers " . mysqli_error());
            $num_users = mysqli_num_rows($result); 			

            echo '<table  class="table table-bordered table-striped ratetable" border="1">';
            echo "<tr>";
            echo "<td>Week</td>";			
			
			while($usrname=mysqli_fetch_array($result)){			
               echo "<td>" . $usrname['uname'] . "</td>";
			}
            echo "</tr>";

	        $displayweek = 0;		
			$weekresult = mysqli_query ($dbc, $sqlrate) or die ("Error in query: $sqlrate " . mysqli_error());			
			while($usrres=mysqli_fetch_array($weekresult)){			
			      if ($displayweek <> $usrres['weeknum']){
					  if ($displayweek == 0){
						echo '<tr>';  
					  }
					  else {
						  echo '</tr>';
						  echo '<tr>';
				      }		  
					  $displayweek++;
					  echo '<td>' . $displayweek . '</td>';
				  }
				  if  ($usrres['ties']> 0) {
					  echo '<td>' . $usrres['win'] . '-' . $usrres['loss'] . '-' . $usrres['tie'] . '</td>';  
				  }
				  else {
					  echo '<td>' . $usrres['win'] . '-' . $usrres['loss'] . '</td>'; 
				  }
       //           echo '<td>' . $standings['loses'] . '</td>';
       //           echo '<td>' . $standings['Ties'] . '</td>';
       //           echo '<td>' . $standings['average'] . '</td>';	
			}	   
   		   echo '</tr>';
			echo '</table>';
//    }
?>

  
    <br />
    <hr />

<!--      <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>  -->
	 </div>
</body>
</html>
