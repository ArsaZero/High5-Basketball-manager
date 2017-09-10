<?php
ini_set('max_execution_time',1500);
ini_set('xdebug.max_nesting_level', 3000);
require_once 'config.php';
include 'tim.php';

$poenit1 = 0;
$t1 = 0;
$tim1id = 0;
$broj_odigranih_t1 = 0;
$pobede_t1 = 0;
$porazi_t1 = 0;
$br_bodova_t1 = 0;
$kolicnik_t1 = 0;
$forma_t1 = 0;
$budzet_t1 = 0;
$sponzor_t1 = 0;
$sedista_t1 = 0;
$hrana_t1 = 0;
$parking_t1 = 0;
$pice_t1 = 0;
$cena_t1 = 0;
$pozicija_t1 = 0;

$poenit2 = 0;
$t2 = 0;
$tim2id = 0;
$broj_odigranih_t2 = 0;
$pobede_t2 = 0;
$porazi_t2 = 0;
$br_bodova_t2 = 0;
$kolicnik_t2 = 0;
$forma_t2 = 0;
$budzet_t2 = 0;
$sponzor_t2 = 0;
$sedista_t2 = 0;
$hrana_t2 = 0;
$parking_t2 = 0;
$pice_t2 = 0;
$cena_t2 = 0;
$pozicija_t2 = 0;

$cetvr = 0;
$min = 0;
$sec = 0;
$ukupnoVreme = 0;
$napadtim = 0;
$imaloptu = 0;
$potez = 1;
	
$flag_za_reset = 0; //prva iteracija kroz while treba da resetuje index i poene svih igraca na 0
$ukupnoVreme = 0;
$cetvrtine = 1;
$id = 0;
$produzetak = false;

while (true)
{
	$fl = 0;
	$sql = "SELECT tr_kolo FROM liga WHERE id='1'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$kolo = (int)$row['tr_kolo'];
	$result->close();

	$sql = "SELECT * FROM utakmica WHERE br_kola='$kolo'";
	$result = $conn->query($sql);
	if($result)
	{
		while($row = $result->fetch_assoc())
		{
			$idUtk = (int)$row['id'];
			$tim1 = (int)$row['prvi_tim_id'];
			$tim2 = (int)$row['drugi_tim_id'];
			$ptim1 = (int)$row['poeni_prvog_tima'];
			$ptim2 = (int)$row['poeni_drugog_tima'];
			$dt = $row['datum_i_vreme'];
			$time = strtotime($dt);	
			$format = date("m/d/y g:i A", $time);
			if($format == date("m/d/y g:i A"))
			{
				$conn->query("UPDATE utakmica SET status = 'A' WHERE id = '$idUtk'");
				$fl = 1;
			}
		}
	}
	if($fl == 1)
	{
		utakmica();
	}
}

function utakmica()
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez, $min, $sec, $cetvr;
//if($cetvrtine < 5)
//{
	$sql = "SELECT tr_kolo FROM liga WHERE id='1'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$kolo = (int)$row['tr_kolo'];
	$result->close();

	$ukupnoVreme = 0;

	$sql = "SELECT * FROM utakmica WHERE br_kola='$kolo'";
	$result = $conn->query($sql);
	if($result)
	{
		
		while($row = $result->fetch_assoc())
		{
			//echo $cetvrtine;
			$idUtk = (int)$row['id'];
			$tim1 = (int)$row['prvi_tim_id'];
			$tim2 = (int)$row['drugi_tim_id'];
			$ptim1 = (int)$row['poeni_prvog_tima'];
			$ptim2 = (int)$row['poeni_drugog_tima'];
			$dt = $row['datum_i_vreme'];
			$s = $row['status'];
			$time = strtotime($dt);	
			$format = date("m/d/y g:i A", $time);
			
			/*echo $format;
			print ("<br>");
			echo date("m/d/y g:i A");
			print ("<br>");*/
			
			if($s == 'A')
			{
				$id = $idUtk;
				$conn->query("UPDATE utakmica SET status = 'A' WHERE id = '$id'");
				$min = (int)$row['minuti'];
				$sec = (int)$row['sekunde'];
				$cetvr = (int)$row['cetvrtina'];
				if($cetvr == 0)
				{
					$cetvr++;
				}
				$conn->query("UPDATE utakmica SET cetvrtina = '$cetvr' WHERE id = '$id'");				
				$niz1 = array();
				$niz2 = array();
				$niz3 = array();
				$sql1 = "SELECT * FROM tim WHERE id='$tim1'";
				$result1 = $conn->query($sql1);
				$row1 = $result1->fetch_assoc();
				$tim1id = (int)$row1['id'];
				$tim1naziv = $row1['naziv'];
				$tim1logo = $row1['logo'];
				$tim1stil = $row1['stil'];
				$tim1arena = $row1['arena_id'];
				$broj_odigranih_t1 = $row1['br_odigranih'];
				$pobede_t1 = $row1['pobede'];
				$porazi_t1 = $row1['porazi'];
				$br_bodova_t1 = $row1['br_bodova'];
				$kolicnik_t1 = $row1['kos_kolicnik'];
				$forma_t1 = $row1['forma'];
				$budzet_t1 = $row1['balance'];
				$sponzor_t1 = $row1['sponzor'];
				$pozicija_t1 = $row1['pozicija'];
				$result1->close();
				
				$sql3 = "SELECT * from arena WHERE id = '$tim1arena'";
				$result3 = $conn->query($sql3);
				$row3 = $result3->fetch_assoc();
				$sedista_t1 = $row3['seats'];
				$hrana_t1 = $row3['snacks'];
				$parking_t1 = $row3['parking'];
				$pice_t1 = $row3['drinks'];
				$cena_t1 = $row3['cena_karte'];
				$result3->close();
				//echo $cetvrtine;
				
				//resetovanje indeksa i poena igraca na pocetku utakmice
				if($flag_za_reset == 0)
				{
					$conn->query("UPDATE igrac SET indeks='0', broj_poena='0' WHERE tim_id='$tim1' OR tim_id='$tim2'");
				}
				
				$sql = "SELECT * FROM igrac WHERE tim_id='$tim1id'";
				$result2 = $conn->query($sql);
				if($result2)
				{
					while($row2 = $result2->fetch_assoc())
					{
						$igrac = new igrac($row2['id'],$row2['broj_na_dresu'],$row2['ime'],$row2['prezime'],
										   $row2['starost'],$row2['stamina'],$row2['moral'],$row2['visina'],
										   $row2['pozicija'],$row2['brzina'],$row2['agresivnost'],$row2['sut_za_2'],
										   $row2['sut_za_3'],$row2['sut_za_slobodna'],$row2['skok_u_napadu'],
										   $row2['asistencija'],$row2['dribling'],$row2['skok_u_odbrani'],
										   $row2['blokada'],$row2['presecen_pas'],$row2['ukradena_lopta'],$row2['aktivan'],
										   $row2['indeks'],$row2['broj_poena']);
						array_push($niz1, $igrac); 
						//echo $igrac->aktivan;
						if($igrac->aktivan)
						{
							array_push($niz2,$igrac);
						}
						else
						{
							array_push($niz3,$igrac);
						}
						//print ("<br>");
					}
				}
				$t1 = new tim($tim1id,$tim1naziv,$tim1stil,$tim1logo,$tim1arena,$niz1,$niz2,$niz3);
				//print ("<br>");
				$result2->close();
				//menjanje skilova igraca na osnovu taktike
				foreach ($t1->nizigraca as $igrac)
				{
					if ($t1->stil == "Offensive")
					{
						$igrac->sut_za_2 *= 1.025;
						$igrac->sut_za_3 *= 1.025;
						$igrac->sut_za_slobodna *= 1.025;
						$igrac->asistencija *= 1.025;
						$igrac->dribling *= 1.025;
						$igrac->skok_u_napadu *= 1.025;
						$igrac->agresivnost *= 0.975;
						$igrac->skok_u_odbrani *= 0.975;
						$igrac->blokada *= 0.975;
						$igrac->presecen_pas *= 0.975;
						$igrac->ukradena_lopta *= 0.975;
					}
					elseif ($t1->stil == "Defensive")
					{
						$igrac->sut_za_2 *= 0.975;
						$igrac->sut_za_3 *= 0.975;
						$igrac->sut_za_slobodna *= 0.975;
						$igrac->asistencija *= 0.975;
						$igrac->dribling *= 0.975;
						$igrac->skok_u_napadu *= 0.975;
						$igrac->agresivnost *= 1.025;
						$igrac->skok_u_odbrani *= 1.025;
						$igrac->blokada *= 1.025;
						$igrac->presecen_pas *= 1.025;
						$igrac->ukradena_lopta *= 1.025;
					}
					//u odnosu na moral
					if ($igrac->moral == 1)
					{
						$igrac->sut_za_2 *= 0.97;
						$igrac->sut_za_3 *= 0.97;
						$igrac->sut_za_slobodna *= 0.97;
						$igrac->asistencija *= 0.97;
						$igrac->dribling *= 0.97;
						$igrac->skok_u_napadu *= 0.97;
						$igrac->agresivnost *= 0.97;
						$igrac->skok_u_odbrani *= 0.97;
						$igrac->blokada *= 0.97;
						$igrac->presecen_pas *= 0.97;
						$igrac->ukradena_lopta *= 0.97;
					}
					elseif ($igrac->moral == 2)
					{
						$igrac->sut_za_2 *= 0.985;
						$igrac->sut_za_3 *= 0.985;
						$igrac->sut_za_slobodna *= 0.985;
						$igrac->asistencija *= 0.985;
						$igrac->dribling *= 0.985;
						$igrac->skok_u_napadu *= 0.985;
						$igrac->agresivnost *= 0.985;
						$igrac->skok_u_odbrani *= 0.985;
						$igrac->blokada *= 0.985;
						$igrac->presecen_pas *= 0.985;
						$igrac->ukradena_lopta *= 0.985;
					}
					elseif ($igrac->moral == 4)
					{
						$igrac->sut_za_2 *= 1.015;
						$igrac->sut_za_3 *= 1.015;
						$igrac->sut_za_slobodna *= 1.015;
						$igrac->asistencija *= 1.015;
						$igrac->dribling *= 1.015;
						$igrac->skok_u_napadu *= 1.015;
						$igrac->agresivnost *= 1.015;
						$igrac->skok_u_odbrani *= 1.015;
						$igrac->blokada *= 1.015;
						$igrac->presecen_pas *= 1.015;
						$igrac->ukradena_lopta *= 1.015;
					}
					elseif ($igrac->moral == 5)
					{
						$igrac->sut_za_2 *= 1.03;
						$igrac->sut_za_3 *= 1.03;
						$igrac->sut_za_slobodna *= 1.03;
						$igrac->asistencija *= 1.03;
						$igrac->dribling *= 1.03;
						$igrac->skok_u_napadu *= 1.03;
						$igrac->agresivnost *= 1.03;
						$igrac->skok_u_odbrani *= 1.03;
						$igrac->blokada *= 1.03;
						$igrac->presecen_pas *= 1.03;
						$igrac->ukradena_lopta *= 1.03;
					}
					//u odnosu na staminu
					if ($igrac->stamina < 30)
					{
						$igrac->sut_za_2 *= 0.8;
						$igrac->sut_za_3 *= 0.8;
						$igrac->sut_za_slobodna *= 0.8;
						$igrac->asistencija *= 0.8;
						$igrac->dribling *= 0.8;
						$igrac->skok_u_napadu *= 0.8;
						$igrac->agresivnost *= 0.8;
						$igrac->skok_u_odbrani *= 0.8;
						$igrac->blokada *= 0.8;
						$igrac->presecen_pas *= 0.8;
						$igrac->ukradena_lopta *= 0.8;
					}
					elseif ($igrac->stamina < 50)
					{
						$igrac->sut_za_2 *= 0.9;
						$igrac->sut_za_3 *= 0.9;
						$igrac->sut_za_slobodna *= 0.9;
						$igrac->asistencija *= 0.9;
						$igrac->dribling *= 0.9;
						$igrac->skok_u_napadu *= 0.9;
						$igrac->agresivnost *= 0.9;
						$igrac->skok_u_odbrani *= 0.9;
						$igrac->blokada *= 0.9;
						$igrac->presecen_pas *= 0.9;
						$igrac->ukradena_lopta *= 0.9;
					}
					elseif ($igrac->stamina < 70)
					{
						$igrac->sut_za_2 *= 0.985;
						$igrac->sut_za_3 *= 0.985;
						$igrac->sut_za_slobodna *= 0.985;
						$igrac->asistencija *= 0.985;
						$igrac->dribling *= 0.985;
						$igrac->skok_u_napadu *= 0.985;
						$igrac->agresivnost *= 0.985;
						$igrac->skok_u_odbrani *= 0.985;
						$igrac->blokada *= 0.985;
						$igrac->presecen_pas *= 0.985;
						$igrac->ukradena_lopta *= 0.985;
					}
				}
				
				$niz1 = array();
				$niz2 = array();
				$niz3 = array();
				$sql1 = "SELECT * FROM tim WHERE id='$tim2'";
				$result1 = $conn->query($sql1);
				$row1 = $result1->fetch_assoc();
				$tim2id = (int)$row1['id'];
				$tim2naziv = $row1['naziv'];
				$tim2logo = $row1['logo'];
				$tim2stil = $row1['stil'];
				$tim2arena = $row1['arena_id'];
				$broj_odigranih_t2 = $row1['br_odigranih'];
				$pobede_t2 = $row1['pobede'];
				$porazi_t2 = $row1['porazi'];
				$br_bodova_t2 = $row1['br_bodova'];
				$kolicnik_t2 = $row1['kos_kolicnik'];
				$forma_t2 = $row1['forma'];
				$budzet_t2 = $row1['balance'];
				$sponzor_t2 = $row1['sponzor'];
				$pozicija_t2 = $row1['pozicija'];
				$result1->close();
				
				$sql3 = "SELECT * from arena WHERE id = '$tim2arena'";
				$result3 = $conn->query($sql3);
				$row3 = $result3->fetch_assoc();
				$sedista_t2 = $row3['seats'];
				$hrana_t2 = $row3['snacks'];
				$parking_t2 = $row3['parking'];
				$pice_t2 = $row3['drinks'];
				$cena_t2 = $row3['cena_karte'];
				$result3->close();
				
				$sql = "SELECT * FROM igrac WHERE tim_id='$tim2id'";
				$result2 = $conn->query($sql);
				if($result2)
				{
					while($row2 = $result2->fetch_assoc())
					{
						$igrac = new igrac($row2['id'],$row2['broj_na_dresu'],$row2['ime'],$row2['prezime'],$row2['starost'],
										   $row2['stamina'],$row2['moral'],$row2['visina'],$row2['pozicija'],$row2['brzina'],
										   $row2['agresivnost'],$row2['sut_za_2'],$row2['sut_za_3'],$row2['sut_za_slobodna'],
										   $row2['skok_u_napadu'],$row2['asistencija'],$row2['dribling'],$row2['skok_u_odbrani'],
										   $row2['blokada'],$row2['presecen_pas'],$row2['ukradena_lopta'],$row2['aktivan'],
										   $row2['indeks'],$row2['broj_poena']);
						array_push($niz1, $igrac); 
						if($igrac->aktivan)
						{
							array_push($niz2,$igrac);
						}
						else
						{
							array_push($niz3,$igrac);
						}
						//print ("<br>");
					}
				}
				$t2 = new tim($tim2id,$tim2naziv,$tim2stil,$tim2logo,$tim2arena,$niz1,$niz2,$niz3);
				//print ("<br>");
				$result2->close();
				//igraj();
				//tim 2 na osnovu taktike
				foreach ($t2->nizigraca as $igrac)
				{
					if ($t2->stil == "Offensive")
					{
						$igrac->sut_za_2 *= 1.025;
						$igrac->sut_za_3 *= 1.025;
						$igrac->sut_za_slobodna *= 1.025;
						$igrac->asistencija *= 1.025;
						$igrac->dribling *= 1.025;
						$igrac->skok_u_napadu *= 1.025;
						$igrac->agresivnost *= 0.975;
						$igrac->skok_u_odbrani *= 0.975;
						$igrac->blokada *= 0.975;
						$igrac->presecen_pas *= 0.975;
						$igrac->ukradena_lopta *= 0.975;
					}
					elseif ($t2->stil == "Defensive")
					{
						$igrac->sut_za_2 *= 0.975;
						$igrac->sut_za_3 *= 0.975;
						$igrac->sut_za_slobodna *= 0.975;
						$igrac->asistencija *= 0.975;
						$igrac->dribling *= 0.975;
						$igrac->skok_u_napadu *= 0.975;
						$igrac->agresivnost *= 1.025;
						$igrac->skok_u_odbrani *= 1.025;
						$igrac->blokada *= 1.025;
						$igrac->presecen_pas *= 1.025;
						$igrac->ukradena_lopta *= 1.025;
					}
					//u odnosu na moral
					if ($igrac->moral == 1)
					{
						$igrac->sut_za_2 *= 0.97;
						$igrac->sut_za_3 *= 0.97;
						$igrac->sut_za_slobodna *= 0.97;
						$igrac->asistencija *= 0.97;
						$igrac->dribling *= 0.97;
						$igrac->skok_u_napadu *= 0.97;
						$igrac->agresivnost *= 0.97;
						$igrac->skok_u_odbrani *= 0.97;
						$igrac->blokada *= 0.97;
						$igrac->presecen_pas *= 0.97;
						$igrac->ukradena_lopta *= 0.97;
					}
					elseif ($igrac->moral == 2)
					{
						$igrac->sut_za_2 *= 0.985;
						$igrac->sut_za_3 *= 0.985;
						$igrac->sut_za_slobodna *= 0.985;
						$igrac->asistencija *= 0.985;
						$igrac->dribling *= 0.985;
						$igrac->skok_u_napadu *= 0.985;
						$igrac->agresivnost *= 0.985;
						$igrac->skok_u_odbrani *= 0.985;
						$igrac->blokada *= 0.985;
						$igrac->presecen_pas *= 0.985;
						$igrac->ukradena_lopta *= 0.985;
					}
					elseif ($igrac->moral == 4)
					{
						$igrac->sut_za_2 *= 1.015;
						$igrac->sut_za_3 *= 1.015;
						$igrac->sut_za_slobodna *= 1.015;
						$igrac->asistencija *= 1.015;
						$igrac->dribling *= 1.015;
						$igrac->skok_u_napadu *= 1.015;
						$igrac->agresivnost *= 1.015;
						$igrac->skok_u_odbrani *= 1.015;
						$igrac->blokada *= 1.015;
						$igrac->presecen_pas *= 1.015;
						$igrac->ukradena_lopta *= 1.015;
					}
					elseif ($igrac->moral == 5)
					{
						$igrac->sut_za_2 *= 1.03;
						$igrac->sut_za_3 *= 1.03;
						$igrac->sut_za_slobodna *= 1.03;
						$igrac->asistencija *= 1.03;
						$igrac->dribling *= 1.03;
						$igrac->skok_u_napadu *= 1.03;
						$igrac->agresivnost *= 1.03;
						$igrac->skok_u_odbrani *= 1.03;
						$igrac->blokada *= 1.03;
						$igrac->presecen_pas *= 1.03;
						$igrac->ukradena_lopta *= 1.03;
					}
					//u odnosu na staminu
					if ($igrac->stamina < 30)
					{
						$igrac->sut_za_2 *= 0.8;
						$igrac->sut_za_3 *= 0.8;
						$igrac->sut_za_slobodna *= 0.8;
						$igrac->asistencija *= 0.8;
						$igrac->dribling *= 0.8;
						$igrac->skok_u_napadu *= 0.8;
						$igrac->agresivnost *= 0.8;
						$igrac->skok_u_odbrani *= 0.8;
						$igrac->blokada *= 0.8;
						$igrac->presecen_pas *= 0.8;
						$igrac->ukradena_lopta *= 0.8;
					}
					elseif ($igrac->stamina < 50)
					{
						$igrac->sut_za_2 *= 0.9;
						$igrac->sut_za_3 *= 0.9;
						$igrac->sut_za_slobodna *= 0.9;
						$igrac->asistencija *= 0.9;
						$igrac->dribling *= 0.9;
						$igrac->skok_u_napadu *= 0.9;
						$igrac->agresivnost *= 0.9;
						$igrac->skok_u_odbrani *= 0.9;
						$igrac->blokada *= 0.9;
						$igrac->presecen_pas *= 0.9;
						$igrac->ukradena_lopta *= 0.9;
					}
					elseif ($igrac->stamina < 70)
					{
						$igrac->sut_za_2 *= 0.985;
						$igrac->sut_za_3 *= 0.985;
						$igrac->sut_za_slobodna *= 0.985;
						$igrac->asistencija *= 0.985;
						$igrac->dribling *= 0.985;
						$igrac->skok_u_napadu *= 0.985;
						$igrac->agresivnost *= 0.985;
						$igrac->skok_u_odbrani *= 0.985;
						$igrac->blokada *= 0.985;
						$igrac->presecen_pas *= 0.985;
						$igrac->ukradena_lopta *= 0.985;
					}
				}
			}
			/*else
			{
				echo "Ne";
				print ("<br>");
			}*/
			
		}
		//echo $cetvrtine;
	}

	$flag_za_reset++; //nakon prve iteracije nema vise resetovanja indeksa i poena igraca
	
	$napadtim = 0;
	$imaloptu = 0;
	$potez = 1;
	//echo $cetvrtine;
	novinapad();
