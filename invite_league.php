<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - Invite Member</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  
  
</head>
<body>
<div class="container">
  <h2>UPick Football - Invite Member</h2>

<?php
  require_once('connectvars.php');

session_start();

   // Make sure sessions are set, otherwise pick out
   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }
  $owner = $_SESSION['id'];
  if (isset($_POST['submit'])) {
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	  $mail=mysqli_real_escape_string($dbc,trim($_POST['email']));
      $name=mysqli_real_escape_string($dbc,trim($_POST['lname']));
	  
	  // Get league information
	  $query="select * from football_league where lname='$name' and year = (select curryear from footconfig where cfgid=1)order by lname";
	  $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 
	  $row=mysqli_fetch_assoc($result);
	  $hashnum=$row["hashfield"];
	  $leaguenum=$row["lnum"];
	  
	  // Verify all field populated
	  if (empty($mail)){
		  echo '<p class="error">Must enter an email</p>';
	  }
	  else {
		  //   CHeck to make sure member does not already belong to the league
		  $query ="select * from userleague ul join footballuser fu on ul.uid=fu.uid where fu.email='$mail' and ul.league=$leaguenum";
		  $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 
		  $num_results = mysqli_num_rows($result); 
          if ($num_results > 0){  // member already in league	  
		      echo '<p>' . $mail . ' is already a member of the league</p>'; 
		  }
		  else {   // not a member of the league
			  //  make sure invite was not sent.  If so just send another e-mail
	     	  $query="select * from invites where email='$mail' and leagueid=$leaguenum";
		      $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 
		      $num_results = mysqli_num_rows($result); 
              if ($num_results < 1){  // Invite not found
    	         $emailuser=0;
		         $query="select * from footballuser where email='$mail'";
		         $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 
	             $num_results = mysqli_num_rows($result); 
                 if ($num_results > 0){  
		            $row=mysqli_fetch_assoc($result);
		            $emailuser = $row['uid'];     // invite sent to member
		         }
		         $query="insert into invites(email, uid, leagueid, hashkey)values ('$mail', '$emailuser', '$leaguenum', '$hashnum')";
		         mysqli_query($dbc, $query);
		     }
		     else {
			     $row=mysqli_fetch_assoc($result);
			     $hashnum = $row['hashkey'];
			  
		     }   
		  		  
		     // Check if invitation was sent to an active member
		     $query="select * from footballuser where email='$mail'";
		     $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 
	         $num_results = mysqli_num_rows($result); 
             if ($num_results > 0){  
		         $member=1;           // email as user
		         $row=mysqli_fetch_assoc($result);
			     $lettername = isset($row['fname']) ? $row['fname'] : $mail;
		     }
		     else {
			    $member=0;           // not a registered user
			    $lettername =  $mail; 
		     }
		  
		      // get the senders name
		      $query ="select * from footballuser where uid=$owner";
		      $result = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error()); 
		      $row=mysqli_fetch_assoc($result);
		      $letterfrom = $row['fname'] . ' ' . $row['lname'];
		  		  
	         // now create e-mail to send
		     $intro = "Hi $lettername \n" .
		         "$letterfrom has invited you to join a football league at UPick Football\n" .
			     "If you would like to participate please go to http://seakritters.com/football/index.php to complete the registration  \n\n";
		  
		     if ($member = 1 ) {
		           $instruct =  " To complete registration, just log in, select 'League Membership', 'Join League' \n" .
	                            "Select the league $name and use the registration code $hashnum \n";
		     }
		     else{
			     $instruct =  " To complete registration, Create an account, then select 'League Membership', 'Join League' \n" .
	                            "Select the league '$name', and use the registration code $hashnum\n";
		     }
		     $msg=$intro . $instruct;
		  
		     $fmail = "admin@jerseyshoreas.org";  
		     $subject = "UPick Football Invitation";
		     ini_set("sendmail_from",$fmail);            
             mail($mail, $subject, $msg, 'From:' . $fmail);  
		     echo '<p>Invitation has been sent</p>';
     	  }
	  }
      mysqli_close($dbc);
  }
?>
<?php
   include_once 'foot_nav.php'; 
?>
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
     <?php
	    
	    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");
        //mysqli_select_db(DB_NAME)or die("Connection Failed"); 
	    $query="select * from football_league where managerid=$owner and year = (select curryear from footconfig where cfgid=1)order by lname"; 
	    $result = mysqli_query ($con, $query) or die ("Error in query: $query " . mysqli_error()); 
	    $num_results = mysqli_num_rows($result); 
        if ($num_results > 0){ 
	      echo '<label for="league">League:</label>';
          echo "<select name=lname value=''></option>";
          // printing the list box select command
          while($nt=mysqli_fetch_array($result)){     //Array or records stored in $nt
            echo '<option value="'.htmlspecialchars($nt['lname']).'">'.htmlspecialchars($nt['lname']).'</option>';
   
            /* Option values are added by looping through the array */
          }
          echo "</select>";// Closing of list box
		
		  echo '<br />';
	      echo '<hr />';
  
  
          echo '<label for="email">E-mail:</label>';
		  ?>
          <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br />
          <?php
          echo '<input type="submit" value="Add" name="submit" />';
          echo '<br />';
          echo '<hr />';
		  //  These fields do not have an input box, so hide then and the form submit will grab the value
          //echo '<input type="hidden"     name ="leaguenum"   value="' . $nt['lnum']. '" />';
          //echo '<input type="hidden"     name ="hashnum"   value="' . $nt['hashfield']. '" />';		  
		} 
		else {
			echo '<p>Sorry, you need to be the admin of a league to invite members</p>';
		}
		mysqli_close($con);
	?>
  </form>
 	   <br />
       <hr />
	 
  <!--     <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>    -->
	</div> 
  
  
</body> 
</html>