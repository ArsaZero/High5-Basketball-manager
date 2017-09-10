<?php
require_once 'config.php';
session_start();

$flag = 0;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_SESSION['username'];
	$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$tim_id = (int)$row['tim_id'];
	$result->close();
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id'";
	$result = $conn->query($sql);
	if ($result)
	{
		$niz = array();
		while ($row = $result->fetch_assoc())
		{
			$id = $row['id'];
			$niz[$id]['broj_na_dresu'] = $row['broj_na_dresu'];
			$niz[$id]['ime'] = $row['ime'];
			$niz[$id]['prezime'] = $row['prezime'];
			$niz[$id]['starost'] = $row['starost'];
			$niz[$id]['stamina'] = $row['stamina'];
			$niz[$id]['moral'] = $row['moral'];
			$niz[$id]['visina'] = $row['visina'];
			$niz[$id]['pozicija'] = $row['pozicija'];
			$niz[$id]['brzina'] = $row['brzina'];
			$niz[$id]['agresivnost'] = $row['agresivnost'];
			$niz[$id]['sut_za_2'] = $row['sut_za_2'];
			$niz[$id]['sut_za_3'] = $row['sut_za_3'];
			$niz[$id]['sut_za_slobodna'] = $row['sut_za_slobodna'];
			$niz[$id]['skok_u_napadu'] = $row['skok_u_napadu'];
			$niz[$id]['asistencija'] = $row['asistencija'];
			$niz[$id]['dribling'] = $row['dribling'];
			$niz[$id]['skok_u_odbrani'] = $row['skok_u_odbrani'];
			$niz[$id]['blokada'] = $row['blokada'];
			$niz[$id]['presecen_pas'] = $row['presecen_pas'];
			$niz[$id]['ukradena_lopta'] = $row['ukradena_lopta'];
			$niz[$id]['next_level'] = $row['next_level'];
			$niz[$id]['cost'] = $row['cost'];
			$avg = ($niz[$id]['brzina'] + $niz[$id]['agresivnost'] + 
			$niz[$id]['sut_za_2'] + $niz[$id]['sut_za_3'] + 
			$niz[$id]['sut_za_slobodna'] + $niz[$id]['skok_u_napadu'] + 
			$niz[$id]['asistencija'] + $niz[$id]['dribling'] + 
			$niz[$id]['skok_u_odbrani'] + $niz[$id]['blokada'] + 
			$niz[$id]['presecen_pas'] + $niz[$id]['ukradena_lopta']) / 12;
			$niz[$id]['avg'] = number_format($avg, 2);
		}
		$tr_dif = $_POST['tr_dif'];
		$_SESSION['vrstatreninga'] = $tr_dif;
		foreach($niz as $id=>$igrac)
		{
			$mor = $igrac['moral'] / 25;
			$avg1 = 65 / $igrac['avg'];
			$mnoz = $mor + $avg1;
			$stam = $igrac['stamina'];
			$poz = $igrac['pozicija'];
			$nl = $igrac['next_level'];
			if(isset($_POST[$id]))
			{
				if ($stam < 21)
				{
					$n = $igrac['ime'];
					$flag = 1;
					continue;
				}
				if($igrac['starost'] < 23)
				{
					$stam = $stam - 4*$tr_dif;
					$nl = $nl + 12*$mnoz*$tr_dif;
				}
				else if($igrac['starost'] < 29)
				{
					$stam = $stam - 5*$tr_dif;
					$nl = $nl + 10*$mnoz*$tr_dif;
				}
				else
				{
					$stam = $stam - 7*$tr_dif;
					$nl = $nl + 7*$mnoz*$tr_dif;
				}
				
				$sql = "UPDATE igrac SET stamina = '$stam' WHERE id = '$id'";
				$result = $conn->query($sql);

				
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
									$tmp = $igrac['asistencija'] + 1;
									$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 30:
								{
									$tmp = $igrac['dribling'] + 1;
									$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 45:
								{
									$tmp = $igrac['ukradena_lopta'] + 1;
									$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 60:
								{
									$tmp = $igrac['sut_za_3'] + 1;
									$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 65:
								{
									$tmp = $igrac['sut_za_2'] + 1;
									$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 70:
								{
									$tmp = $igrac['sut_za_slobodna'] + 1;
									$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 75:
								{
									$tmp = $igrac['skok_u_napadu'] + 1;
									$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 80:
								{
									$tmp = $igrac['skok_u_odbrani'] + 1;
									$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 85:
								{
									$tmp = $igrac['presecen_pas'] + 1;
									$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 90:
								{
									$tmp = $igrac['brzina'] + 1;
									$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 95:
								{
									$tmp = $igrac['agresivnost'] + 1;
									$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								default:
								{
									$tmp = $igrac['blokada'] + 1;
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
									$tmp = $igrac['agresivnost'] + 1;
									$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 30:
								{
									$tmp = $igrac['dribling'] + 1;
									$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 45:
								{
									$tmp = $igrac['sut_za_slobodna'] + 1;
									$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 60:
								{
									$tmp = $igrac['sut_za_3'] + 1;
									$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 65:
								{
									$tmp = $igrac['sut_za_2'] + 1;
									$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 70:
								{
									$tmp = $igrac['ukradena_lopta'] + 1;
									$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 75:
								{
									$tmp = $igrac['skok_u_napadu'] + 1;
									$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 80:
								{
									$tmp = $igrac['skok_u_odbrani'] + 1;
									$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 85:
								{
									$tmp = $igrac['presecen_pas'] + 1;
									$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 90:
								{
									$tmp = $igrac['brzina'] + 1;
									$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 95:
								{
									$tmp = $igrac['asistencija'] + 1;
									$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								default:
								{
									$tmp = $igrac['blokada'] + 1;
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
									$tmp = $igrac['skok_u_odbrani'] + 1;
									$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 30:
								{
									$tmp = $igrac['presecen_pas'] + 1;
									$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 45:
								{
									$tmp = $igrac['sut_za_2'] + 1;
									$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 60:
								{
									$tmp = $igrac['sut_za_3'] + 1;
									$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 65:
								{
									$tmp = $igrac['sut_za_slobodna'] + 1;
									$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 70:
								{
									$tmp = $igrac['ukradena_lopta'] + 1;
									$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 75:
								{
									$tmp = $igrac['skok_u_napadu'] + 1;
									$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 80:
								{
									$tmp = $igrac['dribling'] + 1;
									$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 85:
								{
									$tmp = $igrac['agresivnost'] + 1;
									$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 90:
								{
									$tmp = $igrac['brzina'] + 1;
									$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 95:
								{
									$tmp = $igrac['asistencija'] + 1;
									$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								default:
								{
									$tmp = $igrac['blokada'] + 1;
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
									$tmp = $igrac['skok_u_odbrani'] + 1;
									$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 30:
								{
									$tmp = $igrac['skok_u_napadu'] + 1;
									$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 45:
								{
									$tmp = $igrac['sut_za_2'] + 1;
									$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 60:
								{
									$tmp = $igrac['sut_za_slobodna'] + 1;
									$sql = "UPDATE igrac SET sut_za_slobodna = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 65:
								{
									$tmp = $igrac['sut_za_3'] + 1;
									$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 70:
								{
									$tmp = $igrac['ukradena_lopta'] + 1;
									$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 75:
								{
									$tmp = $igrac['presecen_pas'] + 1;
									$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 80:
								{
									$tmp = $igrac['dribling'] + 1;
									$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 85:
								{
									$tmp = $igrac['agresivnost'] + 1;
									$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 90:
								{
									$tmp = $igrac['brzina'] + 1;
									$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 95:
								{
									$tmp = $igrac['asistencija'] + 1;
									$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								default:
								{
									$tmp = $igrac['blokada'] + 1;
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
									$tmp = $igrac['skok_u_odbrani'] + 1;
									$sql = "UPDATE igrac SET skok_u_odbrani = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 30:
								{
									$tmp = $igrac['skok_u_napadu'] + 1;
									$sql = "UPDATE igrac SET skok_u_napadu = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 45:
								{
									$tmp = $igrac['sut_za_2'] + 1;
									$sql = "UPDATE igrac SET sut_za_2 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 60:
								{
									$tmp = $igrac['blokada'] + 1;
									$sql = "UPDATE igrac SET blokada = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 65:
								{
									$tmp = $igrac['sut_za_3'] + 1;
									$sql = "UPDATE igrac SET sut_za_3 = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 70:
								{
									$tmp = $igrac['ukradena_lopta'] + 1;
									$sql = "UPDATE igrac SET ukradena_lopta = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 75:
								{
									$tmp = $igrac['presecen_pas'] + 1;
									$sql = "UPDATE igrac SET presecen_pas = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 80:
								{
									$tmp = $igrac['dribling'] + 1;
									$sql = "UPDATE igrac SET dribling = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 85:
								{
									$tmp = $igrac['agresivnost'] + 1;
									$sql = "UPDATE igrac SET agresivnost = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 90:
								{
									$tmp = $igrac['brzina'] + 1;
									$sql = "UPDATE igrac SET brzina = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								case $r <= 95:
								{
									$tmp = $igrac['asistencija'] + 1;
									$sql = "UPDATE igrac SET asistencija = '$tmp' WHERE id = '$id'";
									$result = $conn->query($sql);
									break;
								}
								default:
								{
									$tmp = $igrac['sut_za_slobodna'] + 1;
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
		}
		

			
	}
	
	
}
if ($flag === 1)
{
	echo "<script>
	alert('One or more players are too tired for training! They need to have at least 21 stamina.');
	window.location.href='/HIGH5/High5_training/High5_training.php';
	</script>";
}
else
{
	header('location: /HIGH5/High5_training/High5_training.php');
}

?>