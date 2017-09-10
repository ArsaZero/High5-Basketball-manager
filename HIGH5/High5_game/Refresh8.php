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
		
		$sek = new sekunde($row['sekunde']);

		
		$uspesno = true;
		echo json_encode($sek);
	}
	
	if(!$uspesno)
	{
		echo json_encode("greska");
	}
?>