//}
}

function faul($agresivnost)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	$procenat = mt_rand(0,99);
	if($agresivnost < 63)
	{
		if($procenat < 5)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	elseif($agresivnost < 73)
	{
		if($procenat < 10)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		if($procenat < 15)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

function faulZa3($agresivnost)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	$procenat = mt_rand(0,99);
	if($agresivnost < 63)
	{
		if($procenat < 2)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	elseif($agresivnost < 73)
	{
		if($procenat < 3)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		if($procenat < 4)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

function out($agresivnost, $asistencija)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	$procenat = mt_rand(0,99);
	$rezultat = $asistencija - $agresivnost;
	if($rezultat > 0)
	{
		if($procenat < 3)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		if($procenat < 5)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
}

function novinapad()
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez, $produzetak;
	//podesavanje stamine igraca
	//echo $t1->name;
	
	
	$rezultat = $conn->query("SELECT timeout_t1,timeout_t2 FROM utakmica WHERE id = '$id'");
	$row = $rezultat->fetch_assoc();
	$timeoutt1 = $row['timeout_t1'];
	$timeoutt2 = $row['timeout_t2'];
	$rezultat->close();
	if($timeoutt1)
	{
		$rezultat = $conn->query("SELECT btimeout_t1 FROM utakmica WHERE id = '$id'");
		$row = $rezultat->fetch_assoc();
		$brojtimeouta = (int)$row['btimeout_t1'];
		if($brojtimeouta == 0)
		{
			$poruka = "Timeout " . $t1->name . ".";
			sleep(2);
			$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
			$conn->query("UPDATE utakmica SET timeout_t1 = '0', btimeout_t1 = '1' WHERE id = '$id'");
			echo $poruka;
			timeout();
			//$brojtimeouta == 1;
			//$conn->query("UPDATE utakmica SET timeout_t1 = '0', btimeout_t1 = '1' WHERE id = '$id'");
		}
		$rezultat->close();
		
	}
	elseif($timeoutt2)
	{
		$rezultat = $conn->query("SELECT btimeout_t2 FROM utakmica WHERE id = '$id'");
		$row = $rezultat->fetch_assoc();
		$brojtimeouta = (int)$row['btimeout_t2'];
		if($brojtimeouta == 0)
		{
			$poruka = "Timeout " . $t2->name . ".";
			sleep(2);
			$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
			$conn->query("UPDATE utakmica SET timeout_t2 = '0', btimeout_t2 = '1' WHERE id = '$id'");
			echo $poruka;
			timeout();
			//$brojtimeouta == 1;
			//$conn->query("UPDATE utakmica SET timeout_t2 = '0', btimeout_t2 = '1' WHERE id = '$id'");
		}
		$rezultat->close();
	}
	
	foreach($t1->aktivni as $igrac)
	{
		//echo "DA";
		//echo $igrac->starost;
		if($igrac->starost < 26)
		{
			if($igrac->stamina > 15)
			{
				$igrac->stamina--;
			}
		}
		else
		{
			if($igrac->stamina > 15)
			{
				$igrac->stamina--;
				$igrac->stamina--;
			}			
		}
	}
	foreach($t2->aktivni as $igrac)
	{
		if($igrac->starost < 26)
		{
			if($igrac->stamina > 15)
			{
				$igrac->stamina--;
			}
		}
		else
		{
			if($igrac->stamina > 15)
			{
				$igrac->stamina--;
				$igrac->stamina--;
			}			
		}
	}
	foreach($t1->zamene as $igrac)
	{
		if($igrac->starost < 26)
		{
			if($igrac->stamina < 99)
			{
				$random = mt_rand(1,100);
				if($random > 51)
				{
					$igrac->stamina++;
					$igrac->stamina++;
				}
			}
			else
			{
				$igrac->stamina = 100;
			}
		}
		else
		{
			if($igrac->stamina < 100)
			{
				$random = mt_rand(1,100);
				if($random > 51)
				{
					$igrac->stamina++;
				}
			}			
		}
	}
	foreach($t2->zamene as $igrac)
	{
		if($igrac->starost < 26)
		{
			if($igrac->stamina < 99)
			{
				$random = mt_rand(1,100);
				if($random > 51)
				{
					$igrac->stamina++;
					$igrac->stamina++;
				}
			}
			else
			{
				$igrac->stamina = 100;
			}
		}
		else
		{
			if($igrac->stamina < 100)
			{
				$random = mt_rand(1,100);
				if($random > 51)
				{
					$igrac->stamina++;
				}
			}			
		}
	}
	foreach($t1->nizigraca as $igrac)
	{
		$idIg = $igrac->id;
		$s = $igrac->stamina;
		$i = $igrac->index;
		$p = $igrac->poeni;
		$conn->query("UPDATE igrac SET stamina = '$s', indeks = '$i', broj_poena = '$p' WHERE id = '$idIg'");
	}
	foreach($t2->nizigraca as $igrac)
	{
		$idIg = $igrac->id;
		$s = $igrac->stamina;
		$i = $igrac->index;
		$p = $igrac->poeni;
		$conn->query("UPDATE igrac SET stamina = '$s', indeks = '$i', broj_poena = '$p' WHERE id = '$idIg'");
	}
	///////////////// obavljanje prniudnih izmena
	foreach ($t1->aktivni as $igrac)
	{
		if ($igrac->stamina < 50)
		{
			array_push($t1->zamene, $igrac);
			$key = array_search($igrac, $t1->aktivni);
			unset($t1->aktivni[$key]);
			if ($igrac->aktivan == 1)
			{
				foreach ($t1->zamene as $igr)
				{
					if ($igr->pozicija == "PG" || $igr->pozicija == "G")
					{
						array_push($t1->aktivni, $igr);
						$key = array_search($igr, $t1->zamene);
						unset($t1->zamene[$key]);
						$igr->aktivan = 1;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '1' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			elseif ($igrac->aktivan == 2)
			{
				foreach ($t1->zamene as $igr)
				{
					if ($igr->pozicija == "PG" || $igr->pozicija == "G" || $igr->pozicija == "F")
					{
						array_push($t1->aktivni, $igr);
						$key = array_search($igr, $t1->zamene);
						unset($t1->zamene[$key]);
						$igr->aktivan = 2;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '2' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			elseif ($igrac->aktivan == 3)
			{
				foreach ($t1->zamene as $igr)
				{
					if ($igr->pozicija == "G" || $igr->pozicija == "F" || $igr->pozicija == "PF")
					{
						array_push($t1->aktivni, $igr);
						$key = array_search($igr, $t1->zamene);
						unset($t1->zamene[$key]);
						$igr->aktivan = 3;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '3' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			elseif ($igrac->aktivan == 4)
			{
				foreach ($t1->zamene as $igr)
				{
					if ($igr->pozicija == "F" || $igr->pozicija == "PF" || $igr->pozicija == "C")
					{
						array_push($t1->aktivni, $igr);
						$key = array_search($igr, $t1->zamene);
						unset($t1->zamene[$key]);
						$igr->aktivan = 4;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '4' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			else
			{
				foreach ($t1->zamene as $igr)
				{
					if ($igr->pozicija == "PF" || $igr->pozicija == "C")
					{
						array_push($t1->aktivni, $igr);
						$key = array_search($igr, $t1->zamene);
						unset($t1->zamene[$key]);
						$igr->aktivan = 5;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '5' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			$igrac->aktivan = null;
			$igrid = $igrac->id;
			$conn->query("UPDATE igrac SET aktivan = NULL WHERE id = '$igrid'");
		}
	}
	foreach ($t2->aktivni as $igrac)
	{
		if ($igrac->stamina < 50)
		{
			array_push($t2->zamene, $igrac);
			$key = array_search($igrac, $t2->aktivni);
			unset($t2->aktivni[$key]);
			if ($igrac->aktivan == 1)
			{
				foreach ($t2->zamene as $igr)
				{
					if ($igr->pozicija == "PG" || $igr->pozicija == "G")
					{
						array_push($t2->aktivni, $igr);
						$key = array_search($igr, $t2->zamene);
						unset($t2->zamene[$key]);
						$igr->aktivan = 1;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '1' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			elseif ($igrac->aktivan == 2)
			{
				foreach ($t2->zamene as $igr)
				{
					if ($igr->pozicija == "PG" || $igr->pozicija == "G" || $igr->pozicija == "F")
					{
						array_push($t2->aktivni, $igr);
						$key = array_search($igr, $t2->zamene);
						unset($t2->zamene[$key]);
						$igr->aktivan = 2;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '2' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			elseif ($igrac->aktivan == 3)
			{
				foreach ($t2->zamene as $igr)
				{
					if ($igr->pozicija == "G" || $igr->pozicija == "F" || $igr->pozicija == "PF")
					{
						array_push($t2->aktivni, $igr);
						$key = array_search($igr, $t2->zamene);
						unset($t2->zamene[$key]);
						$igr->aktivan = 3;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '3' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			elseif ($igrac->aktivan == 4)
			{
				foreach ($t2->zamene as $igr)
				{
					if ($igr->pozicija == "F" || $igr->pozicija == "PF" || $igr->pozicija == "C")
					{
						array_push($t2->aktivni, $igr);
						$key = array_search($igr, $t2->zamene);
						unset($t2->zamene[$key]);
						$igr->aktivan = 4;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '4' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			else
			{
				foreach ($t2->zamene as $igr)
				{
					if ($igr->pozicija == "PF" || $igr->pozicija == "C")
					{
						array_push($t2->aktivni, $igr);
						$key = array_search($igr, $t2->zamene);
						unset($t2->zamene[$key]);
						$igr->aktivan = 5;
						$igrid1 = $igr->id;
						$conn->query("UPDATE igrac SET aktivan = '5' WHERE id = '$igrid1'");
						break;
					}
				}
			}
			$igrac->aktivan = null;
			$igrid = $igrac->id;
			$conn->query("UPDATE igrac SET aktivan = NULL WHERE id = '$igrid'");
		}
	}
	///////////////////////
	if(($ukupnoVreme < 150 && !$produzetak) || ($ukupnoVreme < 76 && $produzetak))
	{
		if($ukupnoVreme == 142)
		{
			$potez = 2;
			if($napadtim == 1)
			{
				$napadtim = 2;
				foreach($t2->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
			else
			{
				$napadtim = 1;
				foreach($t1->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
		}
		elseif($ukupnoVreme == 144)
		{
			$potez = 3;
			if($napadtim == 1)
			{
				$napadtim = 2;
				foreach($t2->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
			else
			{
				$napadtim = 1;
				foreach($t1->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
		}
		elseif($ukupnoVreme == 146)
		{
			$potez = 4;
			if($napadtim == 1)
			{
				$napadtim = 2;
				foreach($t2->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
			else
			{
				$napadtim = 1;
				foreach($t1->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
		}
		elseif($ukupnoVreme == 148)
		{
			$potez = 5;
			if($napadtim == 1)
			{
				$napadtim = 2;
				foreach($t2->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
			else
			{
				$napadtim = 1;
				foreach($t1->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
		}
		else
		{
			$potez = 1;
			if($napadtim == 1)
			{
				$napadtim = 2;
				foreach($t2->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
			else
			{
				$napadtim = 1;
				foreach($t1->aktivni as $igrac)
				{
					if($igrac->aktivan == 1)
					{
						$imaloptu = $igrac->id;
						igrac_ima_loptu($igrac);
						break;
					}
				}
			}
		}
	}
	elseif($produzetak && $ukupnoVreme >= 76)
	{
		if ($poenit1 > $poenit2)
		{
			$n = $t1->name;
			$poruka = "End of match! Winner is $n!";
			$conn->query("UPDATE utakmica SET poruka='$poruka' WHERE id='$id'");
			echo $poruka;
			krajUtakmice();
		}
		elseif ($poenit2 > $poenit1)
		{
			$n = $t2->name;
			$poruka = "End of match! Winner is $n!";
			$conn->query("UPDATE utakmica SET poruka='$poruka' WHERE id='$id'");
			echo $poruka;
			krajUtakmice();
		}
		else
		{
			$poruka = "There will be an overtime!";
			$conn->query("UPDATE utakmica SET poruka='$poruka' WHERE id='$id'");
			echo $poruka;
			utakmica();
		}
	}
	else
	{	
		if($cetvrtine < 4)
		{
			if($cetvrtine == 1)
			{
				sleep(2);
				$poruka = "End of 1st quarter.";
				$conn->query("UPDATE utakmica SET poruka='$poruka' WHERE id='$id'");
				echo $poruka;
			}
			elseif($cetvrtine == 2)
			{
				sleep(2);
				$poruka = "Half time!";
				$conn->query("UPDATE utakmica SET poruka='$poruka' WHERE id='$id'");
				echo $poruka;
			}
			elseif($cetvrtine == 3)
			{
				sleep(2);
				$poruka = "End of 3rd quarter.";
				$conn->query("UPDATE utakmica SET poruka='$poruka' WHERE id='$id'");
				echo $poruka;
			}
			$cetvrtine++;
			krajCetvrtine();
		}
		else
		{
			if ($poenit1 > $poenit2)
			{
				sleep(2);
				$n = $t1->name;
				$poruka = "End of match! Winner is $n!";
				$conn->query("UPDATE utakmica SET poruka='$poruka' WHERE id='$id'");
				echo $poruka;
				krajUtakmice();
			}
			elseif ($poenit2 > $poenit1)
			{
				sleep(2);
				$n = $t2->name;
				$poruka = "End of match! Winner is $n!";
				$conn->query("UPDATE utakmica SET poruka='$poruka' WHERE id='$id'");
				echo $poruka;
				krajUtakmice();
			}
			else
			{
				sleep(2);
				$poruka = "There will be an overtime!";
				$conn->query("UPDATE utakmica SET poruka='$poruka' WHERE id='$id'");
				echo $poruka;
				$produzetak = true;
				$conn->query("UPDATE utakmica SET minuti = '5', sekunde = '0' WHERE id='$id'");
				utakmica();
			}
		}
	}
}

function krajCetvrtine()
{	
	global $conn, $id, $cetvrtine, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez, $cetvr;
	$cetvr++;
	foreach($t1->nizigraca as $igrac)
	{
		$idIg = $igrac->id;
		$s = $igrac->stamina;
		$i = $igrac->index;
		$p = $igrac->poeni;
		$conn->query("UPDATE igrac SET stamina = '$s', indeks = '$i', broj_poena = '$p' WHERE id = '$idIg'");
	}
	foreach($t2->nizigraca as $igrac)
	{
		$idIg = $igrac->id;
		$s = $igrac->stamina;
		$i = $igrac->index;
		$p = $igrac->poeni;
		$conn->query("UPDATE igrac SET stamina = '$s', indeks = '$i', broj_poena = '$p' WHERE id = '$idIg'");
	}
	$conn->query("UPDATE utakmica SET minuti = '10', sekunde = '0', cetvrtina = '$cetvr' WHERE id = '$id'");
	$conn->query("UPDATE utakmica SET timeout_t1 = '0', timeout_t2 = '0', btimeout_t1 = '0', btimeout_t2 = '0' WHERE id='$id'");
	sleep(30);
	utakmica();
}

function timeout()
{
	global $conn, $id, $cetvrtine, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	foreach($t1->nizigraca as $igrac)
	{
		$idIg = $igrac->id;
		$s = $igrac->stamina;
		$i = $igrac->index;
		$p = $igrac->poeni;
		$conn->query("UPDATE igrac SET stamina = '$s', indeks = '$i', broj_poena = '$p' WHERE id = '$idIg'");
	}
	foreach($t2->nizigraca as $igrac)
	{
		$idIg = $igrac->id;
		$s = $igrac->stamina;
		$i = $igrac->index;
		$p = $igrac->poeni;
		$conn->query("UPDATE igrac SET stamina = '$s', indeks = '$i', broj_poena = '$p' WHERE id = '$idIg'");
	}
	sleep(60);
	$niz1 = array();
	$niz2 = array();
	$niz3 = array();
	$sql1 = "SELECT * FROM tim WHERE id='$tim1id'";
	$result1 = $conn->query($sql1);
	$row1 = $result1->fetch_assoc();
	$tim1id = (int)$row1['id'];
	$tim1naziv = $row1['naziv'];
	$tim1logo = $row1['logo'];
	$tim1stil = $row1['stil'];
	$tim1arena = $row1['arena_id'];
	$broj_odigranih_t1 = $row1['br_odigranih'];
	$pobede_t1 = $row1['pobede'];
	$porazi_t1 = $row1['porazi'];
	$br_bodova_t1 = $row1['br_bodova'];
	$kolicnik_t1 = $row1['kos_kolicnik'];
	$forma_t1 = $row1['forma'];
	$budzet_t1 = $row1['balance'];
	$sponzor_t1 = $row1['sponzor'];
	$pozicija_t1 = $row1['pozicija'];
	$result1->close();
	
	$sql3 = "SELECT * from arena WHERE id = '$tim1arena'";
	$result3 = $conn->query($sql3);
	$row3 = $result3->fetch_assoc();
	$sedista_t1 = $row3['seats'];
	$hrana_t1 = $row3['snacks'];
	$parking_t1 = $row3['parking'];
	$pice_t1 = $row3['drinks'];
	$cena_t1 = $row3['cena_karte'];
	$result3->close();
	//echo $cetvrtine;
	
	//resetovanje indeksa i poena igraca na pocetku utakmice
	if($flag_za_reset == 0)
	{
		$conn->query("UPDATE igrac SET indeks='0', broj_poena='0' WHERE tim_id='$tim1id' OR tim_id='$tim2id'");
	}
	
	$sql = "SELECT * FROM igrac WHERE tim_id='$tim1id'";
	$result2 = $conn->query($sql);
	if($result2)
	{
		while($row2 = $result2->fetch_assoc())
		{
			$igrac = new igrac($row2['id'],$row2['broj_na_dresu'],$row2['ime'],$row2['prezime'],
							   $row2['starost'],$row2['stamina'],$row2['moral'],$row2['visina'],
							   $row2['pozicija'],$row2['brzina'],$row2['agresivnost'],$row2['sut_za_2'],
							   $row2['sut_za_3'],$row2['sut_za_slobodna'],$row2['skok_u_napadu'],
							   $row2['asistencija'],$row2['dribling'],$row2['skok_u_odbrani'],
							   $row2['blokada'],$row2['presecen_pas'],$row2['ukradena_lopta'],$row2['aktivan'],
							   $row2['indeks'],$row2['broj_poena']);
			array_push($niz1, $igrac); 
			//echo $igrac->aktivan;
			if($igrac->aktivan)
			{
				array_push($niz2,$igrac);
			}
			else
			{
				array_push($niz3,$igrac);
			}
			//print ("<br>");
		}
	}
	$t1 = new tim($tim1id,$tim1naziv,$tim1stil,$tim1logo,$tim1arena,$niz1,$niz2,$niz3);
	//print ("<br>");
	$result2->close();
	
	$niz1 = array();
	$niz2 = array();
	$niz3 = array();
	$sql1 = "SELECT * FROM tim WHERE id='$tim2id'";
	$result1 = $conn->query($sql1);
	$row1 = $result1->fetch_assoc();
	$tim2id = (int)$row1['id'];
	$tim2naziv = $row1['naziv'];
	$tim2logo = $row1['logo'];
	$tim2stil = $row1['stil'];
	$tim2arena = $row1['arena_id'];
	$broj_odigranih_t2 = $row1['br_odigranih'];
	$pobede_t2 = $row1['pobede'];
	$porazi_t2 = $row1['porazi'];
	$br_bodova_t2 = $row1['br_bodova'];
	$kolicnik_t2 = $row1['kos_kolicnik'];
	$forma_t2 = $row1['forma'];
	$budzet_t2 = $row1['balance'];
	$sponzor_t2 = $row1['sponzor'];
	$pozicija_t2 = $row1['pozicija'];
	$result1->close();
	
	$sql3 = "SELECT * from arena WHERE id = '$tim2arena'";
	$result3 = $conn->query($sql3);
	$row3 = $result3->fetch_assoc();
	$sedista_t2 = $row3['seats'];
	$hrana_t2 = $row3['snacks'];
	$parking_t2 = $row3['parking'];
	$pice_t2 = $row3['drinks'];
	$cena_t2 = $row3['cena_karte'];
	$result3->close();
	
	$sql = "SELECT * FROM igrac WHERE tim_id='$tim2id'";
	$result2 = $conn->query($sql);
	if($result2)
	{
		while($row2 = $result2->fetch_assoc())
		{
			$igrac = new igrac($row2['id'],$row2['broj_na_dresu'],$row2['ime'],$row2['prezime'],$row2['starost'],
							   $row2['stamina'],$row2['moral'],$row2['visina'],$row2['pozicija'],$row2['brzina'],
							   $row2['agresivnost'],$row2['sut_za_2'],$row2['sut_za_3'],$row2['sut_za_slobodna'],
							   $row2['skok_u_napadu'],$row2['asistencija'],$row2['dribling'],$row2['skok_u_odbrani'],
							   $row2['blokada'],$row2['presecen_pas'],$row2['ukradena_lopta'],$row2['aktivan'],
							   $row2['indeks'],$row2['broj_poena']);
			array_push($niz1, $igrac); 
			if($igrac->aktivan)
			{
				array_push($niz2,$igrac);
			}
			else
			{
				array_push($niz3,$igrac);
			}
			//print ("<br>");
		}
	}
	$t2 = new tim($tim2id,$tim2naziv,$tim2stil,$tim2logo,$tim2arena,$niz1,$niz2,$niz3);
	//print ("<br>");
	$result2->close();
}

function getGlobalId()
{
	global $id;
	return $id;
}

function krajUtakmice()
{
	global $conn, $cetvrtine, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	$idUtk = getGlobalId();
	$conn->query("UPDATE utakmica SET poeni_prvog_tima = '$poenit1', poeni_drugog_tima = '$poenit2', status='F' WHERE id = '$idUtk'");
	foreach($t1->nizigraca as $igrac)
	{
		$mor = $igrac->moral;
		$iddd = $igrac->id;
		$conn->query("UPDATE igrac SET moral = '$mor' WHERE id = '$iddd'");
	}
	foreach($t2->nizigraca as $igrac)
	{
		$mor = $igrac->moral;
		$iddd = $igrac->id;
		$conn->query("UPDATE igrac SET moral = '$mor' WHERE id = '$iddd'");
	}
	//******************************************************************************************
	$resultatkraj = $conn->query("SELECT tr_kolo, br_odigranih_meceva_u_kolu FROM liga WHERE id = '1'");
	$rowkraj = $resultatkraj->fetch_assoc();
	$kolo = $rowkraj['tr_kolo'];	
	$bomk = $rowkraj['br_odigranih_meceva_u_kolu'];
	$bomk++;
	if($bomk < 5)
	{
		$conn->query("UPDATE liga SET br_odigranih_meceva_u_kolu = '$bomk' WHERE id = '1'");
	}
	else
	{
		$kolo++;
		$conn->query("UPDATE liga SET br_odigranih_meceva_u_kolu = '0', tr_kolo = '$kolo' WHERE id = '1'");
	}
	if($poenit1 > $poenit2)
	{
		//za tim1
		$avgIndex1 = 0;
		$resCnt1 = $conn->query("SELECT COUNT(*) as brIgraca FROM igrac WHERE tim_id = '$tim1id'");
		$rCnt1 = $resCnt1->fetch_assoc();
		$brIgraca1 = $rCnt1['brIgraca'];
		$resCnt1->close();
		$resIgr1 = $conn->query("SELECT indeks FROM igrac where tim_id = '$tim1id'");
		while($rIgr1 = $resIgr1->fetch_assoc())
		{
			$avgIndex1 += $rIgr1['indeks'];
		}
		$avgIndex1 /= $brIgraca1;
		$resIgr1->close();
		//za sve igrace 1. tima povecavanje next_level-a
		$resIgr1 = $conn->query("SELECT * FROM igrac where tim_id = '$tim1id'");
		while($rIgr1 = $resIgr1->fetch_assoc())
		{
			$mrl = $rIgr1['moral'];
			$nl = $rIgr1['next_level'];
			$st = $rIgr1['stamina'];
			$id = $rIgr1['id'];
			$poz = $rIgr1['pozicija'];
			if($rIgr1['indeks'] > $avgIndex1)
			{
				if($mrl < 5)
				{
					$mrl++;
					$conn->query("UPDATE igrac SET moral = '$mrl' WHERE id = '$id'");
				}
			}
			if($rIgr1['starost'] < 23)
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 90;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 50;
				}
				if($st > 20)
				{
					$st -= 20;
				}
				else
				{
					$st = 0;
				}
			}
			elseif($rIgr1['starost'] < 29)
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 60;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 20;
				}
				if($st > 25)
				{
					$st -= 25;
				}
				else
				{
					$st = 0;
				}
			}
			else
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 30;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 5;
				}
				if($st > 30)
				{
					$st -= 30;
				}
				else
				{
					$st = 0;
				}
			}
			$nl += 10;
			
			$sqlSt = "UPDATE igrac SET stamina = '$st' WHERE id = '$id'";
			$resultSt = $conn->query($sqlSt);
			if ($nl >= 100)
			{					
				$nl = $nl - 100;
				$sql = "UPDATE igrac SET next_level = '$nl' WHERE id = '$id'";
				$result = $conn->query($sql);

				$tmp;
				$r = rand(1,100);
				switch($poz)
				{
					case 'PG':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'G':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'F':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'PF':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					default:
					{
							switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
					}
				}
			}
			else
			{
				$sql = "UPDATE igrac SET next_level = '$nl' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
		}
		//za tim2
		$avgIndex1 = 0;
		$resCnt1 = $conn->query("SELECT COUNT(*) as brIgraca FROM igrac WHERE tim_id = '$tim2id'");
		$rCnt1 = $resCnt1->fetch_assoc();
		$brIgraca1 = $rCnt1['brIgraca'];
		$resCnt1->close();
		$resIgr1 = $conn->query("SELECT indeks FROM igrac where tim_id = '$tim2id'");
		while($rIgr1 = $resIgr1->fetch_assoc())
		{
			$avgIndex1 += $rIgr1['indeks'];
		}
		$avgIndex1 /= $brIgraca1;
		$resIgr1->close();
		//za sve igrace 2. tima povecavanje next_level-a
		$resIgr1 = $conn->query("SELECT * FROM igrac where tim_id = '$tim2id'");
		while($rIgr1 = $resIgr1->fetch_assoc())
		{
			$nl = $rIgr1['next_level'];
			$st = $rIgr1['stamina'];
			$id = $rIgr1['id'];
			$poz = $rIgr1['pozicija'];
			$mrl = $rIgr1['moral'];
			if($rIgr1['indeks'] < $avgIndex1)
			{
				if($mrl > 1)
				{
					$mrl--;
					$conn->query("UPDATE igrac SET moral = '$mrl' WHERE id = '$id'");
				}
			}
			if($rIgr1['starost'] < 23)
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 90;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 50;
				}
				if($st > 20)
				{
					$st -= 20;
				}
				else
				{
					$st = 0;
				}
			}
			elseif($rIgr1['starost'] < 29)
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 60;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 20;
				}
				if($st > 25)
				{
					$st -= 25;
				}
				else
				{
					$st = 0;
				}
			}
			else
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 30;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 5;
				}
				if($st > 30)
				{
					$st -= 30;
				}
				else
				{
					$st = 0;
				}
			}
			$sqlSt = "UPDATE igrac SET stamina = '$st' WHERE id = '$id'";
			$resultSt = $conn->query($sqlSt);
			if ($nl >= 100)
			{					
				$nl = $nl - 100;
				$sql = "UPDATE igrac SET next_level = '$nl' WHERE id = '$id'";
				$result = $conn->query($sql);

				$tmp;
				$r = rand(1,100);
				switch($poz)
				{
					case 'PG':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'G':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'F':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'PF':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					default:
					{
							switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
					}
				}
			}
			else
			{
				$sql = "UPDATE igrac SET next_level = '$nl' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
		}
		
		//ostalo
		$pobede_t1++;
		$br_bodova_t1 += 2;
		$kolicnik_t1 += $poenit1 - $poenit2;
		$broj_odigranih_t1++;
		$broj_odigranih_t2++;
		$porazi_t2++;
		$br_bodova_t2 += 1;
		$kolicnik_t2 -= $poenit1 - $poenit2;
		//echo $pobede_t1;
		//echo $porazi_t2;
		//echo $forma_t1;
		//echo $forma_t2;
		if($broj_odigranih_t1 < 5)
		{
			$forma_t1 .= "W";
			$forma_t2 .= "L";
		}
		else
		{
			$forma_t1 = substr($forma_t1, 1);
			$forma_t1 .= "W";
			$forma_t2 = substr($forma_t2, 1);
			$forma_t2 .= "L";
		}
		if($sponzor_t1 == "Puma")
		{
			$budzet_t1 += 140;
		}
		elseif($sponzor_t1 == "Adidas")
		{
			$budzet_t1 += 100;
		}
		if($sponzor_t2 == "Puma")
		{
			$budzet_t2 += 140;
		}
		// treba da se napravi proracun koliko ce ljudi da prisustvuje utakmici na osnovu forme i cene ulaznica
		$budzet_t1 += $cena_t1 * $sedista_t1 + $hrana_t1 + $pice_t1 + $parking_t1;
		/*$sql5 = "SELECT COUNT(*) as br_timova FROM tim";
		$result5 = $conn->query($sql5);
		$row5 = $result5->fetch_assoc();
		$br_timova = $row5['br_timova'];
		for(var $i = 1; $i <= $br_timova; $i++)
		{*/
		$conn->query("UPDATE tim SET br_odigranih = '$broj_odigranih_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET pobede = '$pobede_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET porazi = '$porazi_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET kos_kolicnik = '$kolicnik_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET br_bodova = '$br_bodova_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET forma = '$forma_t1'  WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET balance = '$budzet_t1'  WHERE id = '$tim1id'");
		
		$conn->query("UPDATE tim SET br_odigranih = '$broj_odigranih_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET pobede = '$pobede_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET porazi = '$porazi_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET kos_kolicnik = '$kolicnik_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET br_bodova = '$br_bodova_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET forma = '$forma_t2'  WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET balance = '$budzet_t2'  WHERE id = '$tim2id'");
		$res = $conn->query("SELECT * FROM tim ORDER BY pozicija DESC");
		while ($r = $res->fetch_assoc())
		{		
			$tId = $r['id'];
			$sql1 = "SELECT pozicija, br_bodova, kos_kolicnik FROM tim WHERE id = '$tId'";
			$result1 = $conn->query($sql1);
			$row1 = $result1->fetch_assoc();
			$poz = $row1['pozicija'];
			$bb = $row1['br_bodova'];
			$kk = $row1['kos_kolicnik'];
			if($pozicija_t1 > $poz)
			{
				if($br_bodova_t1 > $bb || ($br_bodova_t1 == $bb && $kolicnik_t1 > $kk))
				{
					$pom = $poz;
					$poz = $pozicija_t1;
					$pozicija_t1 = $pom;
					$conn->query("UPDATE tim SET pozicija = '$poz' WHERE id = '$tId'");
					$conn->query("UPDATE tim SET pozicija = '$pozicija_t1' WHERE id = '$tim1id'");
				}
			}
			if($pozicija_t2 > $poz)
			{
				if($br_bodova_t2 > $bb || ($br_bodova_t2 == $bb && $kolicnik_t2 > $kk))
				{
					$pom = $poz;
					$poz = $pozicija_t2;
					$pozicija_t2 = $pom;
					$conn->query("UPDATE tim SET pozicija = '$poz' WHERE id = '$tId'");
					$conn->query("UPDATE tim SET pozicija = '$pozicija_t2' WHERE id = '$tim2id'");
				}
			}
		}
		//}
	}
	else
	{
		//za tim2id
		$avgIndex1 = 0;
		$resCnt1 = $conn->query("SELECT COUNT(*) as brIgraca FROM igrac WHERE id = '$tim2id'");
		$rCnt1 = $resCnt1->fetch_assoc();
		$brIgraca1 = $rCnt1['brIgraca'];
		$resCnt1->close();
		$resIgr1 = $conn->query("SELECT indeks FROM igrac where tim_id = '$tim2id'");
		while($rIgr1 = $resIgr1->fetch_assoc())
		{
			$avgIndex1 += $rIgr1['indeks'];
		}
		$avgIndex1 /= $brIgraca1;
		$resIgr1->close();
		//za sve igrace 2. tima povecavanje next_level-a
		$resIgr1 = $conn->query("SELECT * FROM igrac where tim_id = '$tim2id'");
		while($rIgr1 = $resIgr1->fetch_assoc())
		{
			$nl = $rIgr1['next_level'];
			$st = $rIgr1['stamina'];
			$id = $rIgr1['id'];
			$poz = $rIgr1['pozicija'];
			$mrl = $rIgr1['moral'];
			if($rIgr1['indeks'] > $avgIndex1)
			{
				if($mrl < 5)
				{
					$mrl++;
					$conn->query("UPDATE igrac SET moral = '$mrl' WHERE id = '$id'");
				}
			}
			if($rIgr1['starost'] < 23)
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 90;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 50;
				}
				if($st > 20)
				{
					$st -= 20;
				}
				else
				{
					$st = 0;
				}
			}
			elseif($rIgr1['starost'] < 29)
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 60;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 20;
				}
				if($st > 25)
				{
					$st -= 25;
				}
				else
				{
					$st = 0;
				}
			}
			else
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 30;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 5;
				}
				if($st > 30)
				{
					$st -= 30;
				}
				else
				{
					$st = 0;
				}
			}
			$nl += 10;
			
			$sqlSt = "UPDATE igrac SET stamina = '$st' WHERE id = '$id'";
			$resultSt = $conn->query($sqlSt);
			if ($nl >= 100)
			{					
				$nl = $nl - 100;
				$sql = "UPDATE igrac SET next_level = '$nl' WHERE id = '$id'";
				$result = $conn->query($sql);

				$tmp;
				$r = rand(1,100);
				switch($poz)
				{
					case 'PG':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'G':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'F':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'PF':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					default:
					{
							switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
					}
				}
			}
			else
			{
				$sql = "UPDATE igrac SET next_level = '$nl' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
		}
		//za tim1id
		$avgIndex1 = 0;
		$resCnt1 = $conn->query("SELECT COUNT(*) as brIgraca FROM igrac WHERE id = '$tim1id'");
		$rCnt1 = $resCnt1->fetch_assoc();
		$brIgraca1 = $rCnt1['brIgraca'];
		$resCnt1->close();
		$resIgr1 = $conn->query("SELECT indeks FROM igrac where tim_id = '$tim1id'");
		while($rIgr1 = $resIgr1->fetch_assoc())
		{
			$avgIndex1 += $rIgr1['indeks'];
		}
		$avgIndex1 /= $brIgraca1;
		$resIgr1->close();
		//za sve igrace 1. tima povecavanje next_level-a
		$resIgr1 = $conn->query("SELECT * FROM igrac where tim_id = '$tim1id'");
		while($rIgr1 = $resIgr1->fetch_assoc())
		{
			$nl = $rIgr1['next_level'];
			$st = $rIgr1['stamina'];
			$id = $rIgr1['id'];
			$poz = $rIgr1['pozicija'];
			$mrl = $rIgr1['moral'];
			if($rIgr1['indeks'] < $avgIndex1)
			{
				if($mrl > 1)
				{
					$mrl--;
					$conn->query("UPDATE igrac SET moral = '$mrl' WHERE id = '$id'");
				}
			}
			if($rIgr1['starost'] < 23)
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 90;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 50;
				}
				if($st > 20)
				{
					$st -= 20;
				}
				else
				{
					$st = 0;
				}
			}
			elseif($rIgr1['starost'] < 29)
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 60;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 20;
				}
				if($st > 25)
				{
					$st -= 25;
				}
				else
				{
					$st = 0;
				}
			}
			else
			{
				if($rIgr1['indeks'] > $avgIndex1)
				{
					$nl =+ 30;
				}
				elseif($rIgr1['indeks'] > 0)
				{
					$nl =+ 5;
				}
				if($st > 30)
				{
					$st -= 30;
				}
				else
				{
					$st = 0;
				}
			}
			$sqlSt = "UPDATE igrac SET stamina = '$st' WHERE id = '$id'";
			$resultSt = $conn->query($sqlSt);
			if ($nl >= 100)
			{					
				$nl = $nl - 100;
				$sql = "UPDATE igrac SET next_level = '$nl' WHERE id = '$id'";
				$result = $conn->query($sql);

				$tmp;
				$r = rand(1,100);
				switch($poz)
				{
					case 'PG':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'G':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'F':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					case 'PF':
					{
						switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
						break;
					}
					default:
					{
							switch(true)
						{
							case $r <= 15:
							{
								$tmp = $rIgr1['skok_u_odbrani'] + 1;
								$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 30:
							{
								$tmp = $rIgr1['skok_u_napadu'] + 1;
								$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 45:
							{
								$tmp = $rIgr1['sut_za_2'] + 1;
								$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 60:
							{
								$tmp = $rIgr1['blokada'] + 1;
								$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 65:
							{
								$tmp = $rIgr1['sut_za_3'] + 1;
								$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 70:
							{
								$tmp = $rIgr1['ukradena_lopta'] + 1;
								$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 75:
							{
								$tmp = $rIgr1['presecen_pas'] + 1;
								$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 80:
							{
								$tmp = $rIgr1['dribling'] + 1;
								$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 85:
							{
								$tmp = $rIgr1['agresivnost'] + 1;
								$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 90:
							{
								$tmp = $rIgr1['brzina'] + 1;
								$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							case $r <= 95:
							{
								$tmp = $rIgr1['asistencija'] + 1;
								$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
								break;
							}
							default:
							{
								$tmp = $rIgr1['sut_za_slobodna'] + 1;
								$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
								$result = $conn->query($sql);
							}
						}
					}
				}
			}
			else
			{
				$sql = "UPDATE igrac SET next_level = '$nl' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
		}
		
		//ostalo
		$pobede_t2++;
		$br_bodova_t2 += 2;
		$kolicnik_t2 += $poenit2 - $poenit1;
		$broj_odigranih_t2++;
		$broj_odigranih_t1++;
		$porazi_t1++;
		$br_bodova_t1 += 1;
		$kolicnik_t1 -= $poenit2 - $poenit1;
		if($broj_odigranih_t1 <5)
		{
			$forma_t2 .= "W";
			$forma_t1 .= "L";
		}
		else
		{
			$forma_t2 = substr($forma_t1, 1);
			$forma_t2 .= "W";
			$forma_t1 = substr($forma_t2, 1);
			$forma_t1 .= "L";
		}
		if($sponzor_t2 == "Puma")
		{
			$budzet_t2 += 140;
		}
		elseif($sponzor_t2 == "Adidas")
		{
			$budzet_t2 += 100;
		}
		if($sponzor_t1 == "Puma")
		{
			$budzet_t1 += 140;
		}
		$budzet_t2 += $cena_t2 * $sedista_t2 + $hrana_t2 + $pice_t2 + $parking_t2;
		/*$sql5 = "SELECT COUNT(*) as br_timova FROM tim";
		$result5 = $conn->query($sql5);
		$row5 = $result1->fetch_assoc();
		$br_timova = $row5['br_timova'];
		for(var $i = 1; $i <= $br_timova ; $i++)
		{*/
		$conn->query("UPDATE tim SET br_odigranih = '$broj_odigranih_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET pobede = '$pobede_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET porazi = '$porazi_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET kos_kolicnik = '$kolicnik_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET br_bodova = '$br_bodova_t1' WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET forma = '$forma_t1'  WHERE id = '$tim1id'");
		$conn->query("UPDATE tim SET balance = '$budzet_t1'  WHERE id = '$tim1id'");
		
		$conn->query("UPDATE tim SET br_odigranih = '$broj_odigranih_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET pobede = '$pobede_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET porazi = '$porazi_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET kos_kolicnik = '$kolicnik_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET br_bodova = '$br_bodova_t2' WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET forma = '$forma_t2'  WHERE id = '$tim2id'");
		$conn->query("UPDATE tim SET balance = '$budzet_t2'  WHERE id = '$tim2id'");
		$res = $conn->query("SELECT * FROM tim");
		while ($r = $res->fetch_assoc())
		{		
			$tId = $r['id'];
			$sql1 = "SELECT * FROM tim WHERE id = '$tId'";
			$result1 = $conn->query($sql1);
			$row1 = $result1->fetch_assoc();
			$poz = $row1['pozicija'];
			$bb = $row1['br_bodova'];
			$kk = $row1['kos_kolicnik'];
			if($pozicija_t2 > $poz)
			{
				if($br_bodova_t2 > $bb || ($br_bodova_t2 == $bb && $kolicnik_t2 > $kk))
				{
					$pom = $poz;
					$poz = $pozicija_t2;
					$pozicija_t2 = $pom;
					$conn->query("UPDATE tim SET pozicija = '$poz' WHERE id = '$tId'");
					$conn->query("UPDATE tim SET pozicija = '$pozicija_t2' WHERE id = '$tim2id'");
				}
			}
			if($pozicija_t1 > $poz)
			{
				if($br_bodova_t1 > $bb || ($br_bodova_t1 == $bb && $kolicnik_t1 > $kk))
				{
					$pom = $poz;
					$poz = $pozicija_t1;
					$pozicija_t1 = $pom;
					$conn->query("UPDATE tim SET pozicija = '$poz' WHERE id = '$tId'");
					$conn->query("UPDATE tim SET pozicija = '$pozicija_t1' WHERE id = '$tim1id'");
				}
			}
		}
		//}
	}
	//exit();
}

function igrac_ima_loptu($igrac)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez, $min, $sec;
	if($ukupnoVreme == 150)
	{
		novinapad();
	}
	else
	{
		$ssut = 0;
		$spas = 0;
		$sdrzi = 0;
		$procenat = mt_rand(0,99);
		if($igrac->pozicija == "PG")
		{
			if($potez == 1)
			{   
				$ssut = 10;
				$spas = 60;
				$sdrzi = 30;
				if($procenat <10)
				{
					sut($igrac);
				}
				elseif($procenat<40)
				{
					drzi($igrac);
				}
				else
				{
					pas($igrac);
				}
			}
			elseif($potez == 2)
			{
				
				$ssut = 20;
				$spas = 55;
				$sdrzi = 25;
				if($procenat <20)
				{
					sut($igrac);
				}
				elseif($procenat<45)
				{
					drzi($igrac);
				}
				else
				{
					pas($igrac);
				}
			}
			elseif($potez == 3)
			{
				$ssut = 40;
				$spas = 40;
				$sdrzi = 20;
				if($procenat<20)
				{
					drzi($igrac);
				}
				elseif($procenat<60)
				{
					sut($igrac);
				}
				else
				{
					pas($igrac);
				}
			}
			elseif($potez == 4)
			{
				$ssut = 70;
				$spas = 20;
				$sdrzi = 10;
				if($procenat <10)
				{
					drzi($igrac);
				}
				elseif($procenat<30)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			else
			{
				sut($igrac);
			}
		}
		elseif($igrac->pozicija == "G")
		{
			if($potez == 1)
			{
				$ssut = 20;
				$spas = 50;
				$sdrzi = 30;
				if($procenat <20)
				{
					sut($igrac);
				}
				elseif($procenat<50)
				{
					drzi($igrac);
				}
				else
				{
					pas($igrac);
				}
			}
			elseif($potez == 2)
			{
				$ssut = 30;
				$spas = 45;
				$sdrzi = 25;
				if($procenat <25)
				{
					drzi($igrac);
				}
				elseif($procenat<55)
				{
					sut($igrac);
				}
				else
				{
					pas($igrac);
				}
			}
			elseif($potez == 3)
			{
				$ssut = 50;
				$spas = 35;
				$sdrzi = 15;
				if($procenat <15)
				{
					drzi($igrac);
				}
				elseif($procenat<50)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			elseif($potez == 4)
			{
				$ssut = 80;
				$spas = 15;
				$sdrzi = 5;
				if($procenat <5)
				{
					drzi($igrac);
				}
				elseif($procenat<20)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			else
			{
				sut($igrac);
			}
		}
		elseif($igrac->pozicija == "F")
		{
			if($potez == 1)
			{
				$ssut = 25;
				$spas = 50;
				$sdrzi = 25;
				if($procenat <25)
				{
					sut($igrac);
				}
				elseif($procenat<50)
				{
					drzi($igrac);
				}
				else
				{
					pas($igrac);
				}
			}
			elseif($potez == 2)
			{
				$ssut = 35;
				$spas = 45;
				$sdrzi = 20;
				if($procenat <20)
				{
					drzi($igrac);
				}
				elseif($procenat<55)
				{
					sut($igrac);
				}
				else
				{
					pas($igrac);
				}
			}
			elseif($potez == 3)
			{
				$ssut = 60;
				$spas = 25;
				$sdrzi = 15;
				if($procenat <15)
				{
					drzi($igrac);
				}
				elseif($procenat<40)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			elseif($potez == 4)
			{
				$ssut = 80;
				$spas = 15;
				$sdrzi = 5;
				if($procenat <5)
				{
					drzi($igrac);
				}
				elseif($procenat<20)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			else
			{
				sut($igrac);
			}
		}
		elseif($igrac->pozicija == "PF")
		{
			if($potez == 1)
			{
				$ssut = 30;
				$spas = 45;
				$sdrzi = 25;
				if($procenat <25)
				{
					drzi($igrac);
				}
				elseif($procenat<55)
				{
					sut($igrac);
				}
				else
				{
					pas($igrac);
				}
			}
			elseif($potez == 2)
			{
				$ssut = 40;
				$spas = 40;
				$sdrzi = 20;
				if($procenat <20)
				{
					drzi($igrac);
				}
				elseif($procenat<60)
				{
					sut($igrac);
				}
				else
				{
					pas($igrac);
				}
			}
			elseif($potez == 3)
			{
				$ssut = 55;
				$spas = 30;
				$sdrzi = 15;
				if($procenat <15)
				{
					drzi($igrac);
				}
				elseif($procenat<45)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			elseif($potez == 4)
			{
				$ssut = 85;
				$spas = 10;
				$sdrzi = 5;
				if($procenat <5)
				{
					drzi($igrac);
				}
				elseif($procenat<15)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			else
			{
				sut($igrac);
			}
		}
		else
		{
			if($potez == 1)
			{
				$ssut = 70;
				$spas = 25;
				$sdrzi = 5;
				if($procenat <5)
				{
					drzi($igrac);
				}
				elseif($procenat<30)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			elseif($potez == 2)
			{
				$ssut = 55;
				$spas = 35;
				$sdrzi = 10;
				if($procenat <10)
				{
					drzi($igrac);
				}
				elseif($procenat<45)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			elseif($potez == 3)
			{
				$ssut = 70;
				$spas = 25;
				$sdrzi = 5;
				if($procenat <5)
				{
					drzi($igrac);
				}
				elseif($procenat<30)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			elseif($potez == 4)
			{
				$ssut = 90;
				$spas = 10;
				$sdrzi = 0;
				if($procenat <10)
				{
					pas($igrac);
				}
				else
				{
					sut($igrac);
				}
			}
			else
			{	
				sut($igrac);
			}
		}
	}
}

function drzi($igrac)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez, $sec, $min, $produzetak;
	if($ukupnoVreme == 0 && $produzetak)
	{
		$sec = $sec - 4;
		if($sec <0)
		{
			$sec += 60;
			$min--;
		}
		$conn->query("UPDATE utakmica SET minuti = '$min', sekunde = '$sec' WHERE id = '$id'");
	}
	else
	{
		$sec = $sec - 8;
		if($sec <0)
		{
			$sec += 60;
			$min--;
		}
		$conn->query("UPDATE utakmica SET minuti = '$min', sekunde = '$sec' WHERE id = '$id'");
	}
	$ukupnoVreme += 2;
	sleep(2);
	if($napadtim == 1)
	{
		foreach($t2->aktivni as $igraci)
		{
			if($igraci->aktivan == $igrac->aktivan)
			{
				if(faul($igraci->agresivnost))
				{
					$poruka = $igraci->ime . " " . $igraci->prezime . " fauls " . $igrac->ime . " " . $igrac->prezime . "!";
					echo $poruka;
					$igrac->index++;
					$igraci->index--;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$napadtim = 2;
					novinapad();
				}
				else
				{
					$procenat1=$igraci->brzina+$igraci->ukradena_lopta;
					$procenat2=$igrac->brzina+$igrac->dribling;
					if($procenat1>$procenat2)
					{
						$procenat3=mt_rand(0,99);
						if($procenat3<15)
						{
							$poruka = $igraci->ime . " " . $igraci->prezime . " steals the ball from " . $igrac->ime . " " . $igrac->prezime . "!";
							echo $poruka;
							$igrac->index--;
							$igraci->index++;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							novinapad();
						}
						else
						{
							$poruka = $igrac->ime . " " . $igrac->prezime . " still with the ball.";
							echo $poruka;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							$potez++;
							igrac_ima_loptu($igrac);
						}
					}
					else
					{
						$procenat3=mt_rand(0,99);
						if($procenat3<5)
						{
							$poruka = $igraci->ime . " " . $igraci->prezime . " steals the ball from " . $igrac->ime . " " . $igrac->prezime . "!";
							echo $poruka;
							$igrac->index--;
							$igraci->index++;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							novinapad();
						}
						else
						{
							$poruka = $igrac->ime . " " . $igrac->prezime . " still with the ball.";
							echo $poruka;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							$potez++;
							igrac_ima_loptu($igrac);
						}
					}
				}
				break;
			}
		}
	}
	else
	{
		foreach($t1->aktivni as $igraci)
		{
			if($igraci->aktivan == $igrac->aktivan)
			{
				if(faul($igraci->agresivnost))
				{
					$poruka = $igraci->ime . " " . $igraci->prezime . " fauls " . $igrac->ime . " " . $igrac->prezime . "!";
					echo $poruka;
					$igrac->index++;
					$igraci->index--;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$napadtim = 1;
					novinapad();
				}
				else
				{
					$procenat1=$igraci->brzina+$igraci->ukradena_lopta;
					$procenat2=$igrac->brzina+$igrac->dribling;
					if($procenat1>$procenat2)
					{
						$procenat3=mt_rand(0,99);
						if($procenat3<15)
						{
							$poruka = $igraci->ime . " " . $igraci->prezime . " steals the ball from " . $igrac->ime . " " . $igrac->prezime . "!";
							echo $poruka;
							$igrac->index--;
							$igraci->index++;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							novinapad();
						}
						else
						{
							$poruka = $igrac->ime . " " . $igrac->prezime . " still with the ball.";
							echo $poruka;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							$potez++;
							igrac_ima_loptu($igrac);
						}
					}
					else
					{
						$procenat3=mt_rand(0,99);
						if($procenat3<5)
						{
							$poruka = $igraci->ime . " " . $igraci->prezime . " steals the ball from " . $igrac->ime . " " . $igrac->prezime . "!";
							echo $poruka;
							$igrac->index--;
							$igraci->index++;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							novinapad();
						}
						else
						{
							$poruka = $igrac->ime . " " . $igrac->prezime . " still with the ball.";
							echo $poruka;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							$potez++;
							igrac_ima_loptu($igrac);
						}
					}
				}
				break;
			}
		}		
	}
}

function pas($igrac)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez, $sec, $min, $produzetak, $poruka;
	if($ukupnoVreme == 0 && $produzetak)
	{
		$sec = $sec - 4;
		if($sec <0)
		{
			$sec += 60;
			$min--;
		}
		$conn->query("UPDATE utakmica SET minuti = '$min', sekunde = '$sec' WHERE id = '$id'");
	}
	else
	{
		$sec = $sec - 8;
		if($sec <0)
		{
			$sec += 60;
			$min--;
		}
		$conn->query("UPDATE utakmica SET minuti = '$min', sekunde = '$sec' WHERE id = '$id'");
	}
	$ukupnoVreme += 2;
	sleep(2);
	if($napadtim == 1)
	{
		foreach($t2->aktivni as $igraci)
		{
			if($igraci->aktivan == $igrac->aktivan)
			{
				if(out($igraci->agresivnost, $igrac->asistencija))
				{
					$poruka = $igrac->ime . " " . $igrac->prezime . " throws the ball out!";
					echo $poruka;
					$igrac->index--;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					novinapad();
				}
				else
				{
					$procenat1=$igraci->presecen_pas;
					$procenat2=$igrac->asistencija;
					if($procenat1>$procenat2)
					{
						$procenat3=mt_rand(0,99);
						if($procenat3<12)
						{
							$poruka = $igraci->ime . " " . $igraci->prezime . " intercepts the pass from " . $igrac->ime . " " . $igrac->prezime . "!";
							echo $poruka;
							$igrac->index--;
							$igraci->index++;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							novinapad();
						}
						else
						{
							$potez++;
							kome_bacen_pas($igrac);
						}
					}
					else
					{
						$procenat3=mt_rand(0,99);
						if($procenat3<4)
						{
							$poruka = $igraci->ime . " " . $igraci->prezime . " intercepts the pass from " . $igrac->ime . " " . $igrac->prezime . "!";
							echo $poruka;
							$igrac->index--;
							$igraci->index++;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							novinapad();
						}
						else
						{
							$potez++;
							kome_bacen_pas($igrac);
						}
					}
				}
				break;
			}
		}
	}
	else
	{
		foreach($t1->aktivni as $igraci)
		{
			if($igraci->aktivan == $igrac->aktivan)
			{
				if(out($igraci->agresivnost, $igrac->asistencija))
				{
					$poruka = $igrac->ime . " " . $igrac->prezime . " throws the ball out!";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$igrac->index--;
					novinapad();
				}
				else
				{
					$procenat1=$igraci->presecen_pas;
					$procenat2=$igrac->asistencija;
					if($procenat1>$procenat2)
					{
						$procenat3=mt_rand(0,99);
						if($procenat3<12)
						{
							$poruka = $igraci->ime . " " . $igraci->prezime . " intercepts the pass from " . $igrac->ime . " " . $igrac->prezime . "!";
							echo $poruka;
							$igrac->index--;
							$igraci->index++;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							novinapad();
						}
						else
						{
							$potez++;
							kome_bacen_pas($igrac);
						}
					}
					else
					{
						$procenat3=mt_rand(0,99);
						if($procenat3<4)
						{
							$poruka = $igraci->ime . " " . $igraci->prezime . " intercepts the pass from " . $igrac->ime . " " . $igrac->prezime . "!";
							echo $poruka;
							$igrac->index--;
							$igraci->index++;
							$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
							novinapad();
						}
						else
						{
							$potez++;
							kome_bacen_pas($igrac);
						}
					}
				}
				break;
			}
		}		
	}
}

function kome_bacen_pas($igrac)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	$sansa = mt_rand(0,99);
	if($napadtim == 1)
	{
		if($igrac->aktivan == 1)
		{
			if($sansa < 40)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 2)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 70)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 3)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 4)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 5)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
		}
		elseif($igrac->aktivan == 2)
		{
			if($sansa < 50)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 1)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 75)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 3)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 4)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 5)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}			
		}
		elseif($igrac->aktivan == 3)
		{
			if($sansa < 45)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 1)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 75)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 2)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 4)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 5)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}			
		}
		elseif($igrac->aktivan == 4)
		{
			if($sansa < 40)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 1)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 70)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 2)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 3)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 5)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}			
		}
		else
		{
			if($sansa < 40)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 1)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 70)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 2)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 3)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t1->aktivni as $igr)
				{
					if ($igr->aktivan == 4)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}			
		}
	}
	else 
	{
		if($igrac->aktivan == 1)
		{
			if($sansa < 40)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 2)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 70)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 3)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 4)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 5)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
		}
		elseif($igrac->aktivan == 2)
		{
			if($sansa < 50)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 1)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 75)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 3)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 4)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 5)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}			
		}
		elseif($igrac->aktivan == 3)
		{
			if($sansa < 45)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 1)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 75)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 2)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 4)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 5)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}			
		}
		elseif($igrac->aktivan == 4)
		{
			if($sansa < 40)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 1)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 70)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 2)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 3)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 5)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}			
		}
		else
		{
			if($sansa < 40)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 1)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 70)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 2)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			elseif($sansa < 90)
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 3)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}
			else
			{
				foreach ($t2->aktivni as $igr)
				{
					if ($igr->aktivan == 4)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " passes the ball to " . $igr->ime . " " . $igr->prezime . ".";
						echo $poruka;
						$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
						igrac_ima_loptu($igr);
						break;
					}
				}
			}			
		}
	}
}

