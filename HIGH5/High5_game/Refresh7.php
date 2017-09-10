<?php
	include 'vreme_i_cetvrtina.php';
	require_once 'config.php';
	
	$uspesno = false;
	
	if($_REQUEST["id_utak"])
	{
		$id_utakmice = $_REQUEST["id_utak"];
		$sql = "SELECT * FROM utakmica WHERE id='$id_utakmice'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$minut = new minuti($row['minuti']);

		
		$uspesno = true;
		echo json_encode($minut);
	}
	
	if(!$uspesno)
	{
		echo json_encode("greska");
	}
?>