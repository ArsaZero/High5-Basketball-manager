<?php
require_once 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (isset($_POST['style']))
	{
		$username = $_SESSION['username'];
		$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$tim_id = (int)$row['tim_id'];
		$result->close();
		
		$s = $_POST['sel'];
		$sql = "UPDATE tim SET stil = '$s' WHERE id = '$tim_id'";
		$result = $conn->query($sql);
		echo "<script>
			alert('Success!');
			window.location.href='/HIGH5/High5_subs/High5_subs.php';
			</script>";
	}
}

?>