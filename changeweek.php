<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UPick Football - Update Week</title>
  <link rel="stylesheet" type="text/css" href="css/fball.css" />
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  
  
  
  

  <script language="javascript" type="text/javascript">

///  start of function
//       function setUser(uid){
//             var ajaxRequest;  // The variable that makes Ajax possible!

//          try{
//              // Opera 8.0+, Firefox, Safari
//             ajaxRequest = new XMLHttpRequest();
//          }
//         catch (e){
//              // Internet Explorer Browsers
//              try{
//                  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
//              }
//              catch (e) {
//                   try{
//                       ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
//                   }
//                   catch (e){
//                         // Something went wrong
//                        alert("Your browser is not supported!");
//                        return false;
//                    }
//              }
//        }
//         // Create a function that will receive data 
//       // sent from the server and will update div section in the same page.
//       ajaxRequest.onreadystatechange = function(){
//           if(ajaxRequest.readyState == 4){
//                updateUser(ajaxRequest.responseText);
//           }
//        }
//        var queryString = "?uname="+uid ;
//        ajaxRequest.open("GET", "pullUserInfo.php" + queryString, true);
//        ajaxRequest.send(null);
// }     

//           function updateUser(response) {
//                  var obj = JSON.parse(response);
//                  setLevelElement(obj.level, obj.stat) ;
//                  //document.getElementById("dbug").innerHTML="JSONfunction";    '50
//           }


//      function setLevelElement(levelValue, statusValue) 
//       {
//           var element = document.getElementById("level");
//           element.value = levelValue;
//           var statuselement = document.getElementById("status");
//           statuselement.value = statusValue;
//      }


///  end of function

  </script>
</head>
<body>
<div class="container">
  <h2>UPick Football - Change Week</h2>

<?php
  require_once('connectvars.php');


session_start();

   if (!isset($_SESSION['id'])) {
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: ' . $home_url);
   }

   if (isset($_POST['submit'])) {
       
     $nweek = $_POST['activeweek'];
     $nyear = $_POST['activeyear'];

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $newWeek = mysqli_real_escape_string($dbc, trim($_POST['activeweek']));
    $newYear = mysqli_real_escape_string($dbc, trim($_POST['activeyear']));
    $newodd = mysqli_real_escape_string($dbc, trim($_POST['oddweek']));	
	
    $query =  "UPDATE footconfig SET currweek='$newWeek', curryear='$newYear' , oddweek='$newodd'  WHERE cfgid = 1 limit 1";
    $result = mysqli_query($dbc, $query);
   
     if (!$result) {
        printf("Error: %s\n", mysqli_error($dbc));
        exit();
     }
     else {
          echo '<p>Week is updated to ' . $newWeek . '/' . $newYear  . '</p>';

      }  
     mysqli_close($dbc);  
   }
?>

<?php
   include_once 'foot_nav.php'; 
?>

<form enctype="multipart/form-data" name="usrfrm" id="usrfrm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  $query = "SELECT  *  from footconfig WHERE cfgid = 1 limit 1";
  $result =  mysqli_query($dbc, $query);
  $row = mysqli_fetch_assoc($result); 
  $nweek = $row["currweek"];
  $nyear = $row["curryear"];
  $oweek = $row["oddweek"];
?>
          <div class="field">
              <label for="activeweek">Current Week</label>
              <input type="text" id='week' class="text-input" autocomplete="off" name="activeweek" maxlength="2" 
                                  value=<?php echo $nweek; ?>   >
          </div>
         <div class="field">
              <label for="oddweek">Odds Week</label>
              <input type="text" id='week' class="text-input" autocomplete="off" name="oddweek" maxlength="2" 
                                  value=<?php echo $oweek; ?>   >
          </div>		  
          <div class="field">
              <label for="activeyear">Current Year</label>
              <input type="text" id='Year' class="text-input" autocomplete="off" name="activeyear" maxlength="4" 
                                      value=<?php echo $nyear; ?>  >
          </div>

    <input type="submit" value="Update" name="submit"/>

  </form>
      <br />
      <hr />
<!--  	 <p class="btn btn-primary" ><a href="index.php"> <span style="color:white">&lt;&lt; Back to main page</span></a></p>  -->
	 
 </div>	 
  
  
</body> 
</html>