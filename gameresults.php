<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - Game Results</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</head>
<body>
<div class="container">
<h2>UPick Football - Game Results</h2>

<?php
require_once('connectvars.php');
require_once('foot_util.php');
 
 session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }
    $owner = $_SESSION['id'];
 
 


if (isset($_POST['submit'])) {
       $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//	   $league = mysqli_real_escape_string($dbc, trim($_POST['pass_league']));	
	   $lyear = mysqli_real_escape_string($dbc, trim($_POST['pass_year']));	
	   $lweek = mysqli_real_escape_string($dbc, trim($_POST['pass_week']));

	if (isset($_POST['check1'])) {	   
        $f1 = $_POST['fscore1'];
	    $u1 = $_POST['uscore1'];		
        $g1 = $_POST['game1'];    // holds the actual game number		
	    $v1 = $_POST['fav1'];    // holds the favorite 1 = home 2 = visitor		
    }
	if (isset($_POST['check2'])) {		
        $f2 = $_POST['fscore2'];
        $u2 = $_POST['uscore2'];		
        $g2 = $_POST['game2'];		
        $v2 = $_POST['fav2'];	
    }
	if (isset($_POST['check3'])) {
        $f3 = $_POST['fscore3'];
        $u3 = $_POST['uscore3'];		
        $g3 = $_POST['game3'];		
        $v3 = $_POST['fav3'];
    }
	if (isset($_POST['check4'])) {
        $f4 = $_POST['fscore4'];
        $u4 = $_POST['uscore4'];		
        $g4 = $_POST['game4'];		
        $v4 = $_POST['fav4'];
    }
	if (isset($_POST['check5'])) {
        $f5 = $_POST['fscore5'];
        $u5 = $_POST['uscore5'];		
        $g5 = $_POST['game5'];		
        $v5 = $_POST['fav5'];
    }
	if (isset($_POST['check6'])) {	
        $f6 = $_POST['fscore6'];
        $u6 = $_POST['uscore6'];		
        $g6 = $_POST['game6'];		
        $v6 = $_POST['fav6'];
    }
	if (isset($_POST['check7'])) {
        $f7 = $_POST['fscore7'];
        $u7 = $_POST['uscore7'];		
        $g7 = $_POST['game7'];		
        $v7 = $_POST['fav7'];
    }
	if (isset($_POST['check8'])) {		
        $f8 = $_POST['fscore8'];
        $u8 = $_POST['uscore8'];		
        $g8 = $_POST['game8'];		
        $v8 = $_POST['fav8'];		
    }
	if (isset($_POST['check9'])) {
        $f9 = $_POST['fscore9'];
        $u9 = $_POST['uscore9'];		
        $g9 = $_POST['game9'];		
        $v9 = $_POST['fav9'];
    }
	if (isset($_POST['check10'])) {		
        $f10 = $_POST['fscore10'];
        $u10 = $_POST['uscore10'];		
        $g10 = $_POST['game10'];		
        $v10 = $_POST['fav10'];	
    }
	if (isset($_POST['check11'])) {
        $f11 = $_POST['fscore11'];
        $u11 = $_POST['uscore11'];		
        $g11 = $_POST['game11'];		
        $v11 = $_POST['fav11'];	
    }
	if (isset($_POST['check12'])) {
        $f12 = $_POST['fscore12'];
        $u12 = $_POST['uscore12'];		
        $g12 = $_POST['game12'];		
        $v12 = $_POST['fav12'];		
    }
	if (isset($_POST['check13'])) {
        $f13 = $_POST['fscore13'];
        $u13 = $_POST['uscore13'];		
        $g13 = $_POST['game13'];		
        $v13 = $_POST['fav13'];			
    }
	if (isset($_POST['check14'])) {		
        $f14 = $_POST['fscore14'];
        $u14 = $_POST['uscore14'];		
        $g14 = $_POST['game14'];		
        $v14 = $_POST['fav14'];	
    }
	if (isset($_POST['check15'])) {		
        $f15 = $_POST['fscore15'];
        $u15 = $_POST['uscore15'];		
        $g15 = $_POST['game15'];		
        $v15 = $_POST['fav15'];	
    }
	if (isset($_POST['check16'])) {
        $f16 = $_POST['fscore16'];
        $u16 = $_POST['uscore16'];		
        $g16 = $_POST['game16'];		
        $v16 = $_POST['fav16'];	
    }
	
		//  Now have all the information, enter the results into the database
//		$f1 = str_replace(' ', '', $f1);
//		if ($f1 !== '')        // date is present
		if (isset($_POST['check1'])) 
		{
			update_game($dbc, $lweek, $lyear, $g1, $f1, $u1, $v1);
		}
//		$f2 = str_replace(' ', '', $f2);
//		if ($f2 !== '')        // date is present
		if (isset($_POST['check2'])) 
		{
			update_game($dbc, $lweek, $lyear, $g2, $f2, $u2, $v2);
		}	
//		$f3 = str_replace(' ', '', $f3);
//		if ($f3 !== '')        // date is present
		if (isset($_POST['check3'])) 
		{
			update_game($dbc, $lweek, $lyear, $g3, $f3, $u3, $v3);
		}		
//		$f4 = str_replace(' ', '', $f4);
//		if ($f4 !== '')        // date is present
		if (isset($_POST['check4'])) 
		{
			update_game($dbc, $lweek, $lyear, $g4, $f4, $u4, $v4);
		}	
//		$f5 = str_replace(' ', '', $f5);
//		if ($f5 !== '')        // date is present
		if (isset($_POST['check5'])) 
		{
			update_game($dbc, $lweek, $lyear, $g5, $f5, $u5, $v5);
		}		
//		$f6 = str_replace(' ', '', $f6);
//		if ($f6 !== '')        // date is present
		if (isset($_POST['check6'])) 
		{
			update_game($dbc, $lweek, $lyear, $g6, $f6, $u6, $v6);
		}	
//		$f7 = str_replace(' ', '', $f7);
//		if ($f7 !== '')        // date is present
		if (isset($_POST['check7'])) 
		{
			update_game($dbc, $lweek, $lyear, $g7, $f7, $u7, $v7);
		}		
//		$f8 = str_replace(' ', '', $f8);
//		if ($f8 !== '')        // date is present
		if (isset($_POST['check8'])) 
		{
			update_game($dbc, $lweek, $lyear, $g8, $f8, $u8, $v8);
		}	
//		$f9 = str_replace(' ', '', $f9);
//		if ($f9 !== '')        // date is present
		if (isset($_POST['check9'])) 
		{
			update_game($dbc, $lweek, $lyear, $g9, $f9, $u9, $v9);
		}			
//		$f10 = str_replace(' ', '', $f10);
//		if ($f10 !== '')        // date is present
		if (isset($_POST['check10'])) 
		{
			update_game($dbc, $lweek, $lyear, $g10, $f10, $u10, $v10);
		}		
//		$f11 = str_replace(' ', '', $f11);
//		if ($f11 !== '')        // date is present
		if (isset($_POST['check11'])) 
		{
			update_game($dbc, $lweek, $lyear, $g11, $f11, $u11, $v11);
		}		
//		$f12 = str_replace(' ', '', $f12);
//		if ($f12 !== '')        // date is present
		if (isset($_POST['check12'])) 
		{
			update_game($dbc, $lweek, $lyear, $g12, $f12, $u12, $v12);
		}		
//		$f13 = str_replace(' ', '', $f13);
//		if ($f13 !== '')        // date is present
		if (isset($_POST['check13'])) 
		{
			update_game($dbc, $lweek, $lyear, $g13, $f13, $u13, $v13);
		}		
//		$f14 = str_replace(' ', '', $f14);
//		if ($f14 !== '')        // date is present
		if (isset($_POST['check14'])) 
		{
			update_game($dbc, $lweek, $lyear, $g14, $f14, $u14, $v14);
		}		
//		$f15 = str_replace(' ', '', $f15);
//		if ($f15 !== '')        // date is present
		if (isset($_POST['check15'])) 
		{
			update_game($dbc, $lweek, $lyear, $g15, $f15, $u15, $v15);
		}		
//		$f16 = str_replace(' ', '', $f16);
//		if ($f16 !== '')        // date is present
		if (isset($_POST['check16'])) 
		{
			update_game($dbc, $lweek, $lyear, $g16, $f16, $u16, $v16);
		}					

		
	mysqli_close($dbc); 
	
     echo '<p>Selections are saved</p>';

}

