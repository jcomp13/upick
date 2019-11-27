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
<h2>UPick Football - Standings </h2>
  <h6>**  Curently Tie breaking rules are not being used.  This is a simple overal win/loss result</h6> 
<?php
require_once('connectvars.php');


session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
    }

   include_once 'foot_nav.php'; 


	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");
//  $query = "SELECT optname, win, loss, tie, 
//cwin, closs, ctie, dwin, dloss, dtie
//FROM team_recs tr
//join dim_teams dt on dt.tid = tr.teamid
//where tr.tyear=2017
//order by conferenceid, divisionid, win-lose desc, dwin-dloss desc, cwin-closs desc";

$query="select * from footconfig where cfgid = 1";
$cfg = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
$cfg_rec=mysqli_fetch_assoc($cfg);
$sys_year= $cfg_rec['curryear'];



  $query = "SELECT optname, win, loss, tie, 
cwin, closs, ctie, dwin, dloss, dtie, divisionid
FROM team_recs tr
join dim_teams dt on dt.tid = tr.teamid
where tr.tyear=$sys_year
order by conferenceid, divisionid, win-loss desc, dwin-dloss desc, cwin-closs desc";


    $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 

  ?>
  <div class="table-responsive"> 
  <table class="table table-bordered table-striped table-condensed">
  <?php
    $divbreak=1;
    while($stand=mysqli_fetch_array($result)){
          if ($divbreak <> $stand['divisionid']) {
              for ($k=0; $k<2; $k++) {
                echo '<tr>';
                   for ($i=0;$i<10;$i++) { 
                      echo '<td class="grid_split"> </td>';
                   } 
                 echo '</tr>';  
               }
               $divbreak = $stand['divisionid'];
           }

     ?> 

          <tr>
            <td> <?= $stand['optname']; ?> </td>
            <td> <?= $stand['win']; ?> </td>
            <td> <?= $stand['loss']; ?> </td>
            <td> <?= $stand['tie']; ?> </td>
            <td> <?= $stand['cwin']; ?> </td>
            <td> <?= $stand['closs']; ?> </td>
            <td> <?= $stand['ctie']; ?> </td>
            <td> <?= $stand['dwin']; ?> </td>
            <td> <?= $stand['dloss']; ?> </td>
            <td> <?= $stand['dtie']; ?> </td>
          </tr>
          <?php 
        }
  ?>
   </table> 
</div>

  <!--   <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>   -->
</div>

</body>
</html>
