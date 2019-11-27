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

    if (isset($_POST['week'])) {
      switch ($_POST['week']) {
       case '1':
       $wk1=1;
       break;	
       case '2':
       $wk1=2;
       break;
       case '3':
       $wk1=3;
       break;	
       case '4':
       $wk1=4;
       break;
       case '5':
       $wk1=5;			
       break;	
       case '6':
       $wk1=6;			
       break;
       case '7':
       $wk1=7;			
       break;	
       case '8':
       $wk1=8;	   
       break;
       case '9':
       $wk1=9;
       break;	
       case '10':
       $wk1=10;
       break;
       case '11':
       $wk1=11;
       break;	
       case '12':
       $wk1=12;
       break;
       case '13':
       $wk1=13;
       break;	
       case '14':
       $wk1=14;
       break;
       case '15':
       $wk1=15;
       break;	
       case '16':
       $wk1=16;
       break;
       case '17':
       $wk1=17;
       break;	
       case 'WD':
       $wk1=18;
       break;
       case 'CW':
       $wk1=19;
       break;	
       case 'CC':
       $wk1=20;
       break;
       case 'SB':
       $wk1=21;
       break;
     }

     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");
     $query="select * from footconfig where cfgid = 1";
     $cfg = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
     $cfg_rec=mysqli_fetch_assoc($cfg);
     $sys_year= $cfg_rec['curryear'];

     $query="select distinct(lnum) from football_league where year = $sys_year";
     $q1 = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
     while($leagueloop=mysqli_fetch_array($q1)){
      $query="select distinct(uid) from userleague where league = " . $leagueloop['lnum'];
      $lgeuser = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
      while ($gameres = mysqli_fetch_array($lgeuser)){

 ////////////    block to get wins loses and ties  
       $resquery = "select 
       (select count(gamenum) from pick
       where userid = " . $gameres['uid'] . "
       and league = " . $leagueloop['lnum'] ."
       and result = 1
       and gamenum in (select gamenum from schedule where week = " . $wk1 .  " and seasonyear='" . $sys_year  . "')) as winnum,
       (select count(gamenum) from pick
       where userid = " . $gameres['uid'] . "
       and league = " . $leagueloop['lnum'] ."
       and result = 2
       and gamenum in (select gamenum from schedule where week = " . $wk1 .  " and seasonyear='" . $sys_year  . "')) as lossnum,
       (select count(gamenum) from pick
       where userid = " . $gameres['uid'] . "
       and league = " . $leagueloop['lnum'] ."
       and result = 3
       and gamenum in (select gamenum from schedule where week = " . $wk1 .  " and seasonyear='" . $sys_year  . "')) as tienum";                  
       $numres = mysqli_query ($dbc, $resquery) or die ("Error in query: $wquery " . mysqli_error());  
       $info=mysqli_fetch_assoc($numres);


     //update or create result record
       $qcheck="select * from football_results where weeknum = " . $wk1 .  
       " and syear='" . $sys_year  ."' and uid = " . $gameres['uid'] . " and leaguenum = " . $leagueloop['lnum'] ;
       $result = mysqli_query ($dbc, $qcheck) or die ("Error in query: $qcheck " . mysqli_error());
       $rec_exist = mysqli_num_rows($result); 
       if ($rec_exist > 0) { 
        $lgnum=$leagueloop['lnum'];
        $user=$gameres['uid'];	
        $updquery="update football_results set win=" . $info['winnum'] . ", loss=". $info['lossnum'] . ", ties=" . $info['tienum'] .
        "where weeknum = " . $wk1 .  " and syear='" . $sys_year  ."' and uid = " . $gameres['uid'] . 
        " and leaguenum = " . $leagueloop['lnum'] ;
				   mysqli_query($dbc, $updquery);	
      }
      else { 
        $lgnum=$leagueloop['lnum'];
        $user=$gameres['uid'];
        $updquery="insert into football_results (syear,weeknum, leaguenum, uid, win, loss, ties) 
        values ('$sys_year','$wk1','$lgnum','$user', ". $info['winnum'] . ", " . $info['lossnum'] . ", " . $info['tienum'] .")";
				 mysqli_query($dbc, $updquery);	 
      }			


      //  now calculate totals
       $totalquery = "select * from football_results 
             where leaguenum = " . $leagueloop['lnum'] .
             " and syear= " . $sys_year . " and uid=" . $gameres['uid'] .
             " order by weeknum";

       $qtot = mysqli_query ($dbc, $totalquery) or die ("Error in query: $totalquery " . mysqli_error($dbc));
       $twin=0;
       $tloss=0;
       $ttie = 0;
       while($userec=mysqli_fetch_array($qtot)){
           $twin = $twin + $userec['win'];
           $tloss = $tloss + $userec['loss'];
           $ttie = $ttie + $userec['ties'];                     
       }
      $updsql = "update userleague set wins=". $twin. ", loses=" . $tloss . ",ties=" . $ttie . 
                " where uid=" . $gameres['uid'] .  " and league=" . $leagueloop['lnum'] . " and syear= '" . $sys_year ."'";
      mysqli_query($dbc, $updsql);          
    }

  }





  mysqli_close($dbc);	
  echo "Records are calculated";
}


?>
<?php
   include_once 'foot_nav.php'; 
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <?php


 echo  '<input type="submit" value="1" name="week" >';
 echo  '<input type="submit" value="2" name="week" >';
 echo  '<input type="submit" value="3" name="week" >';
 echo  '<input type="submit" value="4" name="week" />';
 echo  '<input type="submit" value="5" name="week" />';
 echo  '<input type="submit" value="6" name="week" />';
 echo  '<input type="submit" value="7" name="week" />';
 echo  '<input type="submit" value="8" name="week" />';
 echo  '<input type="submit" value="9" name="week" />';
 echo  '<input type="submit" value="10" name="week" />';
 echo  '<input type="submit" value="11" name="week" />';
 echo  '<input type="submit" value="12" name="week" />';
 echo  '<input type="submit" value="13" name="week" />';
 echo  '<input type="submit" value="14" name="week" />';
 echo  '<input type="submit" value="15" name="week" />';
 echo  '<input type="submit" value="16" name="week" />';
 echo  '<input type="submit" value="17" name="week" />';
 echo  '<input type="submit" value="WD" name="week" />';
 echo  '<input type="submit" value="CW" name="week" />';
 echo  '<input type="submit" value="CC" name="week" />';
 echo  '<input type="submit" value="SB" name="week" />';	  
 echo '<br />';
 echo '<hr />';


 echo '</form>';

 ?>
 <!-- <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>  -->
</body> 
</html>