function sut($igrac)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez, $sec, $min, $produzetak;
	if($ukupnoVreme == 0 && $produzetak)
	{
		$sec = $sec - 4;
		if($sec <0)
		{
			$sec += 60;
			$min--;
		}
		$conn->query("UPDATE utakmica SET minuti = '$min', sekunde = '$sec' WHERE id = '$id'");
	}
	else
	{
		$sec = $sec - 8;
		if($sec <0)
		{
			$sec += 60;
			$min--;
		}
		$conn->query("UPDATE utakmica SET minuti = '$min', sekunde = '$sec' WHERE id = '$id'");
	}
	$ukupnoVreme += 2;
	sleep(2);
	$pozicija = $igrac->pozicija;
	$sansa = mt_rand(0,99);
	if($pozicija == "PG")
	{
		if($sansa <50)
		{
			sutza2($igrac);
		}
		else
		{
			sutza3($igrac);
		}
	}
	elseif($pozicija == "G")
	{
		if($sansa <40)
		{
			sutza2($igrac);
		}
		else
		{
			sutza3($igrac);
		}
	}
	elseif($pozicija == "F")
	{
		if($sansa <45)
		{
			sutza2($igrac);
		}
		else
		{
			sutza3($igrac);
		}
	}
	elseif($pozicija == "PF")
	{
		if($sansa <80)
		{
			sutza2($igrac);
		}
		else
		{
			sutza3($igrac);
		}
	}
	else
	{
		if($sansa <95)
		{
			sutza2($igrac);
		}
		else
		{
			sutza3($igrac);
		}
	}
}

