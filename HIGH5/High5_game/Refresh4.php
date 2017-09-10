<?php
	include 'igrac.php';
	include 'poruka_poeni.php';
	require_once 'config.php';
	
	$uspesno = false;
	
	if($_REQUEST["id_utak"])
	{
		$id_utakmice = $_REQUEST["id_utak"];
		$sql = "SELECT * FROM utakmica WHERE id='$id_utakmice'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$poeni2 = new poeni($row['poeni_drugog_tima']);

		
		$uspesno = true;
		echo json_encode($poeni2);
	}
	
	if(!$uspesno)
	{
		echo json_encode("greska");
	}
?>