<?php

session_start();

if(empty($_SESSION['id_admin'])) {
	header("Location: index.php");
	exit();
}


require_once("../db.php");

if(isset($_GET)) {
	$sql = "SELECT * FROM company WHERE id_company='$_GET[id]'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
	  while($row = $result->fetch_assoc()) {
		$companyname=$row['companyname'];
		$headofficecity=$row['headofficecity'];
		$contactno=$row['contactno'];
		$companytype=$row['companytype']; 
		  $sql = "INSERT INTO rejected_company(companyname, headofficecity, contactno, companytype) VALUES ('$companyname', '$headofficecity', '$contactno', '$companytype')";
		  $conn->query($sql);
	  }
	}
	//Delete Company using id and redirect
	$sql = "UPDATE company SET active='0' WHERE id_company='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: dashboard.php");
		exit();
	} else {
		echo "Error";
	}
}