function sutza2($igrac)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	if($napadtim == 1)
	{
		foreach($t2->aktivni as $igraci)
		{
			if($igraci->aktivan == $igrac->aktivan)
			{
				if(faul($igraci->agresivnost))
				{
					$poruka = $igraci->ime . " " . $igraci->prezime . " fauls " . $igrac->ime . " " . $igrac->prezime . "! Two free throws.";
					echo $poruka;
					$igrac->index++;
					$igraci->index--;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					slobodna($igrac,2);
				}
				elseif (blokada($igrac))
				{
					uspesna_blokada();
				}
				else
				{
					$procenat = $igrac->sut_za_2 - 20;
					$sansa = mt_rand(0,99);
					if($sansa < $procenat)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " scores 2 points!";
						echo $poruka;
						$igrac->poeni += 2;
						$igrac->index += 2;
						$poenit1 += 2;
						$conn->query("UPDATE utakmica SET poeni_prvog_tima = '$poenit1', poruka = '$poruka' WHERE id = '$id'");
						novinapad();
					}
					else
					{
						$sansa1 = mt_rand(0,99);
						$igrac1 = 0;
						$igrac2 = 0;
						$i1 = 0;
						if($sansa1<40)
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 5)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 5)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<70)
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 4)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 4)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									
									echo $poruka;$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<85)
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 3)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 3)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<95)
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 2)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 2)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						else
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 1)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 1)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
					}
				}
				break;
			}
		}
	}
	else
	{
		foreach($t1->aktivni as $igraci)
		{
			if($igraci->aktivan == $igrac->aktivan)
			{
				if(faul($igraci->agresivnost))
				{
					$poruka = $igraci->ime . " " . $igraci->prezime . " fauls " . $igrac->ime . " " . $igrac->prezime . "! Two free throws.";
					echo $poruka;
					$igrac->index++;
					$igraci->index--;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					slobodna($igrac,2);
				}
				elseif (blokada($igrac))
				{
					uspesna_blokada();
				}
				else
				{
					$procenat = $igrac->sut_za_2 - 20;
					$sansa = mt_rand(0,99);
					if($sansa < $procenat)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " scores 2 points!";
						echo $poruka;
						$igrac->poeni += 2;
						$igrac->index += 2;
						$poenit2 += 2;
						$conn->query("UPDATE utakmica SET poeni_drugog_tima = '$poenit2', poruka = '$poruka' WHERE id = '$id'");
						
						novinapad();
					}
					else
					{
						$sansa1 = mt_rand(0,99);
						$igrac1 = 0;
						$igrac2 = 0;
						$i1 = 0;
						if($sansa1<40)
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 5)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 5)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<70)
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 4)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 4)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<85)
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 3)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 3)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<95)
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 2)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 2)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						else
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 1)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 1)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
					}
				}
				break;
			}
		}
	}
}

