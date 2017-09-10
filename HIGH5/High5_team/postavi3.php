<?php
include 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") 
{	
	$username = $_SESSION['username'];
	$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$tim_id = (int)$row['tim_id'];
	$result->close();

	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 3";
	$result = $conn->query($sql);
	$poz3 = array();
	$poz3 = $result->fetch_assoc();
	$result->close();
	$id3 = $poz3['id'];
	
	if(isset($_POST['modalSUB3']))
	{
		if(isset($_POST['mod3']))
		{
			$sql = "UPDATE igrac SET aktivan=NULL WHERE id='$id3'";
			$conn->query($sql);
			
			$up3 = $_POST['mod3'];
			
			$sql = "UPDATE igrac SET aktivan=3 WHERE id='$up3'";
			$conn->query($sql);
		}
	}
	header('location: /HIGH5/high5_team/High5_team.php');
}
else
{
	$message = "REQUEST_METHOD != POST";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>