<?php
session_start();
/* Validating username and password from the database */
include('config.php');

$username=$_POST["username"];
$password=$_POST["password"];
$encpass=md5($_POST["password"]);


echo "username = " . $username;

$ress=mysqli_query($dbc, "SELECT * FROM footballuser WHERE uname = '$username' limit 1") or die(mysql_error());

$rows=mysqli_fetch_assoc($ress);

if(($rows["uname"]==$username)&&(($rows["pass"]==$password)||($rows["password"]==$encpass)))
{
   $_SESSION['username']=$username;
   $_SESSION['password']=$password;
   $_SESSION['encpassword']=$encpass;
   $_SESSION['id']=$rows['uid'];
   $_SESSION['super'] = $rows['userlevel'];
   $_SESSION['name']=$rows['fname'];

//  set cookies for 100 days
   if(isset($_POST['remember'])){
     setcookie("upickname", $_SESSION['username'], time()+60*60*24*100, "/");
     setcookie("upickpass", $_SESSION['password'], time()+60*60*24*100, "/");
     setcookie("upickepass", $_SESSION['encpassword'], time()+60*60*24*100, "/");
     setcookie("upickid", $_SESSION['id'], time()+60*60*24*100, "/");    
   }

   $page_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
   header('Location: ' . $page_url);

}
else {echo "wrong username or password<br/>";
      header('Location: ' . 'index.php?err=1');

}



?>