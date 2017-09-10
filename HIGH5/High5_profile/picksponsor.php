<?php
require_once 'config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_SESSION['username'];
		$sponsor = $_POST['sponsor'];
		$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$tim_id = (int)$row['tim_id'];
		$result->close();
		
		$sql = "SELECT sponzor,balance FROM tim WHERE id = '$tim_id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$sponzor = $row['sponzor'];
		$budzet = (int)$row['balance'];
		if($sponzor != "Nike" && $sponzor != "Adidas" && $sponzor !="Puma")
		{
			if($sponsor == "Nike")
			{
				$sql = "UPDATE tim SET sponzor = 'Nike' WHERE id='$tim_id'";
				$conn->query($sql);
				$budzet=$budzet+3000;
				$sql = "UPDATE tim SET balance='$budzet' WHERE id='$tim_id'";
				$conn->query($sql);
			}
			else if ($sponsor == "Adidas")
			{
				$sql = "UPDATE tim SET sponzor = 'Adidas' WHERE id='$tim_id'";
				$conn->query($sql);
				$budzet=$budzet+2000;
				$sql = "UPDATE tim SET balance='$budzet' WHERE id='$tim_id'";
				$conn->query($sql);
			}
			else if ($sponsor == "Puma")
			{
				$sql = "UPDATE tim SET sponzor = 'Puma' WHERE id='$tim_id'";
				$conn->query($sql);
				$budzet=$budzet+1000;
				$sql = "UPDATE tim SET balance='$budzet' WHERE id='$tim_id'";
				$conn->query($sql);
			}
			echo "<script>
			alert('Success!');
			window.location.href='/HIGH5/High5_profile/High5_profile.php';
			</script>";
		}
		else
		{
			$message = "You already have a sponsor!";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='/HIGH5/High5_profile/High5_profile.php';</script>";
		}
	}
	else
{
	$message = "REQUEST_METHOD != POST";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>