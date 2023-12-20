<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter dashboard.php in URL.
if(empty($_SESSION['id_admin'])) {
	header("Location: index.php");
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
    <title>Rejected user apply history</title>
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
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
        <?php
          $sql = "SELECT * FROM rejected_user_apply";
          $result = $conn->query($sql);
          if($result->num_rows > 0) {
            echo '<h3>Total Users Rejected: ' . $result->num_rows . '</h3>'; 
          }
        ?>
          <table class="table">
            <thead>
              <th>user_id</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Address</th>
              <th>City</th>
              <th>State</th>
              <th>Contact Number</th>
              <th>Qualification</th>                          
              <th>Stream</th>
              <th>passingyear</th>
              <th>date of birth</th>
              <th>age</th>
              <th>designation</th>
              <th>resume</th>
              <th>active</th>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT * FROM rejected_user_apply";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                  $i = 0;
                  while($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?php echo $row['id_user']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['city'];; ?></td>
                        <td><?php echo $row['state']; ?></td>
                        <td><?php echo $row['contactno']; ?></td>
                        <td><?php echo $row['qualification']; ?></td>
                        <td><?php echo $row['stream']; ?></td>
                        <td><?php echo $row['passingyear']; ?></td>
                        <td><?php echo $row['dob']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['designation']; ?></td>
                        <td><?php echo $row['resume']; ?></td>
                        <td><?php echo $row['active']; ?></td>
                      </tr>
                    <?php
                  }
                }
              ?>
            </tbody>
          </table>
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