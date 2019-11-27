<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - Weekly User Picks</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  
  
  
  
</head>
<body>
<div class="container">
  <h2>UPick Football - Weekly User Picks</h2>
</div>

<?php
  require_once('connectvars.php');

session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
    }
    $owner = $_SESSION['id'];
?>


  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<div class="container">
	<?php
   include_once 'foot_nav.php'; 
?> 

	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="1" name="week">1</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="2" name="week">2</button>  	 
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="3" name="week">3</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="4" name="week">4</button>  		 
  	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="5" name="week">5</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="6" name="week">6</button>  	 
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="7" name="week">7</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="8" name="week">8</button>     
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="9" name="week">9</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="10" name="week">10</button>  	 
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="11" name="week">11</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="12" name="week">12</button>  		 
  	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="13" name="week">13</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="14" name="week">14</button>  	 
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="15" name="week">15</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="16" name="week">16</button> 
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="17" name="week">17</button>  		 
  	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="WD" name="week">WD</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="CW" name="week">CW</button>  	 
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="CC" name="week">CC</button>      
	   <button type="submit" class="btn btn-info" class="btn btn-primary btn-xs" value="SB" name="week">SB</button> 

    <br />
    <hr />


    </form>
	<?php 	 
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


 // check how many leagues the user is in
 //  $sql1="select * from userleague where uid=$owner and syear = '" . $sys_year ."'";  
 //  $result = mysqli_query ($dbc, $sql1) or die ("Error in query: $sql1 " . mysqli_error());
 //  $num_results = mysqli_num_rows($result); 
 //  if ($num_results > 1)   //  multiple leagues for user 
 //  {      
 //       echo '<p>multiple league user</p>';
 //  }
 //  else                    // single league user
 //  {
 //     $leagueinfo=mysqli_fetch_assoc($result);
 //     $leaguenum = $leagueinfo['league'];	

//  now we hve all the records display the grid

   $query = "select * from multileague where uid=$owner and syear = $sys_year";
   $result = mysqli_query ($dbc, $query) or die ("Error in league query: $query " . mysqli_error());
   $currleague=mysqli_fetch_array($result);
   $leaguenum = $currleague['selectleague'];

   $query = "select * from football_league where lnum=$leaguenum and year = $sys_year";
   $result = mysqli_query ($dbc, $query) or die ("Error in league query: $query " . mysqli_error());
   $leaguename=mysqli_fetch_array($result); 
   echo '<h3>'. $leaguename['lname'] . '</h3>';

    
      $sqlgames="select ht.optname as home, vt.optname as vis from schedule s
                    join dim_teams ht on s.hteam=ht.tid
                    join dim_teams vt on s.vteam=vt.tid
                    where s.seasonyear=$sys_year
                    and s.week=$wk1
                    order by s.gdate, s.gamenum";
	  $games = mysqli_query ($dbc, $sqlgames) or die ("Error in query: $sqlgames " . mysqli_error());
	  $game=0;
	  // create the table header	
 
echo '<div class="table-responsive">';	  
      echo '<table  class="table table-bordered">';
	  echo "<tr>";
      echo   "<td>User</td>";		 
	  
	  while($gament=mysqli_fetch_array($games)){
	     echo '<td>' . $gament['vis'] . '<br />vs<br />' . $gament['home'] . '</td>';
		 $game++;
	  }
	  echo '</tr>';
	   
	  $sqlpicks="SELECT p.*, s.gdate, fu.uname,
        if (p.gpick=1,upper(h.optname),v.optname  )as gamepick, s.favorite
            FROM pick p 
            join schedule s on p.gamenum=s.gamenum and s.week=p.sweek and p.gamenum=s.gamenum
	        join footballuser fu on fu.uid=p.userid
            join dim_teams h on h.tid=s.hteam
            join dim_teams v on v.tid=s.vteam
            WHERE p.syear=$sys_year 
            and s.seasonyear=$sys_year
            and p.sweek=$wk1
            and p.league =$leaguenum
            order by p.userid, s.gdate, p.gamenum";						   
	  $picks = mysqli_query ($dbc, $sqlpicks) or die ("Error in query: $sqlpick " . mysqli_error());

	  $linecount=1;
	   while($picknt=mysqli_fetch_array($picks)){ 
	      if ($linecount==1){
		     echo '<tr>';	
             echo '<td>' . $picknt['uname'] . '</td>';
	      }
	      if ($picknt['locked']==1) {
	        if ($picknt['result']==0) {         // game not complete
	         if ($picknt['gpick'] == $picknt['favorite'] )
               echo '<td class="favpick">' . $picknt['gamepick'] . '</td>';
	         else
               echo '<td class="dogpick">' . $picknt['gamepick'] . '</td>';
             }  		
             else {    // game over display results 
	            if ($picknt['result'] == 1 )
                  echo '<td class="winpick">' . $picknt['gamepick'] . '</td>';
	            else
                  echo '<td class="lostpick">' . $picknt['gamepick'] . '</td>';
	          }
	      }
	      else {
	         echo '<td>No Pick</p>';
	      }
				
	      $linecount++;
	      if ($linecount>$game){
		    $linecount=1;
	        echo '</tr>';					
	     }
       }
	   echo '</table>';
	echo  '</div>'; 
	
       mysqli_close($dbc);	
   }
//} 
	
?>	
 
	   <br />
       <hr />
	 
 <!--      <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>    -->
	</div>


</body> 
</html>