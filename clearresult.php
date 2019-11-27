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
<h2>UPick Football - Clear Game</h2>

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
        $g1 = $_POST['game1'];    // holds the actual game number		
    }
	if (isset($_POST['check2'])) {		
        $g2 = $_POST['game2'];		
    }
	if (isset($_POST['check3'])) {
        $g3 = $_POST['game3'];		
    }
	if (isset($_POST['check4'])) {
        $g4 = $_POST['game4'];		
    }
	if (isset($_POST['check5'])) {
        $g5 = $_POST['game5'];		
    }
	if (isset($_POST['check6'])) {	
        $g6 = $_POST['game6'];		
    }
	if (isset($_POST['check7'])) {
        $g7 = $_POST['game7'];		
    }
	if (isset($_POST['check8'])) {		
        $g8 = $_POST['game8'];		
    }
	if (isset($_POST['check9'])) {
        $g9 = $_POST['game9'];		
    }
	if (isset($_POST['check10'])) {		
        $g10 = $_POST['game10'];		
    }
	if (isset($_POST['check11'])) {
        $g11 = $_POST['game11'];		
    }
	if (isset($_POST['check12'])) {
        $g12 = $_POST['game12'];		
    }
	if (isset($_POST['check13'])) {
        $g13 = $_POST['game13'];		
    }
	if (isset($_POST['check14'])) {		
        $g14 = $_POST['game14'];		
    }
	if (isset($_POST['check15'])) {		
        $g15 = $_POST['game15'];		
    }
	if (isset($_POST['check16'])) {
        $g16 = $_POST['game16'];		
    }
	
		//  Now have all the information, enter the results into the database
		if (isset($_POST['check1'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g1);
		}
		if (isset($_POST['check2'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g2);
		}	
		if (isset($_POST['check3'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g3);
		}		
		if (isset($_POST['check4'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g4);
		}	
		if (isset($_POST['check5'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g5);
		}		
		if (isset($_POST['check6'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g6);
		}	
		if (isset($_POST['check7'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g7);
		}		
		if (isset($_POST['check8'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g8);
		}	
		if (isset($_POST['check9'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g9);
		}			
		if (isset($_POST['check10'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g10);
		}		
		if (isset($_POST['check11'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g11);
		}		
		if (isset($_POST['check12'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g12);
		}		
		if (isset($_POST['check13'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g13);
		}		
		if (isset($_POST['check14'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g14);
		}		
		if (isset($_POST['check15'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g15);
		}		
		if (isset($_POST['check16'])) 
		{
			clear_game_result($dbc, $lweek, $lyear, $g16);
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

				   
			$sqlgame="SELECT sc.* , UPPER( ht.optname ) AS hometeam, vt.optname AS visteam
                          FROM schedule sc			
                          JOIN dim_teams ht ON ht.tid = sc.hteam
                          JOIN dim_teams vt ON vt.tid = sc.vteam			
                          WHERE sc.seasonyear = $sys_year
                          AND sc.week =$sys_week
                          and sc.winner<> 0 ";
   
			$res = mysqli_query ($dbc, $sqlgame) or die ("Error in query: $sqlgame " . mysqli_error());
            echo '<table  class="table table-bordered picktable">';
            echo "<tr>";
            echo "<td>Date</td>";
            echo "<td>Favorite</td>";
            echo "<td>Points</td>";
            echo "<td>Points</td>";
            echo "<td>Underdog</td>";
			echo "<td>Clear</td>";
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
                      <input type="text" id='fscore' class="text-input" autocomplete="off" readonly onchange="upArray(this.value, this.name);" 
                             name="<?php echo 'fscore' . $linecount; ?>"  maxlength="4"  value= <?php echo $resnt["hscore"]; ?> > 
                      </td>
					  <td>
                      <input type="text" id='uscore' class="text-input" autocomplete="off" readonly onchange="upArray(this.value, this.name);" 
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
                      <input type="text" id='fscore' class="text-input" autocomplete="off" readonly onchange="upArray(this.value, this.name);" 
                             name="<?php echo 'fscore' . $linecount; ?>"  maxlength="4"  value= <?php echo $resnt["vscore"]; ?> > 
                      </td>
					  <td>
                      <input type="text" id='uscore' class="text-input" autocomplete="off" readonly onchange="upArray(this.value, this.name);" 
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

	</div>
	 
	 <?php
	   echo '<input type="hidden"     name ="pass_year"   value="' . $sys_year . '" />';	   
	   echo '<input type="hidden"     name ="pass_week"   value="' . $sys_week . '" />';   
      ?>
</form>
</body>
</html>
