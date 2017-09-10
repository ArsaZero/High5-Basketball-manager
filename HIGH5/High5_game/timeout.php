<?php
	require_once 'config.php';
	session_start(); //timeout_t1 timeout_t2 
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
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
		
		if($tim_id == $row['prvi_tim_id'])
		{
			if($row['btimeout_t1'] == 2)
			{
				$message = "Cannot request another timeout during this quarter!";
				echo "<script type='text/javascript'>alert('$message');
				window.location.href='/HIGH5/High5_game/High5_game.php';</script>";
			}
			else if($row['timeout_t2'] == 1)
			{
				$message = "Other team already asked for a timeout!";
				echo "<script type='text/javascript'>alert('$message');
				window.location.href='/HIGH5/High5_game/High5_game.php';</script>";
			}
			else
			{
				$sql = "UPDATE utakmica SET timeout_t1='1' WHERE id='$id'";
				$result = $conn->query($sql);
				
				$message = "Success!";
				echo "<script type='text/javascript'>alert('$message');
				window.location.href='/HIGH5/High5_game/High5_game.php';</script>";
			}
		}
		else if($tim_id == $row['drugi_tim_id'])
		{
			if($row['btimeout_t2'] == 2)
			{
				$message = "Cannot request another timeout during this quarter!";
				echo "<script type='text/javascript'>alert('$message');
				window.location.href='/HIGH5/High5_game/High5_game.php';</script>";
			}
			else if($row['timeout_t1'] == 1)
			{
				$message = "Other team already asked for a timeout!";
				echo "<script type='text/javascript'>alert('$message');
				window.location.href='/HIGH5/High5_game/High5_game.php';</script>";
			}
			else
			{
				$sql = "UPDATE utakmica SET timeout_t2='1' WHERE id='$id'";
				$result = $conn->query($sql);
				
				$message = "Success!";
				echo "<script type='text/javascript'>alert('$message');
				window.location.href='/HIGH5/High5_game/High5_game.php';</script>";
			}
		}
	}
	
?>