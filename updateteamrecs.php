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
<h2>UPick Football - Update Team Recs </h2>

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
	
	$sql1="select tid from dim_teams";
    $result = mysqli_query ($dbc, $sql1) or die ("Error in query: $sql1 " . mysqli_error());	


    while($team=mysqli_fetch_array($result)){
	
   // Calculate the number of wins
       $sqlwin="SELECT count(gamenum) as wins
         FROM `schedule` WHERE seasonyear='" . $sys_year . "'
         and winner <> 0
         and ((hteam=" . $team['tid'] . " and winner=1)or (vteam=" . $team['tid']. " and winner=2))";
	   $teamwin = mysqli_query ($dbc, $sqlwin) or die ("Error in query: $sqlwin " . mysqli_error());
	   $num_win=mysqli_fetch_assoc($teamwin);

	 //Calculate the number of losses
       $sqlloss="SELECT count(gamenum) as loss
         FROM `schedule` WHERE seasonyear='" . $sys_year . "'
         and winner <> 0
         and ((hteam=" . $team['tid'] . " and winner=2)or (vteam=" . $team['tid']. " and winner=1))";
	   $teamloss = mysqli_query ($dbc, $sqlloss) or die ("Error in query: $sqlloss " . mysqli_error());
	   $num_loss=mysqli_fetch_assoc($teamloss);
  
	  // Calculate the number of ties
       $sqltie="SELECT count(gamenum) as tie
         FROM `schedule` WHERE seasonyear='" . $sys_year . "'
         and winner <> 0
         and ((hteam=" . $team['tid'] . " and winner=3)or (vteam=" . $team['tid']. " and winner=3))";
	   $teamtie = mysqli_query ($dbc, $sqltie) or die ("Error in query: $sqltie " . mysqli_error());
	   $num_tie=mysqli_fetch_assoc($teamtie);

	  
	  //Update the win-loss record
	   $sqlupd = "update team_recs  set 
               win = " . $num_win['wins'] .", 
               loss = " . $num_loss['loss'] . ",
               tie = " . $num_tie['tie'] .
		 " where teamid = " . $team['tid'] . " and tyear = '" . $sys_year ."'";
	    mysqli_query($dbc, $sqlupd) or die ("Error in query: $sqlupd " . mysqli_error());

    // do conference and division

    $query = "select conferenceid, divisionid from dim_teams where tid=" . $team['tid'];
    $dresult = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
    $loc=mysqli_fetch_array($dresult);  
 
    $cwin =0;
    $clos=0;
    $dwin=0;
    $dlos=0;
    $ctie=0;
    $dtie=0;

//  when team is home
    $oteam=0;
    $query = "select * from schedule where seasonyear= " . $sys_year . " and winner <> 0  and hteam=" . $team['tid'] .' and week <18';
    $schedres = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());

    while($games=mysqli_fetch_array($schedres)){
          $query = "select conferenceid, divisionid from dim_teams where tid=" . $games['vteam'];
          $tmpsql = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
          $vloc=mysqli_fetch_array($tmpsql);
          $oteam=1;
        if (($vloc['divisionid']==$loc['divisionid']) and ($vloc['conferenceid']==$loc['conferenceid'])) {
           if ($games['winner']==1 ){
              $cwin++;
              $dwin++;
            }
            else if ($games['winner']==2 ){
              $clos++;
              $dlos++;
           }
           else {
             $ctie++;
             $dtie++;
           }
        }
        else if ($vloc['conferenceid']==$loc['conferenceid'] ) {
           if ($games['winner']==1 ){
             $cwin++;
           }  
           else if ($games['winner']==2 ){
             $clos++;
           }
           else {
             $ctie++;
           }
        }
   }


//  when team is road
    $oteam=0;
    $query = "select * from schedule where seasonyear= " . $sys_year . " and winner <> 0  and vteam=" . $team['tid'] . ' and week < 18';
    $schedres = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());

    while($games=mysqli_fetch_array($schedres)){
          $query = "select conferenceid, divisionid from dim_teams where tid=" . $games['hteam'];
          $tmpsql = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
          $hloc=mysqli_fetch_array($tmpsql);
          $oteam=1;
        if (($hloc['divisionid']==$loc['divisionid']) and ($hloc['conferenceid']==$loc['conferenceid'])) {
           if ($games['winner']==2 ){
              $cwin++;
              $dwin++;
            }
            else if ($games['winner']==1 ){
              $clos++;
              $dlos++;
           }
           else {
             $ctie++;
             $dtie++;
           }
        }
        else if ($hloc['conferenceid']==$loc['conferenceid'] ) {
           if ($games['winner']==2 ){
             $cwin++;
           }  
           else if ($games['winner']==1 ){
             $clos++;
           }
           else {
             $ctie++;
           }
        }
   }


    //Update the win-loss record
     $sqlupd = "update team_recs  set 
               cwin = " . $cwin .", 
               closs = " . $clos . ",
               ctie = " . $ctie . ",
               dwin = " . $dwin .", 
               dloss = " . $dlos . ",
               dtie = " . $dtie . 
     " where teamid = " . $team['tid'] . " and tyear = '" . $sys_year ."'";
      mysqli_query($dbc, $sqlupd) or die ("Error in query: $sqlupd " . mysqli_error());

 //     echo $sqlupd . '<br/>'; 






	  
	}
	
   
    echo '<p>Records are updated</p>';  
    echo '<br />';
    echo '<hr />';

    mysqli_close($dbc);	

   // echo '<p><a href="mainmenu.php">&lt;&lt; Back to main page</a></p>';

?>

 <!--  <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>   -->

</body> 
</html>