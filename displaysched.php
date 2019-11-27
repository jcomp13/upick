<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - View Schedule</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  
  
  
  
</head>
<body>
<div class="container">
  <h2>UPick Football - View Schedule</h2>


<?php

  require_once('connectvars.php');

session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }

if (isset($_POST['submit'])) {
     $pastweek = $_POST['gameweek'];
     $pastyear = $_POST['gameyear'];
     $newweek="4";
     echo '<form name="schedv" method="post" action="displaysched.php">';


   include_once 'foot_nav.php'; 



     echo '<label for="">Week:</label>';
     switch ($pastweek) {       // use this logic until able to populate the value with the variable
     case "1":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "2":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "3":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "4":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "5":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "6":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "7":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "8":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "9":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "10":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "11":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "12":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "13":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "14":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "15":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "16":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     case "17":     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
     default:     echo '<input type="number" id="gameweek" name="gameweek"  min="1" max="17" step="1" value=' . $pastweek . ' />';
            break;
 }
     echo '<label for="">Year:</label>';
     echo '<input type="number" id="gameyear" name="gameyear"  min="2015" max="2020" step="1" value=' . $pastyear . ' />';

//   echo '<input type="text" id="song" name="song" value=" ' .   $pastweek .' " /><br />';   works but not on input type number


      echo  '<input type="submit" value="go" name="submit" />';
    echo '<br />';
    echo '<hr />';
////////////////////////////
      echo '<table  class="table  table-responsive table-striped   schedule table">';
       echo "<tr>";
           echo "<td>Date</td>";
           echo "<td>Home Team</td>";
           echo "<td>Visitors</td>";
       echo "</tr>";
     $week=1;
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");
      $query = "
                    select ht.optname as hometeam, vt.optname as visitor,. 
                   sc.gamenum, sc.week, sc.gdate
                   from schedule sc 
                   join dim_teams ht on ht.tid = sc.hteam
                   join dim_teams vt on vt.tid = sc.vteam
                   where sc.week = '$pastweek'  and sc.seasonyear = '$pastyear'
                   order by gdate, gamenum";
   
    $result = mysqli_query ($dbc, $query);
     if (mysqli_num_rows($result) > 0) {
         while($row=mysqli_fetch_array($result)) {
                 echo "<tr>";
                 echo '<td><strong>' . $row['gdate'] . '</td>';
                 echo '<td><strong>' . $row['hometeam'] . '</td>';
                echo '<td><strong>' . $row['visitor'] . '</td>';
                 echo "</tr>";
         }
       
    }
    else {
         echo '<p>Schedule is not found</p>';
    }
    echo '</table>';
    
///////////////////////////////////////

     echo '</form>';
   }
  ?> 
<!-- 	 <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>  -->


</div>
</body> 
</html>