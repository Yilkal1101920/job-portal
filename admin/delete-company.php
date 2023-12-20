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
		  $sql = "INSERT INTO company_history(companyname, headofficecity, contactno, companytype) VALUES ('$companyname', '$headofficecity', '$contactno', '$companytype')";
		  $conn->query($sql);
	  }
	}
	//Delete Company using id and redirect
	$sql = "DELETE FROM company WHERE id_company='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: company.php");
		exit();
	} else {
		echo "Error";
	}
}