function sutza3($igrac)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	if($napadtim == 1)
	{
		foreach($t2->aktivni as $igraci)
		{
			if($igraci->aktivan == $igrac->aktivan)
			{
				if(faulZa3($igraci->agresivnost))
				{
					$poruka = $igraci->ime . " " . $igraci->prezime . " fauls " . $igrac->ime . " " . $igrac->prezime . "! Three free throws.";
					echo $poruka;
					$igrac->index++;
					$igraci->index--;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					slobodna($igrac, 3);
				}
				elseif (blokada($igrac))
				{
					uspesna_blokada();
				}
				else
				{
					$procenat = $igrac->sut_za_3 - 30;
					$sansa = mt_rand(0,99);
					if($sansa < $procenat)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " scores 3 points!";
						echo $poruka;
						$igrac->poeni += 3;
						$igrac->index += 3;
						$poenit1 += 3;
						$conn->query("UPDATE utakmica SET poeni_prvog_tima = '$poenit1', poruka = '$poruka' WHERE id = '$id'");
						novinapad();
					}
					else
					{
						$sansa1 = mt_rand(0,99);
						$igrac1 = 0;
						$igrac2 = 0;
						$i1 = 0;
						if($sansa1<40)
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 5)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 5)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<70)
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 4)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 4)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<85)
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 3)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 3)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<95)
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 2)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 2)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						else
						{
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 1)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 1)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
					}
				}
				break;
			}
		}
	}
	else
	{
		foreach($t1->aktivni as $igraci)
		{
			if($igraci->aktivan == $igrac->aktivan)
			{
				if(faulZa3($igraci->agresivnost))
				{
					$poruka = $igraci->ime . " " . $igraci->prezime . " fauls " . $igrac->ime . " " . $igrac->prezime . "! Three free throws.";
					echo $poruka;
					$igrac->index++;
					$igraci->index--;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					slobodna($igrac,3);
				}
				elseif (blokada($igrac))
				{
					uspesna_blokada();
				}
				else
				{
					$procenat = $igrac->sut_za_3 - 30;
					$sansa = mt_rand(0,99);
					if($sansa < $procenat)
					{
						$poruka = $igrac->ime . " " . $igrac->prezime . " scores 3 points!";
						echo $poruka;
						$igrac->poeni += 3;
						$igrac->index += 3;
						$poenit2 += 3;
						$conn->query("UPDATE utakmica SET poeni_drugog_tima = '$poenit2', poruka = '$poruka' WHERE id = '$id'");
						
						novinapad();
					}
					else
					{
						$sansa1 = mt_rand(0,99);
						$igrac1 = 0;
						$igrac2 = 0;
						$i1 = 0;
						if($sansa1<40)
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 5)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 5)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<70)
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 4)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 4)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<85)
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 3)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 3)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						elseif($sansa1<95)
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 2)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 2)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
						else
						{
							foreach($t2->aktivni as $igraci)
							{
								if($igraci->aktivan == 1)
								{
									$i1 = $igraci;
									$igrac1=$igraci->skok_u_napadu+$igraci->visina;
									break;
								}							
							}
							foreach($t1->aktivni as $igraci)
							{
								if($igraci->aktivan == 1)
								{
									$igrac2=$igraci->skok_u_odbrani+$igraci->visina;
									break;
								}							
							}
							$sansa2 = mt_rand(0,99);
							if($igrac1<$igrac2)
							{
								if($sansa2<10)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
							else
							{
								if($sansa2<18)
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot! " . $i1->ime . " " . $i1->prezime . " gets offensive rebound!";
									echo $poruka;
									$i1->index += 1;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									$potez = 1;
									igrac_ima_loptu($i1);
								}
								else
								{
									$poruka = $igrac->ime . " " . $igrac->prezime . " misses the shot, defensive rebound!";
									echo $poruka;
									$igrac->index--;
									$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
									novinapad();
								}
							}
						}
					}
				}
				break;
			}
		}
	}
}

