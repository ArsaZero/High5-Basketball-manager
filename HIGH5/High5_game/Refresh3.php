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
		
		$poeni1 = new poeni($row['poeni_prvog_tima']);

		
		$uspesno = true;
		echo json_encode($poeni1);
	}
	
	if(!$uspesno)
	{
		echo json_encode("greska");
	}
?>