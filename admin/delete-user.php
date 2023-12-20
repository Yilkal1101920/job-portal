<?php

session_start();

if(empty($_SESSION['id_admin'])) {
	header("Location: index.php");
	exit();
}


require_once("../db.php");

if(isset($_GET)) {
	$sql = "SELECT * FROM users WHERE id_user='$_GET[id]'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
	  while($row = $result->fetch_assoc()) {
		$firstname=$row['firstname'];
		$lastname=$row['lastname'];;
		$email=$row['email'];
		$sql = "INSERT INTO user_history(firstname, lastname, email) VALUES ('$firstname', '$lastname', '$email')";
		  $conn->query($sql);
	  }
	}
	//Delete Users data using id and redirect
	$sql = "DELETE FROM users WHERE id_user='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: user.php");
		exit();
	} else {
		echo "Error";
	}
}