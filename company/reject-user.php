<?php

session_start();

require_once("../db.php");

$sql = "SELECT * FROM users WHERE id_user='$_GET[id_user]'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$id_user=$row['id_user'];
	$firstname=$row['firstname'];
	$lastname=$row['lastname'];
	$email=$row['email']; 
	$address=$row['address']; 
	$city=$row['city']; 
	$state=$row['state']; 
	$contactno=$row['contactno']; 
	$qualification=$row['qualification']; 
	$stream=$row['stream']; 
	$passingyear=$row['passingyear']; 
	$dob=$row['dob']; 
	$age=$row['age']; 
	$designation=$row['designation']; 
	$resume=$row['resume'];  
	$active=$row['active']; 
	  $sql = "INSERT INTO rejected_user_apply(id_user, firstname, lastname, email, address, city, state, contactno, qualification, stream, passingyear, dob, age, designation, resume, active) VALUES ('$id_user', '$firstname', '$lastname', '$email', '$address', '$city', '$state', '$contactno', '$qualification', '$stream', '$passingyear', '$dob', '$age', '$designation', '$resume', '$active')";
	  $conn->query($sql);
  }
}
//Status 0 means show user and Status 1 means don't show user details for this job post.
$sql = "UPDATE apply_job_post SET status='1' WHERE id_jobpost='$_GET[id_jobpost]' AND id_user='$_GET[id_user]'";

if($conn->query($sql) === TRUE) {

	$sql1 = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id_jobpost]'";
  $result1 = $conn->query($sql1);

  if($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) 
    {
		header("Location: view-job-application.php");
		exit();
	}
	}
	
} else {
	echo "Error!";
}

$conn->close();