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

 $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");
 $sql="select * from dim_teams where active =1 order by optname";
 $result=$db->query($sql);
  $parent_value = 0;
  
  
  $sql = "select * from footconfig where cfgid=1";
  $cfg = $db->query($sql);
  $mconfig = mysqli_fetch_assoc($cfg);
  $sgameyear = $mconfig['curryear'];
  
 session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }

?>
   
<!--
<script language="javascript">
     alert('<?php echo $sgameyear; ?>');
</script>
-->
<?php
   include_once 'foot_nav.php'; 
?>
   
    <form name="schedv" method="post" action="teamsched.php"> 
	 <div style="display:block;">
	 <div class="form-group col-md-6">
      <label for="team">Team:</label>
	   <select name="parent" id="parent">
	   <option <?=(($parent_value == 0)?' selected="selected"':''); ?>>Team</option>  
	     <?php while($parent = mysqli_fetch_assoc($result))  :  ?>
         	   <option value="<?=$parent['tid'];?>"<?=(($parent_value == $parent['tid'])? ' selected="selected"':''); ?>><?=$parent['optname'];?></option>
	     <?php endwhile;  ?>
	  </select>  
      </div>
	  </div>
	  <div style="display:block;">
	  <div class="form-group col-md-6">
      <label  for="">Year: </label>
      <input  type="number" id="gameyear" name="gameyear"  min="2016" max="2020" step="1" value="<?=$sgameyear;?>">

      <input type="submit" value="go" name="submit" />
	  </div>
	  </div>
    <br />
    <hr />
   </form>  

 <?php  
 if (isset($_POST['submit'])) {
     $sgameyear=($_POST['gameyear']);
	 $parent_value = ($_POST['parent']);
	 
	 $sql="select s.*, dt.optname from schedule s
	       join dim_teams dt on (s.hteam = dt.tid or s.vteam = dt.tid)
		   where s.seasonyear= '" . $sgameyear . "' and (s.hteam = " . $parent_value . " or s.vteam= " . $parent_value .") 
		   and dt.optname <> (select optname from dim_teams where tid= ". $parent_value .") order by s.week"; 
	 $tsched=$db->query($sql);
	 
	 $sql = "select * from  dim_teams where tid = " . $parent_value;
	 $selteam=$db->query($sql);
	 $dteam = mysqli_fetch_assoc($selteam);
	 $teamname = $dteam['optname'];


	 ?>
	 <table class="table table-bordered table-striped tteamsched">

	    <thead>
		   <th><?php echo $teamname;?></th>
		<!--
		   <th>Date</th>
		   <th>W/L</th>
		   <th>H/A</th>
		   <th>Home Team</th>
		   <th>Homescore</th>
		   <th>Away Tean</th>
		   <th>Awayscore</th>
	-->	   
		</thead>

		
	 <?php while($info = mysqli_fetch_assoc($tsched))  :  ?>
	     <tr>
          <td><?=$info['gdate'];?></td>
		  <td><?php 
		  
		          if ($info['winner'] <> 0) {
   		             if ($info['hteam'] == $parent_value) {
                        if ($info['winner'] == 1){
                        	echo "Win";
                        } else {
                        	echo "Lose";
                         }

		             }
                     else {         //  team is road team
                         if ($info['winner'] == 2){
                        	echo "Win";
                         } else {
                         	echo "Lose";
                         }
                     }
				  } 
			 ?>
					
		  </td>
		  
		  <td><?php if ($info['hteam'] <> $parent_value) echo 'At'; ?></td>
		  <td><?php if ($info['hteam'] <> $parent_value){
		                 echo $info['optname'];
				    } else {
						 echo $teamname;
                    }
		  ?></td>
		  <td><?php  if ($info['winner'] <> 0) {
		                  echo $info['hscore']; 
		             }
			    ?>
		  </td>	
		  <td><?php if ($info['hteam'] <> $parent_value){
		                 echo $teamname;
				    } else {
						 echo $info['optname'];
                    }
		  ?></td>
		  <td><?php  if ($info['winner'] <> 0) { 
		                echo $info['vscore']; 
		             }
               ?>
			   </td>				  
		 </tr> 

   
	 <?php endwhile;  ?>
	 
	 </table>
   
  <?php
 }
?> 
   
  <!--     <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>  -->
	</div>



</body> 
</html>