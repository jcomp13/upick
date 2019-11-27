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
<h2>UPick Football - Initialize Team Recs </h2>

<?php
require_once('connectvars.php');


session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
    }


   include_once 'foot_nav.php'; 



	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");
	$query="select * from footconfig where cfgid = 1";
    $cfg = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
    $cfg_rec=mysqli_fetch_assoc($cfg);
    $sys_year= $cfg_rec['curryear'];
	
	  $sql1="select tid from dim_teams where active=1";
    $result = mysqli_query ($dbc, $sql1) or die ("Error in query: $sql1 " . mysqli_error());	

    while($team=mysqli_fetch_array($result)){
	
       $sqlcheck = "select * from team_recs where teamid = " . $team['tid'] . " and tyear = '" . $sys_year . "'";
       $sqlamt = mysqli_query ($dbc, $sqlcheck) or die ("Error in query: $sqlcheck " . mysqli_error());
       $row = $sqlamt->fetch_row();
       if($row[0]  == 0) {
            $sqlupd = "insert into team_recs(teamid, win, loss, tie, cwin, closs, ctie, dwin, dloss, dtie, tyear)    
                       values (" . $team['tid'] . ", 0,0,0,0,0,0,0,0,0, " . $sys_year .")";
            mysqli_query($dbc, $sqlupd);
        
       }
  	}
	
   
    echo '<p>Team records are created</p>';  
    echo '<br />';
    echo '<hr />';

    mysqli_close($dbc);	


?>


</body> 
</html>