<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - Add Odds</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  
<script>
function upArray(val, caller) {
}
</script>

</head>
<body>
<div class="container">
  <h2>UPick Football - Add Odds</h2>


<?php
  require_once('connectvars.php');

session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }

$games=array();

if (isset($_POST['submit'])) {
  $g1=0;	
  $g2=0;
  $g3=0;
  $g4=0;	
  $g5=0;
  $g6=0; 
  $g7=0;	
  $g8=0;
  $g9=0;
  $g10=0;	
  $g11=0;
  $g12=0;
  $g13=0;	
  $g14=0;
  $g15=0; 
  $g16=0;  
  
  
	
     if(isset($_POST['1']))	{	
        $o1 = $_POST['odd1'];
        $f1 = $_POST['1'];		
        $g1 = $_POST['game1'];
	 }	
     if(isset($_POST['2']))	{		
        $o2 = $_POST['odd2'];
        $f2 = $_POST['2'];		
        $g2 = $_POST['game2'];
	 }	
     if(isset($_POST['3']))	{		
        $o3 = $_POST['odd3'];
        $f3 = $_POST['3'];		
        $g3 = $_POST['game3'];
	 }	
     if(isset($_POST['4']))	{		
        $o4 = $_POST['odd4'];
        $f4 = $_POST['4'];		
        $g4 = $_POST['game4'];
	 }	
     if(isset($_POST['5']))	{	
        $o5 = $_POST['odd5'];
        $f5 = $_POST['5'];		
        $g5 = $_POST['game5'];
	 }	
     if(isset($_POST['6']))	{		 
        $o6 = $_POST['odd6'];
        $f6 = $_POST['6'];		
        $g6 = $_POST['game6'];
	 }	
     if(isset($_POST['7']))	{		
        $o7 = $_POST['odd7'];
        $f7 = $_POST['7'];		
        $g7 = $_POST['game7'];
	 }	
     if(isset($_POST['8']))	{		
        $o8 = $_POST['odd8'];
        $f8 = $_POST['8'];		
        $g8 = $_POST['game8'];
	 }	
     if(isset($_POST['9']))	{		
        $o9 = $_POST['odd9'];
        $f9 = $_POST['9'];		
        $g9 = $_POST['game9'];
	 }	
     if(isset($_POST['10']))	{		
        $o10 = $_POST['odd10'];
        $f10 = $_POST['10'];		
        $g10 = $_POST['game10'];
	 }	
     if(isset($_POST['11']))	{		
        $o11 = $_POST['odd11'];
        $f11 = $_POST['11'];		
        $g11 = $_POST['game11'];
	 }	
     if(isset($_POST['12']))	{		
        $o12 = $_POST['odd12']; 
        $f12 = $_POST['12']; 		
        $g12 = $_POST['game12'];
	 }	
     if(isset($_POST['13']))	{		
        $o13 = $_POST['odd13'];
        $f13 = $_POST['13'];		
        $g13 = $_POST['game13'];
	 }	
     if(isset($_POST['14']))	{		
        $o14 = $_POST['odd14'];
        $f14 = $_POST['14'];		
        $g14 = $_POST['game14'];
	 }	
     if(isset($_POST['15']))	{		
        $o15 = $_POST['odd15'];
        $f15 = $_POST['15'];		
        $g15 = $_POST['game15'];
	 }	
     if(isset($_POST['16']))	{		
        $o16 = $_POST['odd16'];
        $f16 = $_POST['16'];
        $g16 = $_POST['game16'];
	 }	

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
if ($g1 > 0) {
    $query =  "update schedule set odd = '$o1', favorite = '$f1' where gamenum = '$g1' ";
     mysqli_query($dbc, $query);
}
if ($g2 > 0) {
     $query =  "update schedule set odd = '$o2', favorite = '$f2' where gamenum = '$g2' ";
     mysqli_query($dbc, $query);
}
if ($g3 > 0) {
     $query =  "update schedule set odd = '$o3', favorite = '$f3' where gamenum = '$g3' ";
     mysqli_query($dbc, $query);
}
if ($g4 > 0) {
     $query =  "update schedule set odd = '$o4', favorite = '$f4' where gamenum = '$g4' ";
     mysqli_query($dbc, $query);
}
if ($g5 > 0) {
     $query =  "update schedule set odd = '$o5', favorite = '$f5' where gamenum = '$g5' ";
     mysqli_query($dbc, $query);
}
if ($g6 > 0) {
     $query =  "update schedule set odd = '$o6', favorite = '$f6' where gamenum = '$g6' ";
     mysqli_query($dbc, $query);
}
if ($g7 > 0) {
     $query =  "update schedule set odd = '$o7', favorite = '$f7' where gamenum = '$g7' ";
     mysqli_query($dbc, $query);
}
if ($g8 > 0) {
     $query =  "update schedule set odd = '$o8', favorite = '$f8' where gamenum = '$g8' ";
     mysqli_query($dbc, $query);
}
if ($g9 > 0) {
     $query =  "update schedule set odd = '$o9', favorite = '$f9' where gamenum = '$g9' ";
     mysqli_query($dbc, $query);
}
if ($g10 > 0) {
     $query =  "update schedule set odd = '$o10', favorite = '$f10' where gamenum = '$g10' ";
     mysqli_query($dbc, $query);
}
if ($g11 > 0) {
     $query =  "update schedule set odd = '$o11', favorite = '$f11' where gamenum = '$g11' ";
     mysqli_query($dbc, $query);
}
if ($g12 > 0) {
     $query =  "update schedule set odd = '$o12', favorite = '$f12' where gamenum = '$g12' ";
     mysqli_query($dbc, $query);
}
if ($g13 > 0) {
     $query =  "update schedule set odd = '$o13', favorite = '$f13' where gamenum = '$g13' ";
     mysqli_query($dbc, $query);
}
if ($g14 > 0) {
     $query =  "update schedule set odd = '$o14', favorite = '$f14' where gamenum = '$g14' ";
     mysqli_query($dbc, $query);
}
if ($g15 > 0) {
     $query =  "update schedule set odd = '$o15', favorite = '$f15' where gamenum = '$g15' ";
     mysqli_query($dbc, $query);
}
if ($g16 > 0) {
     $query =  "update schedule set odd = '$o16', favorite = '$f16' where gamenum = '$g16' ";
     mysqli_query($dbc, $query);
}

    mysqli_close($dbc); 

//       echo '<p>dump session</p>';
//        Print_r ($_SESSION);
//       echo '<p>end session dump</p>';
 }
