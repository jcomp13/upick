<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php

  if (isset($_POST['signin'])) {
        echo '<p>Form triggered </p>';
  }
?>

<div id="background"></div>

<div class="container">
  <div id="login-wrapper" class="card card-default">
    
    <div class="card-block">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#login" class="nav-link text-success active" role="tab" data-toggle="tab">Login</a>
        </li>
      </ul>
      <div class="tab-content">
        <br>
        <div role="tabpanel" class="tab-pane active fade in" id="login">
          <form action="checklogin.php" method="post">
            <div class="clearfix"></div>
            <fieldset class="form-group">
              <input class="form-control" name="username" id="username" placeholder="Username/Email" type="text" required>
            </fieldset>
            <fieldset class="form-group">
              <input class="form-control" name="password" id="password" placeholder="Password" type="password" required>
            </fieldset>
		   <input type="submit" name="signin" value="Login" class="btn btn-primary pull-right">
          </form>
          <a href="#" class="pull-left text-info">Reset Password</a>
          <br>
          <div class="clearfix"></div>
        </div>
        
       </div>
    </div>
  </div>
</div>
<div id="midground"></div>
<div id="foreground"></div>

</body>
</html>