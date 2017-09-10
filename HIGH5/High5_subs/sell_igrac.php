<?php 
require_once 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$flag = 0;
	
	$username = $_SESSION['username'];
	$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$tim_id = (int)$row['tim_id'];
	$result->close();
	
	//uzimam broj igraca u timu, jer mu je min vrednost 10
	$sql = "SELECT COUNT(*) as br FROM igrac WHERE tim_id = $tim_id";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$br_igraca = (int)$row['br'];
	$result->close();
	
	if($br_igraca <= 10)
	{
		$message = "You have minimum number of players in team!";
		echo "<script type='text/javascript'>alert('$message');
			window.location.href='/HIGH5/High5_team/High5_team.php';</script>";
	}
	else
	{
	
		//uzimam balance iz zadatog tima
		$sql = "SELECT balance FROM tim WHERE id = $tim_id";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$budzet = (int)$row['balance'];
		$result->close();
		
		$sql = "SELECT id FROM igrac WHERE tim_id = '$tim_id'";
		$result = $conn->query($sql);
		//trazim koji submit je kliknut, tj. id igraca koji treba da se proda
		if ($result)
		{
			while ($row = $result->fetch_assoc())
			{
				$id = $row['id'];
				if (isset( $_POST[$id]))
				{ 
					$sql = "SELECT aktivan FROM igrac WHERE id = '$id'";
					$rezu = $conn->query($sql);
					$rowww = $rezu->fetch_assoc();
					$akt = (int)$rowww['aktivan'];
					if($akt == 1)
					{
						$sql = "SELECT id FROM igrac WHERE (pozicija = 'PG') AND tim_id=$tim_id AND aktivan is NULL";
						$resu = $conn->query($sql);
						if ($resu->num_rows != 0)
						{
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '1', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}
						else
						{
							$sql = "SELECT id FROM igrac WHERE (pozicija = 'G') AND tim_id=$tim_id AND aktivan is NULL";
							$resu = $conn->query($sql);
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '1', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}
					}
					if($akt == 2)
					{
						$sql = "SELECT id FROM igrac WHERE (pozicija = 'G') AND tim_id=$tim_id AND aktivan is NULL";
						$resu = $conn->query($sql);
						if ($resu->num_rows != 0)
						{
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '2', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}
						else
						{
							$sql = "SELECT id FROM igrac WHERE (pozicija = 'PG' OR pozicija = 'F') AND tim_id=$tim_id AND aktivan is NULL";
							$resu = $conn->query($sql);
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '2', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}
						
					}
					if($akt == 3)
					{
						$sql = "SELECT id FROM igrac WHERE (pozicija = 'F') AND tim_id=$tim_id AND aktivan is NULL";
						$resu = $conn->query($sql);
						if ($resu->num_rows != 0)
						{
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '3', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}
						else
						{
							$sql = "SELECT id FROM igrac WHERE (pozicija = 'G' OR pozicija = 'PF') AND tim_id=$tim_id AND aktivan is NULL";
							$resu = $conn->query($sql);
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '3', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}
						
					}
					if($akt == 4)
					{
						$sql = "SELECT id FROM igrac WHERE (pozicija = 'PF') AND tim_id=$tim_id AND aktivan is NULL";
						$resu = $conn->query($sql);
						if ($resu->num_rows != 0)
						{
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '4', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}
						else
						{
							$sql = "SELECT id FROM igrac WHERE (pozicija = 'F' OR pozicija = 'C') AND tim_id=$tim_id AND aktivan is NULL";
							$resu = $conn->query($sql);
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '4', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}
					}
					if($akt == 5)
					{
						$sql = "SELECT id FROM igrac WHERE (pozicija = 'C') AND tim_id=$tim_id AND aktivan is NULL";
						$resu = $conn->query($sql);
						if ($resu->num_rows != 0)
						{
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '5', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}
						else
						{
							$sql = "SELECT id FROM igrac WHERE (pozicija = 'PF') AND tim_id=$tim_id AND aktivan is NULL";
							$resu = $conn->query($sql);
							$rowww = $resu->fetch_assoc();
							$id1 = (int)$rowww['id'];
							$sql = "UPDATE igrac SET aktivan = '5', tim_id=$tim_id WHERE id='$id1'";
							$conn->query($sql);
						}	
					}
					
					//brisem igraca iz tima
					$sql = "UPDATE igrac SET broj_na_dresu=NULL, tim_id=NULL WHERE id='$id'";
					$conn->query($sql);
					//uzimam cenu igraca
					$sql = "SELECT cost FROM igrac WHERE id = $id";
					$resultat = $conn->query($sql);
					$roww = $resultat->fetch_assoc();
					$cena = (int)$roww['cost'];
					$resultat->close();
					//povecavam ukupan budzet tima
					$budzet=$budzet+$cena;
					$sql = "UPDATE tim SET balance='$budzet' WHERE id='$tim_id'";
					$conn->query($sql);
				}
			}
			$result->close();
			$conn->close();
			header('location: /HIGH5/high5_team/High5_team.php');
			
		}
	}
}
else
{
	$message = "REQUEST_METHOD != POST";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>