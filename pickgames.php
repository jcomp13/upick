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
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }
    $owner = $_SESSION['id'];
 
    $save_allowed = 1;
 
 
   $f1=0;
   $f2=0;
   $f3=0;
   $f4=0;
   $f5=0;
   $f6=0;
   $f7=0;
   $f8=0;
   $f9=0;
   $f10=0;
   $f11=0;
   $f12=0;
   $f13=0;
   $f14=0;
   $f15=0;
   $f16=0;
;   

if (isset($_POST['submit'])) {
       $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	   $league = mysqli_real_escape_string($dbc, trim($_POST['pass_league']));	
	   $lyear = mysqli_real_escape_string($dbc, trim($_POST['pass_year']));	
	   $lweek = mysqli_real_escape_string($dbc, trim($_POST['pass_week']));
	   
	   
	   
	
        if (isset($_POST['1'])){
           $f1 = $_POST['1'];    // if 1 is returned the Home team is picked if 2 is returned the visitor is selected
           $g1 = $_POST['game1'];    // holds the actual game number
        }		
        if (isset($_POST['2'])){		
           $f2 = $_POST['2'];
           $g2 = $_POST['game2'];
        }		
        if (isset($_POST['3'])){		
           $f3 = $_POST['3'];
           $g3 = $_POST['game3'];		
        }		
        if (isset($_POST['4'])){		
           $f4 = $_POST['4'];
           $g4 = $_POST['game4'];		
        }		
        if (isset($_POST['5'])){
		  $f5 = $_POST['5'];
          $g5 = $_POST['game5'];
        }		
        if (isset($_POST['6'])){		
           $f6 = $_POST['6'];
           $g6 = $_POST['game6'];		
        }		
        if (isset($_POST['7'])){		
           $f7 = $_POST['7'];
           $g7 = $_POST['game7'];		
        }		
        if (isset($_POST['8'])){		
           $f8 = $_POST['8'];
           $g8 = $_POST['game8'];		
        }		
        if (isset($_POST['9'])){		
           $f9 = $_POST['9'];
           $g9 = $_POST['game9'];		
        }		
        if (isset($_POST['10'])){		
           $f10 = $_POST['10'];
           $g10 = $_POST['game10'];
        }		
        if (isset($_POST['11'])){		
           $f11 = $_POST['11'];
           $g11 = $_POST['game11'];		
        }		
        if (isset($_POST['12'])){		
           $f12 = $_POST['12']; 
           $g12 = $_POST['game12'];		
        }		
        if (isset($_POST['13'])){		
           $f13 = $_POST['13'];
           $g13 = $_POST['game13'];		
        }		
        if (isset($_POST['14'])){		
           $f14 = $_POST['14'];
           $g14 = $_POST['game14'];		
        }		
        if (isset($_POST['15'])){		
           $f15 = $_POST['15'];
           $g15 = $_POST['game15'];		
        }		
        if (isset($_POST['16'])){		
           $f16 = $_POST['16'];
           $g16 = $_POST['game16'];
		}
		
	
		
		
		
		if ($f1==1 or $f1==2) 
		{
			$sql = "update pick set gpick = $f1 where userid=$owner and league= $league and gamenum=$g1  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			if (isset($_POST['check1'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g1  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}
		if ($f2==1 or $f2==2) 
		{
			$sql = "update pick set gpick = $f2 where userid=$owner and league= $league and gamenum=$g2  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			if (isset($_POST['check2'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g2  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}
		}		   
		if ($f3==1 or $f3==2) 
		{
			$sql = "update pick set gpick = $f3 where userid=$owner and league= $league and gamenum=$g3  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			if (isset($_POST['check3'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g3  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}		
		}
		if ($f4==1 or $f4==2) 
		{
			$sql = "update pick set gpick = $f4 where userid=$owner and league= $league and gamenum=$g4  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			if (isset($_POST['check4'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g4  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}		
		if ($f5==1 or $f5==2) 
		{
			$sql = "update pick set gpick = $f5 where userid=$owner and league= $league and gamenum=$g5  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check5'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g5  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}
		if ($f6==1 or $f6==2) 
		{
			$sql = "update pick set gpick = $f6 where userid=$owner and league= $league and gamenum=$g6  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check6'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g6  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}		
		}		   
		if ($f7==1 or $f7==2) 
		{
			$sql = "update pick set gpick = $f7 where userid= $owner and league= $league and gamenum=$g7  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check7'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g7  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}
		if ($f8==1 or $f8==2) 
		{
			$sql = "update pick set gpick = $f8 where userid=$owner and league= $league and gamenum=$g8  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check8'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g8  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}		
		
		if ($f9==1 or $f9==2) 
		{
			$sql = "update pick set gpick = $f9 where userid=$owner and league= $league and gamenum=$g9  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check9'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g9  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}
		if ($f10==1 or $f10==2) 
		{
			$sql = "update pick set gpick = $f10 where userid=$owner and league= $league and gamenum=$g10  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check10'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g10  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}		   
		if ($f11==1 or $f11==2) 
		{
			$sql = "update pick set gpick = $f11 where userid=$owner and league= $league and gamenum=$g11  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check11'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g11  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}
		if ($f12==1 or $f12==2) 
		{
			$sql = "update pick set gpick = $f12 where userid=$owner and league= $league and gamenum=$g12  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check12'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g12  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}		
		if ($f13==1 or $f13==2) 
		{
			$sql = "update pick set gpick = $f13 where userid=$owner and league= $league and gamenum=$g13  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check13'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g13  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}
		if ($f14==1 or $f14==2) 
		{
			$sql = "update pick set gpick = $f14 where userid=$owner and league= $league and gamenum=$g14  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			if (isset($_POST['check14'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g14  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}		   
		if ($f15==1 or $f15==2) 
		{
			$sql = "update pick set gpick = $f15 where userid=$owner and league= $league and gamenum=$g15  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check15'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g15  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}
		if ($f16==1 or $f16==2) 
		{
			$sql = "update pick set gpick = $f16 where userid=$owner and league= $league and gamenum=$g16  and syear='$lyear' and sweek=$lweek ";
			mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
			if (isset($_POST['check16'])) {
				$sql = "update pick set locked=1 where userid=$owner and league= $league and gamenum=$g16  and syear='$lyear' and sweek=$lweek ";
			    mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
			}			
		}		
		
	mysqli_close($dbc); 
	
     echo '<p>Selections are saved</p>';

}

?>
<?php
   include_once 'foot_nav.php'; 
?>

<hr />

   <form enctype="multipart/form-data"  name="frm" id="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//  get current configurations
$query="select * from footconfig where cfgid = 1";
$cfg = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
$cfg_rec=mysqli_fetch_assoc($cfg);
$sys_year= $cfg_rec['curryear'];
$sys_week= $cfg_rec['currweek'];


 // check how many leagues the user is in
//   $sql1="select * from userleague where uid=$owner and syear = $sys_year";  
//   $result = mysqli_query ($dbc, $sql1) or die ("Error in query: $sql1 " . mysqli_error());
//   $num_results = mysqli_num_rows($result); 
//   if ($num_results > 1)   //  multiple leagues for user 
//   {      
//        echo '<p>multiple league user</p>';
//   }
//   else                    // single league user
//   {
//	       echo '<p>single league user</p>'; 
//		   $leagueinfo=mysqli_fetch_assoc($result);
//           $leaguenum = $leagueinfo['league'];	
		   //echo '<p>league = ' . $leaguenum . '</p>';

   $query = "select * from multileague where uid=$owner and syear = $sys_year";
   $result = mysqli_query ($dbc, $query) or die ("Error in league query: $query " . mysqli_error());
   $currleague=mysqli_fetch_array($result);
   $leaguenum = $currleague['selectleague'];

   $query = "select * from football_league where lnum=$leaguenum and year = $sys_year";
   $result = mysqli_query ($dbc, $query) or die ("Error in league query: $query " . mysqli_error());
   $leaguename=mysqli_fetch_array($result); 
   echo '<h3>'. $leaguename['lname'] . '</h3>';




		   
		   // check if picks records are created
		     $sql2="select * from pick where userid=$owner and syear=$sys_year and sweek=$sys_week and league=$leaguenum";  
             $result = mysqli_query ($dbc, $sql2) or die ("Error in query: $sql2 " . mysqli_error());
             $num_results = mysqli_num_rows($result);
             if ($num_results < 1)                      // pick records do not exist
			 {
				 // echo '<p>creating schedule</p>';
				 $sql3="select * from schedule where seasonyear=$sys_year and week=$sys_week";
				 $sched = mysqli_query ($dbc, $sql3) or die ("Error in query: $sql3 " . mysqli_error());
  
			     while($nt=mysqli_fetch_array($sched)){ 
                                if ($nt['odd'] === NULL) {
                                     $save_allowed = 0;
                                     echo '<p>The odds are not yet entered, please try again later</p>';
                                     break;
                                }
                                else {
         			  	$sql4="insert into pick (userid, league, gamenum, result, locked, gpick, syear, sweek) values($owner, $leaguenum, " . $nt['gamenum']. ",  0, FALSE, 0, $sys_year, $sys_week)";
	        				mysqli_query ($dbc, $sql4) or die ("Error in query: $sql4 " . mysqli_error());
                                }
			      }				 	 
			 }
			 
			 
			 //  now we hve all the records display the grid
			 //$sqlpick="SELECT sc.* , UPPER( ht.optname ) AS hometeam, vt.optname AS visteam, gpick
             //              FROM schedule sc
             //              JOIN dim_teams ht ON ht.tid = sc.hteam
             //              JOIN dim_teams vt ON vt.tid = sc.vteam
             //              JOIN pick pk ON pk.syear = sc.seasonyear
             //              AND pk.sweek = sc.week
             //              AND pk.gamenum = sc.gamenum
             //              WHERE sc.seasonyear = $sys_year
             //              AND sc.week =$sys_week
             //              AND pk.userid =$owner
             //              AND league =$leaguenum";
						   
			$sqlpick="SELECT sc.* , UPPER( ht.optname ) AS hometeam, vt.optname AS visteam, gpick, locked,
                               htr.win as hwin, htr.loss as hloss, htr.tie as htie,
                               htr.cwin as hcwin, htr.closs as hcloss, htr.ctie as hctie,
                               htr.dwin as hdwin, htr.dloss as hdloss, htr.dtie as hdtie,
                               vtr.win as vwin, vtr.loss as vloss, vtr.tie as vtie,
                               vtr.cwin as vcwin, vtr.closs as vcloss, vtr.ctie as vctie,
                               vtr.dwin as vdwin, vtr.dloss as vdloss, vtr.dtie as vdtie
                           FROM schedule sc
                           JOIN dim_teams ht ON ht.tid = sc.hteam
                           JOIN dim_teams vt ON vt.tid = sc.vteam
                           JOIN pick pk ON pk.gamenum = sc.gamenum and pk.syear=sc.seasonyear and pk.sweek=sc.week
                           join team_recs htr on htr.teamid=sc.hteam and htr.tyear=$sys_year
                           join team_recs vtr on vtr.teamid=sc.vteam and vtr.tyear=$sys_year
                           WHERE sc.seasonyear = $sys_year
                           AND sc.week =$sys_week
                           AND pk.userid =$owner
                           AND league =$leaguenum
                           order by sc.gdate, sc.gamenum";						   
			   
						   
			$pick = mysqli_query ($dbc, $sqlpick) or die ("Error in query: $sqlpick " . mysqli_error());

            echo '<table class="table table-bordered picktable">';
            echo "<tr>";
            echo "<td>Date</td>";
            echo "<td></td>";			
            echo "<td>Favorite</td>";
            echo "<td>Record</td>";
            echo "<td>Odds</td>";
            echo "<td>Underdog</td>";
            echo "<td>Record</td>";
            echo "<td></td>";
			echo "<td>Freeze Pick</td>";
            echo "<td>Pick</td>";			
            echo "</tr>";			
			
			
			$linecount=1;
			while($picknt=mysqli_fetch_array($pick)){ 
			    $games[$linecount] = array($picknt['gamenum']); 
			    if ($picknt['favorite']==1){
			       //echo '<tr name="gamenum"' .  $picknt['gamenum'].'>';
				   echo '<tr>';			   
                   echo '<td><strong>' . $picknt['gdate'] . '</td>';
				   if ($picknt['locked'] == 1 )
					   echo '<td></td>';
				   else {
				      echo '<td><input type="radio" name="'. trim($linecount) .'" value="1" id="q7" ';
				         if ($picknt['gpick']==1) {echo "checked";}
				      echo '></td>';
				   }  
                   echo '<td><strong>' . $picknt['hometeam'] . '</td>';
				   if ($picknt['htie']==0) {
				         echo '<td><strong>' . $picknt['hwin'] . '-' .  $picknt['hloss']  .'</td>';				   
				   }
                   else {
				         echo '<td><strong>' . $picknt['hwin'] . '-' .  $picknt['hloss']  . '-' . $picknt['htie']  .  '</td>';						   
				   }				   
				   echo '<td><strong>' . $picknt['odd'] . '</td>';
                   echo '<td><strong>' . $picknt['visteam'] . '</td>';
				   if ($picknt['vtie']==0) {
				         echo '<td><strong>' . $picknt['vwin'] . '-' .  $picknt['vloss']  .'</td>';				   
				   }
                   else {
				         echo '<td><strong>' . $picknt['vwin'] . '-' .  $picknt['vloss']  . '-' . $picknt['vtie']  .  '</td>';						   
				   }	
				   if ($picknt['locked'] == 1 ) {
					   echo '<td></td>';        // Pick box
    				   echo '<td></td>';        // Freeze Check					   
				   }
				   else {				   
                       echo '<td><input type="radio" name="'. trim($linecount) .'" value="2" id="q7"  ';
				         if ($picknt['gpick']==2) {echo "checked";}
				        echo '></td>';
					    echo '<td><input type="checkbox" name="check' . trim($linecount) .'"</td>';						
				   }						
				}  
				else
				{
			       echo '<tr>';
                   echo '<td><strong>' . $picknt['gdate'] . '</td>';
				   if ($picknt['locked'] == 1 )
					   echo '<td></td>';
				   else {				   
	                  echo '<td><input type="radio" name="'. trim($linecount) .'" value="2" id="q7" ';
				         if ($picknt['gpick']==2) {echo "checked";}
				       echo '></td>';
				   }					   
                   echo '<td><strong>' . $picknt['visteam'] . '</td>';
					   if ($picknt['vtie']==0) {
				         echo '<td><strong>' . $picknt['vwin'] . '-' .  $picknt['vloss']  .'</td>';				   
				   }
                   else {
				         echo '<td><strong>' . $picknt['vwin'] . '-' .  $picknt['vloss']  . '-' . $picknt['vtie']  .  '</td>';						   
				   }								   
    			   echo '<td><strong>' . $picknt['odd'] . '</td>';
                   echo '<td><strong>' . $picknt['hometeam'] . '</td>';
				   if ($picknt['htie']==0) {
				         echo '<td><strong>' . $picknt['hwin'] . '-' .  $picknt['hloss']  .'</td>';				   
				   }
                   else {
				         echo '<td><strong>' . $picknt['hwin'] . '-' .  $picknt['hloss']  . '-' . $picknt['htie']  .  '</td>';						   
				   }
				   if ($picknt['locked'] == 1 ) {
					   echo '<td></td>';        // Pick box
    				   echo '<td></td>';        // Freeze Check
				   }
				   else {				   
	                  echo '<td><input type="radio" name="'. trim($linecount) .'" value="1" id="q7" ';
				          if ($picknt['gpick']==1) {echo "checked";}
				      echo '></td>';
					  echo '<td><input type="checkbox" name="check' . trim($linecount) .'"</td>';
					  
				   }					  
    			}
				if ($picknt['locked'] == 1 )
					
				
//				   if ($picknt[favorite]==1){
					   if ($picknt['gpick']==1)
						   echo '<td>' . $picknt['hometeam'] . '</td>';
					   else 
						   echo '<td>' . $picknt['visteam'] . '</td>';
//				   }
//				   else {
//					    if ($picknt['gpick']==2)
//						    echo '<td>' . $picknt['visteam'] . '</td>';
//						else
//						    echo '<td>' . $picknt['hometeam'] . '</td>';
//				   }
					
				else 
					echo '<td></td>';
				?>
				<td style="display:none;"><input type="text" id='gamenum' class="text-input" autocomplete="off" 
                             name="<?php echo 'game' . $linecount; ?>"  maxlength="4"  value= <?php echo $picknt["gamenum"]; ?> > </td>
				<?php
				echo '</tr>';
				
				$linecount++;
			}
			echo '</table>';
            if ($save_allowed == 1) {
               echo  '<input type="submit" value="save" name="submit" />';
           }
//   }
?>
 
 
	 <?php
	   echo '<input type="hidden"     name ="pass_league"   value="' . $leaguenum . '" />';
	   echo '<input type="hidden"     name ="pass_year"   value="' . $sys_year . '" />';	   
	   echo '<input type="hidden"     name ="pass_week"   value="' . $sys_week . '" />';   
      ?>
</form>

	   <br />
       <hr />
	 
   <!--    <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>  -->
	</div>



</body>
</html>
