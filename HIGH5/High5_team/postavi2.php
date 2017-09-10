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

	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 2";
	$result = $conn->query($sql);
	$poz2 = array();
	$poz2 = $result->fetch_assoc();
	$result->close();
	$id2 = $poz2['id'];
	
	if(isset($_POST['modalSUB4']))
	{
		if(isset($_POST['mod4']))
		{
			$sql = "UPDATE igrac SET aktivan=NULL WHERE id='$id2'";
			$conn->query($sql);
			
			$up2 = $_POST['mod4'];
			
			$sql = "UPDATE igrac SET aktivan=2 WHERE id='$up2'";
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