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

	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 5";
	$result = $conn->query($sql);
	$poz5 = array();
	$poz5 = $result->fetch_assoc();
	$result->close();
	$id5 = $poz5['id'];
	
	if(isset($_POST['modalSUB1']))
	{
		if(isset($_POST['mod1']))
		{
			$sql = "UPDATE igrac SET aktivan=NULL WHERE id='$id5'";
			$conn->query($sql);
			
			$up5 = $_POST['mod1'];
			
			$sql = "UPDATE igrac SET aktivan=5 WHERE id='$up5'";
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