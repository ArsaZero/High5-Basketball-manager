<?php 
require_once 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$username = $_SESSION['username'];
	$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$tim_id = (int)$row['tim_id'];
	$result->close();
	$flag = 0;
	//uzimam broj igraca u timu, jer mu je min vrednost 10
	$sql = "SELECT COUNT(*) as br FROM igrac WHERE tim_id = $tim_id";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$br_igraca = (int)$row['br'];
	$result->close();

	if($br_igraca >= 14)
	{
		$message = "You have maximum number of players in team!";
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
		
		$sql = "SELECT id FROM igrac WHERE tim_id is NULL";
		$result = $conn->query($sql);
		//trazim koji submit je kliknut, tj. id igraca koji treba da se proda
		if ($result)
		{
			while ($row = $result->fetch_assoc())
			{
				$id = $row['id'];
				if (isset( $_POST[$id]))
				{ 
					
					$brojnadresu=4;
					$sql = "SELECT id FROM igrac WHERE tim_id=$tim_id AND broj_na_dresu=$brojnadresu";
					$res=$conn->query($sql);
					while ($res->num_rows != 0)
					{
						$brojnadresu=$brojnadresu+1;
						$sql = "SELECT id FROM igrac WHERE tim_id=$tim_id AND broj_na_dresu=$brojnadresu";
						$res=$conn->query($sql);
						
					}
					
					$res->close();
					$sql = "SELECT cost FROM igrac WHERE id = $id";
					$resultat = $conn->query($sql);
					$roww = $resultat->fetch_assoc();
					$cena = (int)$roww['cost'];
					$resultat->close();
					
					if($budzet > $cena)
					{
					$sql = "UPDATE igrac SET broj_na_dresu='$brojnadresu', tim_id=$tim_id WHERE id='$id'";
					$conn->query($sql);
					//uzimam cenu igraca
					
					//povecavam ukupan budzet tima
					$budzet=$budzet-$cena;
					$sql = "UPDATE tim SET balance='$budzet' WHERE id='$tim_id'";
					$conn->query($sql);
					}
					else{
						$flag = 1;
					}
				}
			}
			$result->close();
			$conn->close();
			if ($flag == 0)
			{
				echo "<script>
				alert('You have successfuly bought a player!');
				window.location.href='/HIGH5/high5_team/High5_team.php';
				</script>";
			}
			else
			{
				echo "<script>
				alert('You do not have enough money for this player!');
				window.location.href='/HIGH5/high5_transfers/High5_transfers.php';
				</script>";
			}
		}
	}
}
else
{
	$message = "REQUEST_METHOD != POST";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>