function blokada($igrac)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	if($napadtim == 1)
	{
		foreach($t2->aktivni as $igraci)
		{
			if($igrac->aktivan == $igraci->aktivan)
			{
				$random = mt_rand(0,99);
				if($igrac->visina > $igraci->visina)
				{
					if($igraci->blokada < 63)
					{
						if($random < 1)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					elseif($igraci->blokada < 73)
					{
						if($random < 4)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					else
					{
						if($random < 8)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
				}
				else
				{
					if($igraci->blokada < 63)
					{
						if($random < 3)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					elseif($igraci->blokada < 73)
					{
						if($random <8)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					else
					{
						if($random < 12)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
				}
				break;
			}
		}
	}
	else
	{
		foreach($t1->aktivni as $igraci)
		{
			if($igrac->aktivan == $igraci->aktivan)
			{
				$random = mt_rand(0,99);
				if($igrac->visina > $igraci->visina)
				{
					if($igraci->blokada < 63)
					{
						if($random < 1)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					elseif($igraci->blokada < 73)
					{
						if($random < 4)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					else
					{
						if($random < 8)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
				}
				else
				{
					if($igraci->blokada < 63)
					{
						if($random < 3)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					elseif($igraci->blokada < 73)
					{
						if($random <8)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					else
					{
						if($random < 12)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
				}
				break;
			}
		}
	}
}

function uspesna_blokada()
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	
	$ukagre1 = 0;
	$ukagre2 = 0;
	$random1 = mt_rand(0,99);
	foreach($t1->aktivni as $igraci1)
	{
		$ukagre1 += $igraci1->agresivnost; 
	}
	foreach($t2->aktivni as $igraci2)
	{
		$ukagre2 += $igraci2->agresivnost;
	}
	if($ukagre1 > $ukagre2)
	{
		if($random1 < 60)
		{
			$poruka = "A shot has been blocked! New time for " . $t1->name . ".";
			echo $poruka;
			$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
			$napadtim = 2;
			novinapad();
		}
		else
		{
			$poruka = "A shot has been blocked! New time for " . $t2->name . ".";
			echo $poruka;
			$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
			novinapad();
		}
	}
	else
	{
		if($random1 < 40)
		{
			$poruka = "A shot has been blocked! New time for " . $t1->name . ".";
			echo $poruka;
			$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
			$napadtim = 1;
			novinapad();
		}
		else
		{
			$poruka = "A shot has been blocked! New time for " . $t2->name . ".";
			echo $poruka;
			$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
			novinapad();
		}
	}
}

function slobodna($igrac, $broj)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	
	sleep(2);
	if($napadtim == 1)
	{
		if($broj == 1)
		{
			$random = mt_rand(0,99);
			$slob = $igrac->sut_za_slobodna;
			if($slob > $random)
			{
				$poruka = $igrac->ime  . " " . $igrac->prezime . " scored free throw.";
				echo $poruka;
				$igrac->index++;
				$igrac->poeni++;
				$poenit1++;
				$conn->query("UPDATE utakmica SET poeni_prvog_tima = '$poenit1', poruka = '$poruka' WHERE id = '$id'");
				novinapad();
			}
			else
			{
				if($igrac->aktivan == 5)
				{
					$igrac3 = 0;
					$igrac4 = 0;
					$igrac5 = 0;
					foreach($t1->aktivni as $igraci)
					{
						if($igraci->aktivan == 3)
						{
							$igrac3 = $igraci;
						}
						elseif($igraci->aktivan == 4)
						{
							$igrac4 = $igraci;
						}
					}
					skok($igrac3,$igrac4);
				}
				elseif($igrac->aktivan == 4)
				{
					$igrac3 = 0;
					$igrac4 = 0;
					$igrac5 = 0;
					foreach($t1->aktivni as $igraci)
					{
						if($igraci->aktivan == 3)
						{
							$igrac3 = $igraci;
						}
						elseif($igraci->aktivan == 5)
						{
							$igrac5 = $igraci;
						}
					}
					skok($igrac3,$igrac5);
				}
				else
				{
					$igrac3 = 0;
					$igrac4 = 0;
					$igrac5 = 0;
					foreach($t1->aktivni as $igraci)
					{
						if($igraci->aktivan == 4)
						{
							$igrac4 = $igraci;
						}
						elseif($igraci->aktivan == 5)
						{
							$igrac5 = $igraci;
						}
					}
					skok($igrac4,$igrac5);
				}
			}
		}
		else
		{
			$random = mt_rand(0,99);
			$slob = $igrac->sut_za_slobodna;
			if($slob > $random)
			{
				$poruka = $igrac->ime  . " " . $igrac->prezime . " scored free throw.";
				echo $poruka;
				$igrac->index++;
				$igrac->poeni++;
				$poenit1++;
				$conn->query("UPDATE utakmica SET poeni_prvog_tima = '$poenit1', poruka = '$poruka' WHERE id = '$id'");
				
				$broj--;
				slobodna($igrac,$broj);
			}
			else
			{
				$poruka = $igrac->ime  . " " . $igrac->prezime . " missed free throw.";
				echo $poruka;
				$igrac->index--;
				$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				$broj--;
				slobodna($igrac,$broj);
			}
		}
	}
	else
	{
		if($broj == 1)
		{
			$random = mt_rand(0,99);
			$slob = $igrac->sut_za_slobodna;
			if($slob > $random)
			{
				$poruka = $igrac->ime  . " " . $igrac->prezime . " scored free throw.";
				echo $poruka;
				$igrac->index++;
				$igrac->poeni++;
				$poenit2++;
				$conn->query("UPDATE utakmica SET poeni_drugog_tima = '$poenit2', poruka = '$poruka' WHERE id = '$id'");
				
				novinapad();
			}
			else
			{
				if($igrac->aktivan == 5)
				{
					$igrac3 = 0;
					$igrac4 = 0;
					$igrac5 = 0;
					foreach($t2->aktivni as $igraci)
					{
						if($igraci->aktivan == 3)
						{
							$igrac3 = $igraci;
						}
						elseif($igraci->aktivan == 4)
						{
							$igrac4 = $igraci;
						}
					}
					skok($igrac3,$igrac4);
				}
				elseif($igrac->aktivan == 4)
				{
					$igrac3 = 0;
					$igrac4 = 0;
					$igrac5 = 0;
					foreach($t2->aktivni as $igraci)
					{
						if($igraci->aktivan == 3)
						{
							$igrac3 = $igraci;
						}
						elseif($igraci->aktivan == 5)
						{
							$igrac5 = $igraci;
						}
					}
					skok($igrac3,$igrac5);
				}
				else
				{
					$igrac3 = 0;
					$igrac4 = 0;
					$igrac5 = 0;
					foreach($t2->aktivni as $igraci)
					{
						if($igraci->aktivan == 4)
						{
							$igrac4 = $igraci;
						}
						elseif($igraci->aktivan == 5)
						{
							$igrac5 = $igraci;
						}
					}
					skok($igrac4,$igrac5);
				}
			}
		}
		else
		{
			$random = mt_rand(0,99);
			$slob = $igrac->sut_za_slobodna;
			if($slob > $random)
			{
				$poruka = $igrac->ime  . " " . $igrac->prezime . " scored free throw.";
				echo $poruka;
				$igrac->index++;
				$igrac->poeni++;
				$poenit2++;
				$conn->query("UPDATE utakmica SET poeni_drugog_tima = '$poenit2', poruka = '$poruka' WHERE id = '$id'");
				
				$broj--;
				slobodna($igrac,$broj);
			}
			else
			{
				$poruka = $igrac->ime  . " " . $igrac->prezime . " missed free throw.";
				echo $poruka;
				$igrac->index--;
				$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				$broj--;
				slobodna($igrac,$broj);
			}
		}
	}
}

function skok($igrac1,$igrac2)
{
	global $conn, $cetvrtine, $id, $poenit1, $t1, $tim1id, $broj_odigranih_t1, $pobede_t1, $porazi_t1, $br_bodova_t1, $kolicnik_t1, $forma_t1, 
	$budzet_t1, $sponzor_t1, $sedista_t1, $hrana_t1, $parking_t1, $pice_t1, $cena_t1, $pozicija_t1, $poenit2, $t2, $tim2id, $broj_odigranih_t2, 
	$pobede_t2, $porazi_t2, $br_bodova_t2, $kolicnik_t2, $forma_t2, $budzet_t2, $sponzor_t2, $sedista_t2, $hrana_t2, $parking_t2, $pice_t2, 
	$cena_t2, $pozicija_t2, $flag_za_reset, $ukupnoVreme, $napadtim, $imaloptu,	$potez;
	if($napadtim == 1)
	{
		$avg1 = ($igrac1->skok_u_napadu + $igrac2->skok_u_napadu)/2;
		$igrac3 = 0;
		$igrac4 = 0;
		$igrac5 = 0;
		foreach($t2->aktivni as $igraci)
		{
			if($igraci->aktivan == 3)
			{
				$igrac3 = $igraci;
			}
			elseif($igraci->aktivan == 4)
			{
				$igrac4 = $igraci;
			}
			elseif($igraci->aktivan == 5)
			{
				$igrac5 = $igraci;
			}
		}
		$avg2 = ($igrac3->skok_u_odbrani + $igrac4->skok_u_odbrani + $igrac5->skok_u_odbrani)/3;
		$random = mt_rand(0,99);
		if($avg1 < $avg2)
		{
			if($random < 5)
			{
				if($igrac1->skok_u_napadu > $igrac2->skok_u_napadu)
				{
					$poruka = $igrac1->ime  . " " . $igrac1->prezime . " catches the ball after free throw! New time for " . $t1->name . ".";
					echo $poruka;
					$igrac1->index++;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$potez = 1;
					igrac_ima_loptu($igrac1);
				}
				else
				{
					$poruka = $igrac2->ime  . " " . $igrac2->prezime . " catches the ball after free throw! New time for " . $t1->name . ".";
					echo $poruka;
					$igrac2->index++;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$potez = 1;
					igrac_ima_loptu($igrac2);
				}
			}
			else
			{
				if(($igrac3->skok_u_odbrani > $igrac4->skok_u_odbrani) && ($igrac3->skok_u_odbrani > $igrac5->skok_u_odbrani))
				{
					$poruka = $igrac3->ime  . " " . $igrac3->prezime . " catches the ball and pass it to the playmaker. New time for " . $t2->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				elseif(($igrac4->skok_u_odbrani > $igrac3->skok_u_odbrani) && ($igrac4->skok_u_odbrani > $igrac5->skok_u_odbrani))
				{
					$poruka = $igrac4->ime  . " " . $igrac4->prezime . " catches the ball and pass it to the playmaker. New time for " . $t2->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				else
				{
					$poruka = $igrac5->ime  . " " . $igrac5->prezime . " catches the ball and pass it to the playmaker. New time for " . $t2->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				novinapad();
			}
		}
		else
		{
			if($random < 10)
			{
				if($igrac1->skok_u_napadu > $igrac2->skok_u_napadu)
				{
					$poruka = $igrac1->ime  . " " . $igrac1->prezime . " catched the ball after free throw! New time for " . $t1->name . ".";
					echo $poruka;
					$igrac1->index++;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$potez = 1;
					igrac_ima_loptu($igrac1);
				}
				else
				{
					$poruka = $igrac2->ime  . " " . $igrac2->prezime . " catched the ball after free throw! New time for " . $t1->name . ".";
					echo $poruka;
					$igrac2->index++;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$potez = 1;
					igrac_ima_loptu($igrac1);
				}
			}
			else
			{
				if(($igrac3->skok_u_odbrani > $igrac4->skok_u_odbrani) && ($igrac3->skok_u_odbrani > $igrac5->skok_u_odbrani))
				{
					$poruka = $igrac3->ime  . " " . $igrac3->prezime . " catches the ball and pass it to the playmaker. New time for " . $t2->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				elseif(($igrac4->skok_u_odbrani > $igrac3->skok_u_odbrani) && ($igrac4->skok_u_odbrani > $igrac5->skok_u_odbrani))
				{
					$poruka = $igrac4->ime  . " " . $igrac4->prezime . " catches the ball and pass it to the playmaker. New time for " . $t2->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				else
				{
					$poruka = $igrac5->ime  . " " . $igrac5->prezime . " catches the ball and pass it to the playmaker. New time for " . $t2->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				novinapad();
			}
		}
	}
	else
	{
		$avg1 = ($igrac1->skok_u_napadu + $igrac2->skok_u_napadu)/2;
		$igrac3 = 0;
		$igrac4 = 0;
		$igrac5 = 0;
		foreach($t1->aktivni as $igraci)
		{
			if($igraci->aktivan == 3)
			{
				$igrac3 = $igraci;
			}
			elseif($igraci->aktivan == 4)
			{
				$igrac4 = $igraci;
			}
			elseif($igraci->aktivan == 5)
			{
				$igrac5 = $igraci;
			}
		}
		$avg2 = ($igrac3->skok_u_odbrani + $igrac4->skok_u_odbrani + $igrac5->skok_u_odbrani)/3;
		$random = mt_rand(0,99);
		if($avg1 < $avg2)
		{
			if($random < 5)
			{
				if($igrac1->skok_u_napadu > $igrac2->skok_u_napadu)
				{
					$poruka = $igrac1->ime  . " " . $igrac1->prezime . " catched the ball after free throw! New time for " . $t2->name . ".";
					echo $poruka;
					$igrac1->index++;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$potez = 1;
					igrac_ima_loptu($igrac1);
				}
				else
				{
					$poruka = $igrac2->ime  . " " . $igrac2->prezime . " catched the ball after free throw! New time for " . $t2->name . ".";
					echo $poruka;
					$igrac2->index++;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$potez = 1;
					igrac_ima_loptu($igrac1);
				}
			}
			else
			{
				if(($igrac3->skok_u_odbrani > $igrac4->skok_u_odbrani) && ($igrac3->skok_u_odbrani > $igrac5->skok_u_odbrani))
				{
					$poruka = $igrac3->ime  . " " . $igrac3->prezime . " catches the ball and pass it to the playmaker. New time for " . $t1->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				elseif(($igrac4->skok_u_odbrani > $igrac3->skok_u_odbrani) && ($igrac4->skok_u_odbrani > $igrac5->skok_u_odbrani))
				{
					$poruka = $igrac4->ime  . " " . $igrac4->prezime . " catches the ball and pass it to the playmaker. New time for " . $t1->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				else
				{
					$poruka = $igrac5->ime  . " " . $igrac5->prezime . " catches the ball and pass it to the playmaker. New time for " . $t1->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				novinapad();
			}
		}
		else
		{
			if($random < 10)
			{
				if($igrac1->skok_u_napadu > $igrac2->skok_u_napadu)
				{
					$poruka = $igrac1->ime  . " " . $igrac1->prezime . " catched the ball after free throw! New time for " . $t2->name . ".";
					echo $poruka;
					$igrac1->index++;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$potez = 1;
					igrac_ima_loptu($igrac1);
				}
				else
				{
					$poruka = $igrac2->ime  . " " . $igrac2->prezime . " catched the ball after free throw! New time for " . $t2->name . ".";
					echo $poruka;
					$igrac2->index++;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
					$potez = 1;
					igrac_ima_loptu($igrac1);
				}
			}
			else
			{
				if(($igrac3->skok_u_odbrani > $igrac4->skok_u_odbrani) && ($igrac3->skok_u_odbrani > $igrac5->skok_u_odbrani))
				{
					$poruka = $igrac3->ime  . " " . $igrac3->prezime . " catches the ball and pass it to the playmaker. New time for " . $t1->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				elseif(($igrac4->skok_u_odbrani > $igrac3->skok_u_odbrani) && ($igrac4->skok_u_odbrani > $igrac5->skok_u_odbrani))
				{
					$poruka = $igrac4->ime  . " " . $igrac4->prezime . " catches the ball and pass it to the playmaker. New time for " . $t1->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				else
				{
					$poruka = $igrac5->ime  . " " . $igrac5->prezime . " catches the ball and pass it to the playmaker. New time for " . $t1->name . ".";
					echo $poruka;
					$conn->query("UPDATE utakmica SET poruka = '$poruka' WHERE id = '$id'");
				}
				novinapad();
			}
		}
	}
}
?>