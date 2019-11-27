<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - Change League</title>
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
  <h2>UPick Football - User Standings </h2>

<?php

require_once('connectvars.php');
$mess = 0;

 $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");

 session_start();
   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }
    $owner = $_SESSION['id'];

   include_once 'foot_nav.php'; 

   if (isset($_POST['submit'])) {

    $newleague = $_POST['parent'];
    $query = "update multileague set selectleague = $newleague
              where uid = $owner
              and syear = (select curryear from footconfig where cfgid = 1)";
     mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
     $mess = 1;
   }

?>
 
<hr />

   <form enctype="multipart/form-data"  name="frm" id="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

   <div class="form-group col-md-6">
    <?php
      $query = "SELECT * FROM multileague m
                join footconfig c on c.curryear = m.syear
                where c.cfgid= 1
                and m.uid=$owner";
      $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
      $curr_league = mysqli_fetch_assoc($result);
      $parent_value = $curr_league['selectleague'];       


      $query = "select * from userleague u
                join football_league fl on fl.year=u.syear and fl.lnum=u.league
                join footconfig c on c.curryear = u.syear
                where c.cfgid= 1
                and u.uid=$owner
                order by lname desc";
      $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());

    ?>
     <label for="team">Leagues:</label>
     <select name="parent" id="parent">
       <?php while($leagues = mysqli_fetch_assoc($result))  :  ?>
             <option value="<?=$leagues['league'];?>"<?=(($parent_value == $leagues['league'])? ' selected="selected"':''); ?>><?=$leagues['lname'];?></option>
       <?php endwhile;  ?>
    </select>  
      </div>
      <div class="form-group col-md-6">
          <input type="submit" value="save" name="submit" />
      </div>    

 </div>	 
</form>

<div class="container">
    <?php if ($mess == 1) {
      echo "<p>League Saved</p>";
    }
    ?>
  </div>

</body>

</html>

