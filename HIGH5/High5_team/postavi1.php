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

	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 1";
	$result = $conn->query($sql);
	$poz1 = array();
	$poz1 = $result->fetch_assoc();
	$result->close();
	$id1 = $poz1['id'];
	
	if(isset($_POST['modalSUB5']))
	{	
		if(isset($_POST['mod5']))
		{
			$sql = "UPDATE igrac SET aktivan=NULL WHERE id='$id1'";
			$conn->query($sql);
		
			$up1 = $_POST['mod5'];

			$sql = "UPDATE igrac SET aktivan=1 WHERE id='$up1'";
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