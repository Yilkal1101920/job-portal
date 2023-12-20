<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter dashboard.php in URL.
if(empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
	exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>user | Dashboard</title>
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

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="./profile.php">Profile</a></li>
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <div class="container">

      <!-- Applied To Job Success Message. -->
      <!-- Todo: Remove Success Message Without Reload. -->
      <?php if(isset($_SESSION['jobApplySuccess'])) { ?>
      <div class="row">
        <div class="col-md-12 successMessage">
          <div class="alert alert-success">
            You Have Successfully Applied!
          </div>
        </div>
      </div>
      <?php unset($_SESSION['jobApplySuccess']); } ?>


      <?php
              //If User have successfully Updated his profile then show them this success message
              //Todo: Remove Success Message without reload?
      if(isset($_SESSION['updateCompleted'])) { ?>
      <div class="row">
        <div class="col-md-12 successMessage" id = "succesMessage">
          <div class="alert alert-success">
          Your profle is updated successfully
          </div>
        </div>
      </div>
      <?php unset($_SESSION['updateCompleted']); } ?>


      <?php
              //If User have successfully Uploaded his resume then show them this success message
              //Todo: Remove Success Message without reload?
      if(isset($_SESSION['uploadSuccess'])) { ?>
      <div class="row">
        <div class="col-md-12 successMessage" id = "succesMessageUpload">
          <div class="alert alert-success">
          Your Resume is uploaded successfully
          </div>
        </div>
      </div>
      <?php unset($_SESSION['uploadSuccess']); } ?>
      

      <!-- Other Dashboard Functions -->
      <div class="row">
        <h2 class="text-center">My Dashboard</h2>
        <div class="col-md-2">
          <a href="applied-jobs.php" class="btn btn-success">Applied Jobs</a>
        </div>
        
        <div class="col-md-2">
          <a href="resume-upload.php" class="btn btn-success">Upload Resume</a>
        </div>
        <?php
        //If resume is uploaded then show download link.
        $sql = "SELECT resume FROM users WHERE id_user='$_SESSION[id_user]' AND resume IS NOT NULL";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          ?>
        <div class="col-md-2">
          <a href="../uploads/resume/<?php echo $row['resume']; ?>" class="btn btn-success">Show Resume</a>
        </div>
        <?php }  ?>
        

      <!-- Search and Apply To Job Posts -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Active Jobs</h2>
            <table class="table table-striped">
              <thead>
                <th>Job Name</th>
                <th>Job Description</th>
                <th>Minimum Salary</th>
                <th>Maximum Salary</th>
                <th>Experience</th>
                <th>Qualification</th>
                <th>Posted Date</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php 
                  //Sql for showing all job posts
                  $sql = "SELECT * FROM job_post";
                  $result = $conn->query($sql);

                  //if there are job posts then display them.
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {
                      //Check if user has applied to job or not. If applied dont show apply link.
                      $sql1 = "SELECT * FROM apply_job_post WHERE id_user='$_SESSION[id_user]' AND id_jobpost='$row[id_jobpost]'";
                      $result1 = $conn->query($sql1);
                      
                     ?>
                      <tr>
                        <td><?php echo $row['jobtitle']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['minimumsalary']; ?></td>
                        <td><?php echo $row['maximumsalary']; ?></td>
                        <td><?php echo $row['experience']; ?></td>
                        <td><?php echo $row['qualification']; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($row['createdat'])); ?></td>
                        <?php
                        // If User already applied to job post then don't show apply link.
                        if($result1->num_rows > 0) { 
                          ?>
                           <td><strong>Applied</strong></td>
                          <?php
                        } else {
                        ?>
                        <td><a href="apply-job-post.php?id=<?php echo $row['id_jobpost']; ?>">Apply</a></td>
                        <?php } ?>                        
                      </tr>
                     <?php
                    }
                  }
                  $conn->close();
                ?>
              </tbody>
            </table>
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
        $(".successMessage:visible").fadeOut(3000);
      });
    
      $(function() {
        $("#succesMessage:visible").fadeOut(3000);
      });

      $(function() {
        $("#succesMessageUpload:visible").fadeOut(3000);
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