?>

<?php
   include_once 'foot_nav.php'; 
?>

 <form enctype="multipart/form-data" name="usrfrm" id="usrfrm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <div class="col-md-12">
<?php

      echo '<table  class="table table-bordered scheduletable">';
       echo "<tr>";
           echo "<td></td>";
           echo "<td>Home Team</td>";
           echo "<td>Odds</td>";
           echo "<td>Visitors</td>";
           echo "<td></td>";
       echo "</tr>";


     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");
     $query = "
                     select * from footconfig where cfgid = 1
                     ";
      $result = mysqli_query ($dbc, $query);
      $row = mysqli_fetch_assoc($result); 
      $nweek = $row["oddweek"];
      $nyear = $row["curryear"];

      $query = "
                    select ht.optname as hometeam, vt.optname as visitor,  
                   sc.gamenum, sc.week, sc.gdate, sc.favorite, sc.odd
                   from schedule sc 
                   join dim_teams ht on ht.tid = sc.hteam
                   join dim_teams vt on vt.tid = sc.vteam
                   where sc.week = '$nweek'  and sc.seasonyear = '$nyear'
                   order by gdate, gamenum";
   
    $result = mysqli_query ($dbc, $query);
     if (mysqli_num_rows($result) > 0) {
         $linecount = 0;
  //        $games = array();
         $gameone =0;
         while($row=mysqli_fetch_array($result)) {
                  if ($gameone == 0) {
                      $firstgame=trim($row['gamenum'] );
                      $gameone =1;
                   }
                  $linecount++;
                  $lastgame=trim($row['gamenum'] );

                 $games[$linecount] = array($row['gamenum'] , $row['odd'], $row['favorite']); 
                 echo "<tr>";
           // favorite button
                 echo '<td><input type="radio" name="' . trim($linecount) .'" value="1" id="q7" ';
                 if ($row['favorite'] == "1")  {echo "checked"; }   
                  echo '></td>';
           //  favorite button
                 echo '<td><strong>' . $row['hometeam'] . '</td>';
                 echo '<td>';
                      ?>
                      <input type="text" id='odd' class="text-input" autocomplete="off" onchange="upArray(this.value, this.name);" 
                             name="<?php echo 'odd' . $linecount; ?>"  maxlength="4"  value= <?php echo $row["odd"]; ?> > 
                      </td>
                 <?php
                echo '<td><strong>' . $row['visitor'] . '</td>';
           // favorite button
                 echo '<td><input type="radio" name="'. trim($linecount) .'" value="2" id="q7" ';
                 if ($row['favorite'] == "2")  {echo "checked"; }   
                  echo '></td>';
           //  favorite button
              ?>
                <td style="display:none;"><input type="text" id='gamenum' class="text-input" autocomplete="off" 
                             name="<?php echo 'game' . $linecount; ?>"  maxlength="4"  value= <?php echo $row["gamenum"]; ?> > </td>
            <?php
                 echo "</tr>";
         }
         echo '</table>';
    }
    else {
         echo '<p>Schedule is not found</p>';
    }
  echo '</div>';
    ///////////////////////////////////////
      echo  '<input type="submit" value="save" name="submit" />';
      echo '</form>';

 //        $_SESSION['games'] = $games;     // not used but array put in session
 ?>
<!--	 <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>   -->
	 
 </div>	



</body> 
</html>