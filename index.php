<?php
  //To Handle Session Variables on This Page
  session_start();
  //Including Database Connection From db.php file to avoid rewriting in all files
  require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>user homepage</title>
    <link rel="icon" href="iconimage.png" type="image/icon type">

   <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <!-- NAVIGATION BAR -->
    <header class="bg-green text-white">
      <nav class="navbar" style="background:green;">
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

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
            <?php
            //Show user dashboard link once logged in.
            if(isset($_SESSION['id_user']) && empty($_SESSION['companyLogged'])) { 
              ?>
              <li><a href="user/dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
            <?php
              } else if(isset($_SESSION['id_user']) && isset($_SESSION['companyLogged'])) { 
              ?>
              <li><a href="company/dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
              <?php }  else { 
              //Show Login Links if no one is logged in.
            ?>
              <li><a href="company.php">Company</a></li>
              <li><a href="register.php">Register</a></li>
              <li><a href="login.php">Login</a></li>
            <?php } ?>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron text-center">
              <h1>All Ethiopian Jobs</p>
              <!-- <p><a class="btn btn-primary btn-lg" href="register.php" role="button">Register</a></p> -->
              <p><a class="btn btn-primary btn-lg" href="search.php" role="button">Search Job</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- LATEST JOB POSTS -->
    <section>
      <div class="container">
        <div class="row">
          <h2 class="text-center">Latest Job Posts</h2>
          <?php 
          /* Show any 4 random job post
           * 
           * Store sql query result in $result variable and loop through it if we have any rows
           * returned from database. $result->num_rows will return total number of rows returned from database.
          */
          $sql = "SELECT * FROM job_post Order By Rand() Limit 8";
          $result = $conn->query($sql);
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
             ?>
            <div class="col-md-6 fixHeight">             
              <h3><?php echo $row['jobtitle']; ?></h3>
              <p><?php echo $row['description']; ?></p>
              <a href="apply-job-post.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-default">Apply</a>
            </div>
          <?php
            }
          }
          else{
          ?>
            <div style="background: lightblue; height: 150px; text-align:center "><h2 style = "color: #fa0754; text-shadow: 2px 2px 2px #5dfa02, 0 0 35px yellow, 0 0 10px darkblue; padding-top: 65px">&#x1f64f Sorry, No Jobs available! Please Come Back Later &#8986</h2></div>
          <?php } ?>

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