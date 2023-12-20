<?php

session_start();

if(empty($_SESSION['id_admin'])) {
	header("Location: index.php");
	exit();
}


require_once("../db.php");

if(isset($_GET)) {
	$sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
	  while($row = $result->fetch_assoc()) {;
		$jobtitle=$row['jobtitle'];
		$description=$row['description'];
		$minimumsalary=$row['minimumsalary'];
		$maximumsalary=$row['maximumsalary'];
		$sql = "INSERT INTO job_history(jobtitle, description, minimumsalary, maximumsalary) VALUES ('$jobtitle', '$description', '$minimumsalary', '$maximumsalary')";
		  $conn->query($sql);
	  }
	}
	//Delete job_post and apply_job_post details using specified job post id.
	$sql = "DELETE FROM job_post WHERE id_jobpost='$_GET[id]'";
	if($conn->query($sql)) {
		$sql1 = "DELETE FROM apply_job_post WHERE id_jobpost='$_GET[id]'";
		if($conn->query($sql1)) {
		}
		header("Location: job-posts.php");
		exit();
	} else {
		echo "Error";
	}
}