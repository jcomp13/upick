<?php
require_once('connectvars.php');

//function update_game($dbc, $lweek, $lyear, $g1, $hscore, $vscore, $v1)
function update_game($dbc, $week, $year, $gnum, $hscore, $vscore, $favorite)
{
			$sqlcheck = "select * from schedule where week=$week and seasonyear=$year and gamenum=$gnum";
			$ginfo = mysqli_query ($dbc, $sqlcheck) or die ("Error in query: $sqlcheck " . mysqli_error());
            $gameres=mysqli_fetch_assoc($ginfo);
			if ((($gameres['hscore'])== 0) and (($gameres['vscore'])==0)) {     // check if game was entered
				if ($favorite==1)     // home team favorite
				{
					 $sql = "update schedule set hscore = $hscore, vscore=$vscore where gamenum=$gnum  and seasonyear='$year' and week=$week ";
			         mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
					 if ($hscore > $vscore){
						 $sql = "update schedule set winner =1 where gamenum=$gnum  and seasonyear='$year' and week=$week ";
						 $winner=1;
					 }
					 else if ($vscore > $hscore) {
						 $sql = "update schedule set winner =2 where gamenum=$gnum  and seasonyear='$year' and week=$week ";	
						 $winner=2;
					 }
					 else  {
						 $sql = "update schedule set winner =3 where gamenum=$gnum  and seasonyear='$year' and week=$week ";
						 $winner=3;
					 }
					 mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
				}
				else   // visitor favorite
				{
					$sql = "update schedule set hscore = $vscore, vscore=$hscore where gamenum=$gnum  and seasonyear='$year' and week=$week ";
			         mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
					 if ($hscore > $vscore){
						 $sql = "update schedule set winner =2 where gamenum=$gnum  and seasonyear='$year' and week=$week ";
						 $winner=2;
					 }
					 else if ($vscore > $hscore) {
						 $sql = "update schedule set winner =1 where gamenum=$gnum  and seasonyear='$year' and week=$week ";
						 $winner=1;
					 }
					 else  {
						 $sql = "update schedule set winner =3 where gamenum=$gnum  and seasonyear='$year' and week=$week ";
                         $winner=3;						 
					 }
					 mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
				}
				// Updates picks for pick winner
				add_pick_result($dbc, $week, $year, $gnum, $winner);
				// add function to update pick for odds
				update_spread_results($dbc, $week, $year, $gnum);

			}
			//update_spread_results($dbc, $week, $year, $gnum);    // moved out to test
}


function add_pick_result($dbc, $week, $year, $gnum, $winner)
{
	    // won the game
        $sql = "update pick p
                join football_league l on l.lnum=p.league
                set p.result =1 
		        where p.gamenum=$gnum  
				and p.syear='$year' 
				and p.sweek=$week
				and l.type = 0 
				and (p.gpick = $winner || $winner = 3)
				";
		//echo $sql . '<br />';		
		 mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
		 // handle the lose
        $sql = "update pick p
                join football_league l on l.lnum = p.league
                set p.result =2 
		        where p.gamenum=$gnum  
				and p.syear='$year' 
				and p.sweek=$week
				and l.type = 0
				and (p.gpick <> $winner && $winner != 3)
				";
		 mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 		 
			//echo $sql . '<br />';		 
}



function num_leagues($owner)
{
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   //  get current configurations
   $query="select * from footconfig where cfgid = 1";
   $cfg = mysqli_query ($dbc, $query) or die ("Error in query: $query " . mysqli_error());
   $cfg_rec=mysqli_fetch_assoc($cfg);
   $sys_year= $cfg_rec['curryear'];
   $sys_week= $cfg_rec['currweek'];


 // check how many leagues the user is in
   $sql1="select * from userleague where uid=$owner and syear = $sys_year";  
   $result = mysqli_query ($dbc, $sql1) or die ("Error in query: $sql1 " . mysqli_error());
   $leaguecnt = mysqli_num_rows($result); 
   return($leaguecnt);
   mysqli_close($dbc);
} 


function update_spread_results($dbc, $week, $year, $gnum)
{
	// in picks 1 = home team 2 = visitor
	// in scheule favorite 1 = home team favored, 2=visitor favored
	$sql1="select * from schedule where seasonyear = $year and week = $week and gamenum = $gnum"; 
	$result = mysqli_query ($dbc, $sql1) or die ("Error in query: $sql1 " . mysqli_error());
	$sched=mysqli_fetch_assoc($result);
	$hscore = $sched['hscore'];
	$vscore = $sched['vscore'];

	if ($sched['favorite'] == 1) {            // home team favored
		$vscore = $vscore + $sched['odd'];
//		echo "updating visitor<br/>";
	}
	else {                        // visitor favored
		$hscore = $hscore + $sched['odd'];
//		echo "updating home<br/>";
	}
//	echo 'home score ' . $hscore . '<br/>';
//	echo 'vis score ' . $vscore . '<br/>';
    if ($hscore == $vscore) {     // everbody wins in tie
          $sql = "update pick p
                  join football_league l on l.lnum=p.league
                  set p.result =1     
		          where p.gamenum=$gnum  
				  and p.syear='$year' 
				  and p.sweek=$week
				  and l.type = 1";
           mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
    }
    else if ($hscore > $vscore) {   //    result 1 = win, 2  = lose
    	  //picked the favorite
          $sql = "update pick p
                  join football_league l on l.lnum=p.league
                  set p.result =1     
		          where p.gamenum=$gnum  
				  and p.syear='$year' 
				  and p.sweek=$week
				  and p.gpick=1
				  and l.type = 1";
		   mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());	  

          // picked the underdog
		  $sql = "update pick p
                  join football_league l on l.lnum=p.league
                  set p.result =2 
		          where p.gamenum=$gnum  
				  and p.syear='$year' 
				  and p.sweek=$week
				  and p.gpick=2
				  and l.type = 1";		  
           mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error()); 
    }
    else {
    	  //picked the underdog
          $sql = "update pick p
                  join football_league l on l.lnum=p.league
                  set p.result =1     
		          where p.gamenum=$gnum  
				  and p.syear='$year' 
				  and p.sweek=$week
				  and p.gpick=2
				  and l.type = 1";
		   mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());	  

          // picked the favorite
		  $sql = "update pick p
                  join football_league l on l.lnum=p.league
                  set p.result =2 
		          where p.gamenum=$gnum  
				  and p.syear='$year' 
				  and p.sweek=$week
				  and p.gpick=1
				  and l.type = 1";		  
           mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
    }
}


function clear_game_result($dbc, $week, $year, $gnum)
{

   $sql = "update schedule set vscore=0, hscore=0, winner=0 where gamenum=$gnum  and seasonyear='$year' and week=$week ";
   mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error($dbc)); 
   $sql = "update pick set result =0 where gamenum=$gnum  and syear='$year' and sweek=$week ";
   mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error($dbc)); 
}	
?>
			