<?php
  //To Handle Session Variables on This Page
  session_start(); 

  //If user is already logged in then redirect them back to dashboard. 
  //This is required if user tries to manually enter login.php in URL.
  if(isset($_SESSION['id_admin'])) {
    header("Location: dashboard.php");
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Login</title>
    <link rel="icon" href="../iconimage.png" type="image/icon type">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
    </style>
  </head>
  <body>
    
    <!-- NAVIGATION BAR -->
    <header>
      <nav class="navbar" style="background:red;">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Job Portal</a>
          </div>
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 well">
          <h2 class="text-center">Login</h2>
            <form method="post" action="checklogin.php">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>              
              <?php 
              //If User Failed To log in then show error message.
              if(isset($_SESSION['loginError'])) {
                ?>
                <div>
                  <p class="text-center">Invalid Username/Password! Try Again!</p>
                </div>
              <?php
               unset($_SESSION['loginError']); }
              ?>              
            </form>
          </div>
        </div>
      </div>
    </section>
    <footer id="footer" style="background:#f2efe6; position:absolute; margin-bottom: 0px; width:100%;">
    <hr>
      <section style="padding: top 10px;">
        <p style="text-align:center">Job Portal  &copy Copyright 2022.  All Rights Reserved</p>
        <p style="text-align:center"><a href="mailto:jobportal@gmail.com" class="mail">Mail us</a></p>
        <p id= "update" style="text-align:center"></p>
     </section>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(function() {
        var maxHeight = 0;

        $(".fixHeight").each(function() {
          maxHeight = ($(this).height() > maxHeight ? $(this).height() : maxHeight);
        });

        $(".fixHeight").height(maxHeight);
      });
      document.getElementById("update").innerHTML = document.lastModified;
    </script>
  </body>
</html>