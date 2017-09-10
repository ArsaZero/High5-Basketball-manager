<?php
	require_once 'config.php';
	session_start();
	
		$username = $_SESSION['username'];
		//$utakmica_id = $_POST['id_utakmice'];
		
		$sql = "SELECT * FROM korisnik WHERE username='$username'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$result->close();
		$tim_id = $row['tim_id'];
		
		$sql = "SELECT * FROM utakmica WHERE status = 'A' AND (prvi_tim_id = '$tim_id' OR drugi_tim_id = '$tim_id')";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$result->close();
		$id = $row['id'];
		
		if ($row['prvi_tim_id'] == $tim_id && $row['btimeout_t1'] == 1)
		{
			$sql = "UPDATE utakmica SET btimeout_t1='2' WHERE id='$id'";
			$result = $conn->query($sql);
		}
		else if ($row['drugi_tim_id'] == $tim_id && $row['btimeout_t2'] == 1)
		{
			$sql = "UPDATE utakmica SET btimeout_t2='2' WHERE id='$id'";
			$result = $conn->query($sql);
		}
?>