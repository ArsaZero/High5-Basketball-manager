<?php 
$conn = new mysqli("localhost", "root", "", "High5");

if ($conn->connect_errno)
{
	print ("Connection error (" . $conn->connect_errno . "): $conn->connect_error");
}
else
{
	$godina = 2016;
	$mesec = 07;
	$dan = 04;
	$sat = 12;
	$dt = $godina . "-" . $mesec . "-" . $dan . " " . $sat . ":00:00.000";
	echo $dt;
	for($i =1; $i<20; $i++)
	{
		$res = $conn->query("SELECT * from utakmica WHERE br_kola = $i");
		while ($row = $res->fetch_assoc())
		{
			$id = $row['id'];
			$dt = $godina . "-" . $mesec . "-" . $dan . " " . $sat . ":00:00.000";
			$conn->query("UPDATE utakmica SET datum_i_vreme = '$dt' WHERE id = '$id'");
			$sat++;
		}
		$dan++;
		$sat = 12;
	}
}
?>