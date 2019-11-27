<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football -  Create League</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  
  
  
  
</head>
<body>
<div class="container">
  <h2>UPick Football - Create League</h2>

<?php
function NewGuid() {
   $s = strtoupper(md5(uniqid(rand(), true)));
   $guidText = 
          substr($s,0,8). '-' .
          substr($s,8,4). '-' .
          substr($s,12,4). '-' .
          substr($s,16,4). '-' .
          substr($s,20);
   return $guidText;
}

  require_once('connectvars.php');

session_start();
$parent_value=0;

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }

   $owner = $_SESSION['id'];


   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   $query = "select * from footconfig where cfgid = 1";
   $result =  mysqli_query($dbc, $query);
   $row = $result->fetch_assoc();
   $year = $row['curryear'];





   include_once 'foot_nav.php'; 


  if (isset($_POST['submit'])) {
    // Connect to the database
 //   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $league = mysqli_real_escape_string($dbc, trim($_POST['league']));
    $leaguetype = mysqli_real_escape_string($dbc, $_POST['ltype']);    

    if (!empty($league) ) {
            // Write the data to the database
          $query = "SELECT COUNT( * ) from football_league where lname = '$league' ";
          $result =  mysqli_query($dbc, $query);
          $row = $result->fetch_row();
           if($row[0]  == 0) {
                   // get the current year from the control record
 //                   $query = "select * from footconfig where cfgid = 1";
 //                   $result =  mysqli_query($dbc, $query);
 //                   $row = $result->fetch_assoc();
// var_dump($row);
//                     $year = $row['curryear'];
                     $hash = NewGuid();
                      $query = "INSERT INTO football_league (lname, managerid, hashfield, year, type) VALUES ('$league', '$owner', '$hash', '$year', '$leaguetype')";
                      mysqli_query($dbc, $query);
 
                      $query = "select * from football_league where hashfield = '$hash'";
                      $result = mysqli_query($dbc, $query);
                      $row = $result->fetch_assoc();
                      $lnum = $row['lnum'];
 
                      $query = "INSERT INTO userleague (uid, league, wins, loses, ties, syear) VALUES ('$owner', '$lnum', 0, 0,0, '$year')";
                      mysqli_query($dbc, $query);
                      //  Check if multileague needs to be created for the user and year



                      // check if multi flag needs to be set
                      $query = "select * from userleague where uid = " . $owner . " and syear = '" . $year . "'";
                      $result  = mysqli_query($dbc, $query);
                      $num_results = mysqli_num_rows($result);
                      if ($num_results > 1) {
                          $query = "update multileague set multiflag = 'Y' where uid = " . $owner . " and syear = '" . $year . "'";
                          mysqli_query($dbc, $query);
                      }
                      if ($num_results == 1) {         // first record needs to create multileague
                        ///  INSERT INTO multileague (uid, syear, selectleague, multiflag) VALUES ('5', '2018', '17', 'N')
                          $query = "INSERT INTO multileague (uid, syear, selectleague, multiflag) VALUES ('$owner', '$year', '$lnum', 'N')";
                          mysqli_query($dbc, $query);

                      }

                     // Confirm success with the user
                    echo '<p>League: ' . $league. ' is now created</p>';
            } 
            else {
               echo '<p class="error">League Name is already in system.</p>';
             }
       //     echo '<p><a href="main.php">&lt;&lt; Back to main page</a></p>';

            // Clear the score data to clear the form
            $league = "";
        //    mysqli_close($dbc);
     }
    else {
      echo '<p class="error">Please enter an league name to be added.</p>';
    }
  }
?>


  <hr />
  <p>The league will be created for the <?php echo $year ?> season</p>
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 
    <label for="artist">League Name:</label>
    <input type="text" id="league" name="league" value="<?php if (!empty($lname)) echo $lname; ?>" /><br />

 <?php
     $squery = "select * from leaguetype where status = 1 order by description";
     $result = mysqli_query ($dbc, $squery) or die ("Error in query: $squery " . mysqli_error($dbc));

 ?>
     <label for="team">Leagues Type:</label>
     <select name="ltype" id="ltype">
       <?php while($leagues = mysqli_fetch_assoc($result))  :  ?>
             <option value="<?=$leagues['typekey'];?>"<?=(($parent_value == $leagues['typekey'])? ' selected="selected"':''); ?>><?=$leagues['description'];?></option>
       <?php endwhile;  ?>
    </select>


    <input type="submit" value="Add" name="submit" />
  </form>
  	   <br />
       <hr />
	 
  <!--     <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>   -->
	</div>
  
</body> 
</html>