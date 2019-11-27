<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - Add Schedule</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
 
</head>
<body>
<div class="container">
  <h2>UPick Football - Add Schedule</h2>
<?php

  require_once('connectvars.php');

session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }

  if (isset($_POST['submit'])) {
         $teamg1a = $_POST['g1a'];
         $teamg1b = $_POST['g1b'];
         $teamg2a = $_POST['g2a'];
         $teamg2b = $_POST['g2b'];
         $teamg3a = $_POST['g3a'];
         $teamg3b = $_POST['g3b'];
         $teamg4a = $_POST['g4a'];
         $teamg4b = $_POST['g4b'];
         $teamg5a = $_POST['g5a'];
         $teamg5b = $_POST['g5b'];
         $teamg6a = $_POST['g6a'];
         $teamg6b = $_POST['g6b'];
         $teamg7a = $_POST['g7a'];
         $teamg7b = $_POST['g7b'];
         $teamg8a = $_POST['g8a'];
         $teamg8b = $_POST['g8b'];
         $teamg9a = $_POST['g9a'];
         $teamg9b = $_POST['g9b'];
         $teamg10a = $_POST['g10a'];
         $teamg10b = $_POST['g10b'];
         $teamg11a = $_POST['g11a'];
         $teamg11b = $_POST['g11b'];
         $teamg12a = $_POST['g12a'];
         $teamg12b = $_POST['g12b'];
         $teamg13a = $_POST['g13a'];
         $teamg13b = $_POST['g13b'];
         $teamg14a = $_POST['g14a'];
         $teamg14b = $_POST['g14b'];
         $teamg15a = $_POST['g15a'];
         $teamg15b = $_POST['g15b'];
         $teamg16a = $_POST['g16a'];
         $teamg16b = $_POST['g16b'];
         $weeknum = $_POST['gameweek'];
         $curryear = $_POST['gameyear'];
         $gdate1 = date( ' y-m-d' , strtotime($_POST['g1date']));
         $gdate2 = date( ' y-m-d' , strtotime($_POST['g2date']));
         $gdate3 = date( ' y-m-d' , strtotime( $_POST['g3date']));
         $gdate4 = date( ' y-m-d' , strtotime( $_POST['g4date']));
         $gdate5 = date( ' y-m-d' , strtotime( $_POST['g5date']));
         $gdate6 = date( ' y-m-d' , strtotime( $_POST['g6date']));
         $gdate7 = date( ' y-m-d' , strtotime( $_POST['g7date']));
         $gdate8 = date( ' y-m-d' , strtotime( $_POST['g8date']));
         $gdate9 = date( ' y-m-d' , strtotime( $_POST['g9date']));
         $gdate10 = date( ' y-m-d' , strtotime( $_POST['g10date']));
         $gdate11 = date( ' y-m-d' , strtotime( $_POST['g11date']));
         $gdate12 = date( ' y-m-d' , strtotime( $_POST['g12date']));
         $gdate13 = date( ' y-m-d' , strtotime( $_POST['g13date']));
         $gdate14 = date( ' y-m-d' , strtotime( $_POST['g14date']));
         $gdate15 = date( ' y-m-d' , strtotime( $_POST['g15date']));
         $gdate16 = date( ' y-m-d' , strtotime( $_POST['g16date']));

          if ($weeknum == 1) {
                $gamenum=0;
           }
           else {
                 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                 $data=mysqli_query($dbc, "select gamenum from schedule order by gamenum desc limit 1" );
                 $row = mysqli_fetch_assoc( $data);
                 $gamenum = $row['gamenum'];
                 mysqli_close($dbc);
           }
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
          if((($teamg1a != 0) && ($teamg1b != 0 ))) {  
                $gamenum=$gamenum+1;
                $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg1a', '$teamg1b', '$weeknum', '$curryear', '$gdate1')";
              $res = mysqli_query($dbc, $query);
               if (!res) die(mysqli_error());
          }
          if((($teamg2a != 0) && ($teamg2b != 0 ))) {   
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg2a', '$teamg2b', '$weeknum', '$curryear', '$gdate2')";
              mysqli_query($dbc, $query);
          }
          if((($teamg3a != 0) && ($teamg3b != 0 ))) {   
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg3a', '$teamg3b', '$weeknum', '$curryear', '$gdate3')";
              mysqli_query($dbc, $query);
          }
          if((($teamg4a != 0) &&  ($teamg4b != 0 ))) {   
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear,  gdate)  " .
                    " VALUES ('$gamenum', '$teamg4a', '$teamg4b', '$weeknum', '$curryear', '$gdate4')";
              mysqli_query($dbc, $query);
          }
          if((($teamg5a != 0) &&  ($teamg5b != 0 ))) {   
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg5a', '$teamg5b', '$weeknum', '$curryear', '$gdate5')";
              mysqli_query($dbc, $query);
          }
          if((($teamg6a != 0) && ($teamg6b != 0 ))) {   
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg6a', '$teamg6b', '$weeknum', '$curryear', '$gdate6')";
              mysqli_query($dbc, $query);
          }
          if((($teamg7a != 0) && ($teamg7b != 0 ))) {   
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg7a', '$teamg7b', '$weeknum', '$curryear', '$gdate7')";
              mysqli_query($dbc, $query);
          }
          if((($teamg8a != 0) && ($teamg8b != 0 ))) {   
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg8a', '$teamg8b', '$weeknum', '$curryear', '$gdate8')";
              mysqli_query($dbc, $query);
          }
          if((($teamg9a != 0) && ($teamg9b != 0 ))) {   
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg9a', '$teamg9b', '$weeknum', '$curryear', '$gdate9')";
              mysqli_query($dbc, $query);
          }
          if((($teamg10a != 0) && ($teamg10b != 0 ))) {   
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg10a', '$teamg10b', '$weeknum', '$curryear', '$gdate10')";
              mysqli_query($dbc, $query);
          }
          if((($teamg11a != 0) && ($teamg11b != 0 ))) {  
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg11a', '$teamg11b', '$weeknum', '$curryear', '$gdate11')";
              mysqli_query($dbc, $query);
          }
          if((($teamg12a != 0) && ($teamg12b != 0 ))) {  
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg12a', '$teamg12b', '$weeknum', '$curryear', '$gdate12')";
              mysqli_query($dbc, $query);
          }
          if((($teamg13a != 0) && ($teamg13b != 0 ))) {  
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg13a', '$teamg13b', '$weeknum', '$curryear', '$gdate13')";
              mysqli_query($dbc, $query);
          }
          if((($teamg14a != 0) && ($teamg14b != 0 ))) {  
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg14a', '$teamg14b', '$weeknum', '$curryear', '$gdate14')";
              mysqli_query($dbc, $query);
          }
          if((($teamg15a != 0) && ($teamg15b != 0 ))) {  
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg15a', '$teamg15b', '$weeknum', '$curryear', '$gdate15')";
              mysqli_query($dbc, $query);
          }
          if((($teamg16a != 0) && ($teamg16b != 0 ))) {  
               $gamenum=$gamenum+1;
               $query = "INSERT INTO schedule (gamenum, hteam, vteam, week, seasonyear, gdate)  " .
                    " VALUES ('$gamenum', '$teamg16a', '$teamg16b', '$weeknum', '$curryear', '$gdate16')";
              mysqli_query($dbc, $query);
          }
        echo '<p>current schedule is saved : </p>';
        mysqli_close($dbc);
  }


 ?>
