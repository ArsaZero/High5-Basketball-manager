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
		
		$tim1_id = $row['prvi_tim_id'];

		$tim1_igraci = array();
		
		$sql = "SELECT * FROM igrac WHERE tim_id='$tim1_id'";
		$result = $conn->query($sql);
		
		while($row = $result->fetch_assoc())
		{
			//$id = $row['id'];
			$tim1_igraci[] = new igrac($row['id'], $row['broj_na_dresu'], $row['ime'], $row['prezime'], $row['starost'], $row['stamina'], $row['moral'], $row['visina'], $row['pozicija'], $row['brzina'], $row['agresivnost'], $row['sut_za_2'], $row['sut_za_3'], $row['sut_za_slobodna'], $row['skok_u_napadu'], $row['asistencija'], $row['dribling'], $row['skok_u_odbrani'], $row['blokada'], $row['presecen_pas'], $row['ukradena_lopta'], $row['aktivan'], $row['indeks'], $row['broj_poena']);
		}
		$result->close();
		
		$uspesno = true;
		echo json_encode($tim1_igraci);
	}
	
	if(!$uspesno)
	{
		echo json_encode("greska");
	}
?>