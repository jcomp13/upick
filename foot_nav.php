<?php
  require_once('connectvars.php');
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">UPick Football</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
     <!--   <li class="active"><a href="#">Home</a></li>   -->
		
	 <?php  if (isset($_SESSION['id'])) {	?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Create League <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="create_league.php">Set Up League</a></li>
            <li><a href="invite_league.php">Invite Members</a></li>
            <li><a href="join_league.php">Join League</a></li>
          </ul>
        </li>
        <li><a href="pickgames.php">Pick Games</a></li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">View Results <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="playerweeklypicks.php">Weekly Game Results</a></li>
            <li><a href="user_standing.php">User Standings</a></li>
            <li><a href="user_week_result.php">Weekly Records</a></li>
            <li><a href="scheduleview.php">Weekly Schedules</a></li>  
            <li><a href="teamsched.php">Team Schedules</a></li>
            <li><a href="standings.php">Team Standings</a></li>           
          </ul>
        </li>
        <li><a href="display_picks.php">View Weeks Picks</a></li>
<?php
  if ($_SESSION['super']==1) {		?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="gameresults.php">Enter Game Results</a></li>
            <li><a href="clearresult.php">Clear Game Results</a></li>           
            <li><a href="changeweek.php">Update Current Week</a></li>
            <li><a href="updplayerresult.php">Update Player Results</a></li>
            <li><a href="updateteamrecs.php">Update Team Records</a></li>  
            <li><a href="addschedule.php">Add Schedules</a></li>
            <li><a href="addodds.php">Add Odds</a></li>
            <li><a href="update_user.php">Update User</a></li>
            <li><a href="set_teams.php">Set Team Records</a></li>                        
          </ul>
        </li>
			 <?php }	?>
		
	 <?php }	?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">About<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">About Us</a></li>
            <li><a href="#">About App</a></li>
          </ul>
        </li>

        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>

        <?php if (isset($_SESSION['name'])) {  ?>
            <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['name'];  ?><span class="caret"></span></a>
               <ul class="dropdown-menu">

                   <?php
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failure");
                        $query="select * from footconfig where cfgid = 1";
                        $cfg = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
                        $cfg_rec=mysqli_fetch_assoc($cfg);
                        $sys_year= $cfg_rec['curryear'];

                        $query="select * from multileague  where syear=" . $sys_year . " and uid= " . $_SESSION['id'];
                        $cfg = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
                        $cfg_rec=mysqli_fetch_assoc($cfg);
                        if ($cfg_rec['multiflag']== "Y") {   
                      ?>

                           <li><a href="change_league.php">Change League</a></li>
                        <?php } ?>
                


                  <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
        <?php    
        } 
        else {   ?>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php }  ?>
   



      </ul>
    </div>
  </div>
</nav>