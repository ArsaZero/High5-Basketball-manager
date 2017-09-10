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

	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 4";
	$result = $conn->query($sql);
	$poz4 = array();
	$poz4 = $result->fetch_assoc();
	$result->close();
	$id4 = $poz4['id'];
	
	if(isset($_POST['modalSUB2']))
	{
		if(isset($_POST['mod2']))
		{
			$sql = "UPDATE igrac SET aktivan=NULL WHERE id='$id4'";
			$conn->query($sql);
			
			$up4 = $_POST['mod2'];
			
			$sql = "UPDATE igrac SET aktivan=4 WHERE id='$up4'";
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