<?php
   include_once 'foot_nav.php'; 
?>
 
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

 <label for="">Week:</label>
 <input type="number" id="gameweek" name="gameweek"  min="1" max="21" step="1" value="1" />

 <label for="">Year:</label>
 <input type="number" id="gameyear" name="gameyear"  min="2015" max="2020" step="1" value="2017" />
<br />
   <br />
  <hr />
     <?php
     $data = array();
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	 
//     mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connection Failure");
//     mysqli_select_db($data, DB_NAME)or die("Connection Failed"); 
    $query="select tid, optname from dim_teams where active = 1 order by optname";
    $result = mysqli_query($dbc, $query);

     $data[0]['tid'] = 0;
     $data[0]['optname'] = "-- Select a Team --";
     if (mysqli_num_rows($result) > 0) {
         $i = 1;
         while($data[$i] = mysqli_fetch_assoc($result)) 
             $i++;
      }
    // array will be created with elements 0-33.  Unset will remmove element number 33
    unset($data[$i]);
    // print_r($data);

    echo "<table class='table table-bordered' >";
       echo "<tr>";
           echo "<td>Date</td>";
           echo "<td>Home Team</td>";
           echo "<td>Visitors</td>";
       echo "</tr>";

//-----------------------------------------------------------------------------------------------
         echo "<tr>";
            echo '<td><input type="text" id="g1date" name="g1date"  /></td>';
                    echo "<td>";
                        echo "<select name='g1a'   id='g1a'     >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g1b'  id='g1b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" id="g2date" name="g2date"  /></td>';
                    echo "<td>";
                        echo "<select name='g2a'   id='g2a'     >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g2b'  id='g2b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g3date"  /></td>';
                    echo "<td>";
                        echo "<select name='g3a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g3b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g4date"  /></td>';
                    echo "<td>";
                        echo "<select name='g4a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g4b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g5date"  /></td>';
                    echo "<td>";
                        echo "<select name='g5a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g5b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g6date"  /></td>';
                    echo "<td>";
                        echo "<select name='g6a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g6b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g7date"  /></td>';
                    echo "<td>";
                        echo "<select name='g7a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g7b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g8date"  /></td>';
                    echo "<td>";
                        echo "<select name='g8a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g8b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g9date"  /></td>';
                    echo "<td>";
                        echo "<select name='g9a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g9b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g10date"  /></td>';
                    echo "<td>";
                        echo "<select name='g10a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g10b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g11date"  /></td>';
                    echo "<td>";
                        echo "<select name='g11a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g11b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g12date"  /></td>';
                    echo "<td>";
                        echo "<select name='g12a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g12b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g13date"  /></td>';
                    echo "<td>";
                        echo "<select name='g13a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g13b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g14date"  /></td>';
                    echo "<td>";
                        echo "<select name='g14a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g14b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g15date"  /></td>';
                    echo "<td>";
                        echo "<select name='g15a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g15b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
//----------------------------------------------------------------------------
        echo "<tr>";
            echo '<td><input type="text" name="g16date"  /></td>';
                    echo "<td>";
                        echo "<select name='g16a'  >";
                                foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                         echo "</select>";
                      echo "</td>";
                      echo" <td>";
                          echo "<select name='g16b'  >";
                               foreach($data as $jopt): 
                                     echo '<option value=" '. $jopt['tid']. ' ">' . $jopt['optname'].'</option>';
                                endforeach;
                          echo "</select>";
                      echo "</td>";
              echo "</tr>";
          ?>
</table>

       <input type="submit" value="Add" name="submit" />

  </form>
      <br />
    <hr />
  
 <!-- 	 <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>   -->
	 
 </div>	 
  
  
  
</body> 
</html>