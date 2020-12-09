<?php
		$servername = "localhost";
		$username = "ci.xristodoulou";
		$password = "Christos";
		$dbname = "ci_xristodoulou";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
?>