?>
<hr />
<?php
   include_once 'foot_nav.php'; 
?>

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
 //  $result = mysqli_query ($dbc, $sql1) or die ("Error in query: $sql1 " . mysqli_error());
 //  $num_results = mysqli_num_rows($result); 
 //  if ($num_results > 1)   //  multiple leagues for user 
 //  {      
 //       echo '<p>multiple league user</p>';
 //  }
 //  else                    // single league user
 //  {
//	       echo '<p>single league user</p>'; 
//		   $leagueinfo=mysqli_fetch_assoc($result);
 //          $leaguenum = $leagueinfo['league'];	
		   //echo '<p>league = ' . $leaguenum . '</p>';
		   
		   // check if picks records are created
	//	     $sql2="select * from pick where userid=$owner and syear=$sys_year and sweek=$sys_week and league=$leaguenum";  
    //         $result = mysqli_query ($dbc, $sql2) or die ("Error in query: $sql2 " . mysqli_error());
    //         $num_results = mysqli_num_rows($result);
    //         if ($num_results < 1)                      // pick records do not exist
	//		 {
	//			 // echo '<p>creating schedule</p>';
	//			 $sql3="select * from schedule where seasonyear=$sys_year and week=$sys_week";
	//			 $sched = mysqli_query ($dbc, $sql3) or die ("Error in query: $sql3 " . mysqli_error());
	//		     while($nt=mysqli_fetch_array($sched)){ 
    // 			  	$sql4="insert into pick (userid, league, gamenum, result, locked, syear, sweek) values($owner, $leaguenum, " . $nt['gamenum']. ",  0, FALSE, $sys_year, $sys_week)";
	//				mysqli_query ($dbc, $sql4) or die ("Error in query: $sql4 " . mysqli_error());
	//			 }				 	 
	//		 }
			 
			 
			 //  now we hve all the records display the grid
					   
			$sqlgame="SELECT sc.* , UPPER( ht.optname ) AS hometeam, vt.optname AS visteam
                          FROM schedule sc			
                          JOIN dim_teams ht ON ht.tid = sc.hteam
                          JOIN dim_teams vt ON vt.tid = sc.vteam			
                          WHERE sc.seasonyear = $sys_year
                          AND sc.week =$sys_week";
   
			$res = mysqli_query ($dbc, $sqlgame) or die ("Error in query: $sqlgame " . mysqli_error());
            echo '<table  class="table table-bordered picktable">';
            echo "<tr>";
            echo "<td>Date</td>";
            echo "<td>Favorite</td>";
            echo "<td>Points</td>";
            echo "<td>Points</td>";
            echo "<td>Underdog</td>";
			echo "<td>Final</td>";
            echo "</tr>";			
			
			
			$linecount=1;
			while($resnt=mysqli_fetch_array($res)){ 
			    $games[$linecount] = array($resnt['gamenum']); 
			    if ($resnt['favorite']==1){
			       //echo '<tr name="gamenum"' .  $picknt['gamenum'].'>';
				   echo '<tr>';			   
                   echo '<td><strong>' . $resnt['gdate'] . '</td>';
                   echo '<td><strong>' . $resnt['hometeam'] . '</td>';
				   // was fscore and uscore
                    ?>
					  <td>
                      <input type="text" id='fscore' class="text-input" autocomplete="off" onchange="upArray(this.value, this.name);" 
                             name="<?php echo 'fscore' . $linecount; ?>"  maxlength="4"  value= <?php echo $resnt["hscore"]; ?> > 
                      </td>
					  <td>
                      <input type="text" id='uscore' class="text-input" autocomplete="off" onchange="upArray(this.value, this.name);" 
                             name="<?php echo 'uscore' . $linecount; ?>"  maxlength="4"  value= <?php echo $resnt["vscore"]; ?> > 
                      </td>					  
                  <?php				   
                   echo '<td><strong>' . $resnt['visteam'] . '</td>';
				   echo '<td><input type="checkbox" name="check' . trim($linecount) .'"</td>';	
 				}  
				else
				{
			       echo '<tr>';
                   echo '<td><strong>' . $resnt['gdate'] . '</td>';
                  echo '<td><strong>' . $resnt['visteam'] . '</td>';				   
                    ?>
					  <td>
                      <input type="text" id='fscore' class="text-input" autocomplete="off" onchange="upArray(this.value, this.name);" 
                             name="<?php echo 'fscore' . $linecount; ?>"  maxlength="4"  value= <?php echo $resnt["vscore"]; ?> > 
                      </td>
					  <td>
                      <input type="text" id='uscore' class="text-input" autocomplete="off" onchange="upArray(this.value, this.name);" 
                             name="<?php echo 'uscore' . $linecount; ?>"  maxlength="4"  value= <?php echo $resnt["hscore"]; ?> > 
                      </td>					  
                  <?php					   
                   echo '<td><strong>' . $resnt['hometeam'] . '</td>';
				   echo '<td><input type="checkbox" name="check' . trim($linecount) .'"</td>';	
    			}
				?>
				<td style="display:none;"><input type="text" id='gamenum' class="text-input" autocomplete="off" 
                             name="<?php echo 'game' . $linecount; ?>"  maxlength="4"  value= <?php echo $resnt["gamenum"]; ?> > </td>
							 
				<td style="display:none;"><input type="text" id='fav' class="text-input" autocomplete="off" 
                             name="<?php echo 'fav' . $linecount; ?>"  maxlength="4"  value= <?php echo $resnt["favorite"]; ?> > </td>			 
							 
				<?php
				echo '</tr>';
				
				$linecount++;
			}
			echo '</table>';
            echo  '<input type="submit" value="save" name="submit" />';
 //  }
?>

  
    <br />
    <hr />

   <!--    <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>   -->
	</div>
	 
	 <?php
//	   echo '<input type="hidden"     name ="pass_league"   value="' . $leaguenum . '" />';
	   echo '<input type="hidden"     name ="pass_year"   value="' . $sys_year . '" />';	   
	   echo '<input type="hidden"     name ="pass_week"   value="' . $sys_week . '" />';   
      ?>
</form>
</body>
</html>
