<?php
	$conn = new mysqli("localhost", "root", "", "High5");
 
	if ($conn->connect_errno)
	{
		print ("Connection error (" . $conn->connect_errno . "): $conn->connect_error");
	}
?>