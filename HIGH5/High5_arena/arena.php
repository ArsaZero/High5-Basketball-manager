<?php
require_once 'config.php';

session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
      // username and password sent from form 
    //something posted
		$myusername = $_SESSION['username'];
	
		$sql="SELECT id,tim_id FROM korisnik WHERE username = '$myusername'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$idt = (int)$row['tim_id'];
		
		$sql = "SELECT balance FROM tim WHERE id = $idt";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$budzet = (int)$row['balance'];
		
		$sql = "SELECT arena_id FROM tim WHERE id = $idt";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$id = (int)$row['arena_id'];
		

		
		$sql = "SELECT * FROM arena WHERE id = $id";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$naziv=$row['naziv'];
		$seats=$row['seatsLvl'];
		$snacks=$row['snacksLvl'];
		$parking=$row['parkingLvl'];
		$drinks=$row['drinksLvl'];
		$se=$row['seats'];
		$sn=$row['snacks'];
		$pa=$row['parking'];
		$dr=$row['drinks'];
		$ce=$row['cena_karte'];
		$se=$se*2;
		$sn=$sn*2;
		$pa=$pa*2;
		$dr=$dr*2;
		$cose=$se*3*5;
		$cosn=$sn*4;
		$copa=$pa*4;
		$codr=$dr*4;
		if (isset($_POST['seats']))
		{
			if($budzet >= $cose)
			{
				$seats=$seats+1;
				$sql = "UPDATE arena SET seatsLvl='$seats',seats='$se' WHERE id='$id'";
				$conn->query($sql);
				$budzet=$budzet-$cose;
				$sql = "UPDATE tim SET balance='$budzet' WHERE id='$idt'";
				$conn->query($sql);
				echo "<script>
				alert('Successfully upgraded!');
				window.location.href='/HIGH5/high5_arena/High5_arena.php';
				</script>";
			}
			else
			{
			$message = "Not enough money!";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='/HIGH5/high5_arena/High5_arena.php';</script>";
			}
		}
		elseif (isset($_POST['snacks']))
		{
			if($budzet >= $cosn)
			{
				$snacks=$snacks+1;
				$sql = "UPDATE arena SET snacksLvl='$snacks',snacks='$sn' WHERE id='$id'";
				$conn->query($sql);
				$budzet=$budzet-$cosn;
				$sql = "UPDATE tim SET balance='$budzet' WHERE id='$idt'";
				$conn->query($sql);
				echo "<script>
				alert('Successfully upgraded!');
				window.location.href='/HIGH5/high5_arena/High5_arena.php';
				</script>";
			}
			else
			{
			$message = "Not enough money!";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='/HIGH5/high5_arena/High5_arena.php';</script>";
			}
		}
		elseif (isset($_POST['parking']))
		{
			if ($budzet >= $copa)
			{
				$parking=$parking+1;
				$sql = "UPDATE arena SET parkingLvl='$parking',parking='$pa' WHERE id='$id'";
				$conn->query($sql);
				$budzet=$budzet-$copa;
				$sql = "UPDATE tim SET balance='$budzet' WHERE id='$idt'";
				$conn->query($sql);
				echo "<script>
				alert('Successfully upgraded!');
				window.location.href='/HIGH5/High5_arena/High5_arena.php';
				</script>";
			}
			else
			{
			$message = "Not enough money!";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='/HIGH5/High5_arena/High5_arena.php';</script>";
			}
		}
		elseif (isset($_POST['drinks']))
		{
			if($budzet >= $codr)
			{
				$drinks=$drinks+1;
				$sql = "UPDATE arena SET drinksLvl='$drinks',drinks='$dr' WHERE id='$id'";
				$conn->query($sql);
				$budzet=$budzet-$codr;
				$sql = "UPDATE tim SET balance='$budzet' WHERE id='$idt'";
				$conn->query($sql);
				echo "<script>
				alert('Successfully upgraded!');
				window.location.href='/HIGH5/High5_arena/High5_arena.php';
				</script>";
			}
			else
			{
			$message = "Not enough money!";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='/HIGH5/High5_arena/High5_arena.php';</script>";
			}
		}
		elseif (isset($_POST['cena_karte']))
		{
			$cena=$_POST['cena'];
			$sql = "UPDATE arena SET cena_karte=$cena WHERE id=$id";
			$conn->query($sql);
			header('location: /HIGH5/High5_arena/High5_arena.php');
		}
	}
		$conn->close();
?>