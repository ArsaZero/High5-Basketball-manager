<?php
	include 'poruka_poeni.php';
	require_once 'config.php';
	session_start();
	
	
	//if($_REQUEST["id_utak"])
	//{
		$user_id = $_SESSION['username'];
		
		$sql = "SELECT * FROM korisnik WHERE username='$user_id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$tim_id = $row['tim_id'];
		
		$id_utakmice = $_REQUEST["id_utak"];
		
		$sql = "SELECT * FROM utakmica WHERE id='$id_utakmice'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		if($row['btimeout_t1'] == 1 || $row['btimeout_t2'] == 1)
		{
			$p = new poruka("jeste");
				echo json_encode($p);
		}
		else
		{
			$p = new poruka("nije");
				echo json_encode($p);
		}
	//}
?>