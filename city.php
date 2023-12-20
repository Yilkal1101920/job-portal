<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//If user Actually clicked login button 
if(isset($_POST)) {

	$sql = "SELECT * FROM cities WHERE StateNo='$_POST[id]' ORDER BY name";
	$result = $conn->query($sql);

	//if user table has this this login details
	if($result->num_rows > 0) {
		//output data
		while($row = $result->fetch_assoc()) {

			echo '<option value="'.$row["name"].'" data-id="'.$row["CityNo"].'">'.$row["name"].'</option>';

			}
			
	}
 	//Close database connection. Not compulsory but good practice.
 	$conn->close();

} 