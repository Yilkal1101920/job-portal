<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter dashboard.php in URL.
if(empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
	exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Company Dashboard</title>
    <link rel="icon" href="../iconimage.png" type="image/icon type">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    
    <!-- NAVIGATION BAR -->
    <header>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">Job Portal</a>
          </div>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <!-- Job Post Created Success Message. -->
    <!-- Todo: Remove Success Message Without Reload. -->
    <div class="container">
    <?php if(isset($_SESSION['jobPostSuccess'])) { ?>
      <div class="row successMessage">
        <div class="alert alert-success">
          Job Post Created Successfully!
        </div>
      </div>
    <?php unset($_SESSION['jobPostSuccess']); } ?>
    
    <!-- Job Post Updated Success Message. -->
    <!-- Todo: Remove Success Message Without Reload. -->
    <?php if(isset($_SESSION['jobPostUpdateSuccess'])) { ?>
      <div class="row successMessage">
        <div class="alert alert-success">
          Job Post Updated Successfully!
        </div>
      </div>
    <?php unset($_SESSION['jobPostUpdateSuccess']); } ?>

    <!-- Job Post Deleted Success Message. -->
    <!-- Todo: Remove Success Message Without Reload. -->
    <?php if(isset($_SESSION['jobPostDeleteSuccess'])) { ?>
      <div class="row successMessage">
        <div class="alert alert-success">
          Job Post Deleted Successfully!
        </div>
      </div>
    <?php unset($_SESSION['jobPostDeleteSuccess']); } ?>

      <div class="row">
        <h2 class="text-center">Dashboard</h2>
        <div class="col-md-2">
          <a href="create-job-post.php" class="btn btn-success btn-block btn-lg">Create Job Post</a>
        </div>
        <div class="col-md-2">
          <a href="view-job-post.php" class="btn btn-success btn-block btn-lg">View Job Post</a>
        </div>
        <?php
          $sql = "SELECT * FROM apply_job_post WHERE id_company='$_SESSION[id_user]' AND status='0'";//status = 0 , if the applied user is not rejected
          $result = $conn->query($sql);
          if($result->num_rows > 0) {
            ?>
           <div class="col-md-3">
             <a href="view-job-application.php" class="btn btn-success btn-block btn-lg">View Application <span class="badge"><?php echo $result->num_rows-1; ?></a>
           </div> 
            <?php
          }
        ?>
      </div>
    </div>
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
        $(".successMessage:visible").fadeOut(3000);
      });
    </script>
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