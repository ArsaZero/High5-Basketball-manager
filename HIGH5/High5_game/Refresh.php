<?php
	include 'igrac.php';
	require_once 'config.php';
	
	$uspesno = false;
	
	class poruka{
		var $nova_poruka;
		public function __construct($p)
		{
			$this->nova_poruka = $p;
		}
	}
	
	if ($_REQUEST["id_utak"])
	{
		$id_utakmice = $_REQUEST["id_utak"];
		$sql = "SELECT * FROM utakmica WHERE id='$id_utakmice'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$tim1_poeni = $row['poeni_prvog_tima'];
		$tim2_poeni = $row['poeni_drugog_tima'];
		
		$tim1_id = $row['prvi_tim_id'];
		$tim2_id = $row['drugi_tim_id'];
		
		//$poruka = $row['poruka'];
		
		$msg = new poruka($row['poruka']);
		
		$sql = "SELECT * FROM igrac WHERE tim_id='$tim1_id'";
		$result = $conn->query($sql);
		
		$tim1_igraci = array();
		$tim2_igraci = array();
		
		while($row = $result->fetch_assoc())
		{
			//$id = $row['id'];
			$tim1_igraci[] = new igrac($row['id'], $row['broj_na_dresu'], $row['ime'], $row['prezime'], $row['starost'], $row['stamina'], $row['moral'], $row['visina'], $row['pozicija'], $row['brzina'], $row['agresivnost'], $row['sut_za_2'], $row['sut_za_3'], $row['sut_za_slobodna'], $row['skok_u_napadu'], $row['asistencija'], $row['dribling'], $row['skok_u_odbrani'], $row['blokada'], $row['presecen_pas'], $row['ukradena_lopta'], $row['aktivan'], $row['indeks'], $row['broj_poena']);
		}
		$result->close();
		
		$sql = "SELECT * FROM igrac WHERE tim_id='$tim2_id'";
		$result = $conn->query($sql);
		
		while($row = $result->fetch_assoc())
		{
			//$id = $row['id'];
			$tim2_igraci[] = new igrac($row['id'], $row['broj_na_dresu'], $row['ime'], $row['prezime'], $row['starost'], $row['stamina'], $row['moral'], $row['visina'], $row['pozicija'], $row['brzina'], $row['agresivnost'], $row['sut_za_2'], $row['sut_za_3'], $row['sut_za_slobodna'], $row['skok_u_napadu'], $row['asistencija'], $row['dribling'], $row['skok_u_odbrani'], $row['blokada'], $row['presecen_pas'], $row['ukradena_lopta'], $row['aktivan'], $row['indeks'], $row['broj_poena']);
		}
		$result->close();
		
		$uspesno = true;
		
		//echo json_encode($tim1_igraci);
		//echo json_encode($tim2_igraci);
		//echo json_encode($tim1_poeni);
		//echo json_encode($tim2_poeni);
		//echo json_encode($poruka);
		echo json_encode($msg);
	}
	
	if($uspesno === false)
	{
		echo json_encode("greska");
	}
	
?>