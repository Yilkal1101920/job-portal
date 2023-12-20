<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter edit-job-post.php in URL.
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
    <title>Company Edit Job</title>
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
              <li><a href="dashboard.php">Dashboard</a></li>
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 well">
          <h2 class="text-center">Update Job Post</h2>
            <form method="post" action="editpost.php">
            <?php
            //Sql Query for show job post to edit if it is created with logged in company.
            $sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]' AND id_company='$_SESSION[id_user]'";
            $result = $conn->query($sql);

            //If job post is created by logged in company then show job post details to edit.
            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) 
              {
            ?>
              <div class="form-group">
                <label for="jobtitle">Job Title</label>
                <input type="text" class="form-control" id="jobtitle" name="jobtitle" value="<?php echo $row['jobtitle']; ?>" placeholder="Job Title" required="">
              </div>
              <div class="form-group">
                <label for="description">Job Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Job Description" required=""><?php echo $row['description']; ?></textarea>
              </div>
              <div class="form-group">
                <label for="minimumsalary">Minimum Salary</label>
                <input type="text" class="form-control" id="minimumsalary" value="<?php echo $row['minimumsalary']; ?>" name="minimumsalary" placeholder="Minimum Salary" required="">
              </div>
              <div class="form-group">
                <label for="maximumsalary">Maximum Salary</label>
                <input type="text" class="form-control" id="maximumsalary" name="maximumsalary" value="<?php echo $row['maximumsalary']; ?>" placeholder="Maximum Salary" required="">
              </div>
              <div class="form-group">
                <label for="experience">Experience Required</label>
                <input type="text" class="form-control" id="experience" name="experience" value="<?php echo $row['experience']; ?>" placeholder="Experience Required" required="">
              </div>
              <div class="form-group">
                <label for="qualification">Qualification Required</label>
                <input type="text" class="form-control" id="qualification" name="qualification" value="<?php echo $row['qualification']; ?>" placeholder="Qualification Required" required="">
              </div>
              <input type="hidden" name="target_id" value="<?php echo $_GET['id']; ?>">
              <div class="text-center">
                <button type="submit" class="btn btn-success">Update</button>
              </div>
              <?php 
                }
              } else {
                //If job post not created by logged in company then redirect to dashboard.
                header("Location: dashboard.php");
                exit();
              }
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