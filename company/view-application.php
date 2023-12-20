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
    <title>Company view Application</title>
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
              <li><a href="./rejected_users_apply.php">Rejected Users</a></li>
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <div class="container">
      <div class="row">
        <div class="panel panel-info">
          <div class="panel-heading">User Application</div>
          <div class="panel-body">
            <?php
              $sql ="SELECT * FROM apply_job_post INNER JOIN users ON apply_job_post.id_user=users.id_user WHERE apply_job_post.id_user='$_GET[id_user]' AND apply_job_post.id_jobpost='$_GET[id_jobpost]' AND apply_job_post.status='0'";
              $result=$conn->query($sql);

              if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
              ?>
                
                <p>Name: <?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
                <p>Email: <?php echo $row['email']; ?></p>
                <p>Address: <?php echo $row['address']; ?></p>
                <p>City: <?php echo $row['city']; ?></p>
                <p>State: <?php echo $row['state']; ?></p>
                <p>Contact No: <?php echo $row['contactno']; ?></p>
                <p>Qualification: <?php echo $row['qualification']; ?></p>
                <p>Stream: <?php echo $row['stream']; ?></p>
                <p>Graduation Date: <?php echo $row['passingyear']; ?></p>
                <p>Date Of Birth: <?php echo $row['dob']; ?></p>
                <?php
                if(isset($row['resume'])) {
                  ?>
                  <a href="../uploads/resume/<?php echo $row['resume']; ?>" class="btn btn-success">View Resume</a>
                  <?php
                }
                ?>
                <a href="reject-user.php?id_user=<?php echo $_GET['id_user']; ?>&id_jobpost=<?php echo $row['id_jobpost']; ?>&email=<?php echo $row['email']; ?>" class="btn btn-danger">Reject User</a>

              <?php } } else { header("Location: dashboard.php"); exit(); } ?>
          </div>
        </div>
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
        $(".successMessage:visible").fadeOut(2000);
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