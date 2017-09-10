<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
	$n = $_POST['n'];
	$m = 0;
	$c = 0;
	$i = 0;
	while ($i < $n)
	{
		if (isset($_POST[$i])) 
		{
			$id = $_POST[$i . "i"];
			$cor = $_POST[$i . "c"];
			$ns = $_POST[$i . "n"];
			$tim_id = $_POST[$i . "t"];
			
			$sql = "SELECT contract_length FROM igrac WHERE id = '$id'";
			$result = $conn->query($sql);
			if(!empty($result))
			{
				$row = $result->fetch_assoc();
				$cl = $row['contract_length'];
				$result->close();
				
				if ($cl < 4)
				{
					$sql = "SELECT balance FROM tim WHERE id = '$tim_id'";
					$result = $conn->query($sql);
					if ($result)
					{
						$row = $result->fetch_assoc();
						$result->close();
						$balance = $row['balance'];
						
						if ($balance > $cor)
						{
							$sql = "UPDATE igrac SET salary = '$ns', contract_length = '4' WHERE id='$id'";
							$result1 = $conn->query($sql);

							$balance -= $cor;
							$sql = "UPDATE tim SET balance = '$balance' WHERE id = '$tim_id'";
							$result2 = $conn->query($sql);
						}	
						else
						{
							$m=1;
						}
					}
				}
				else
				{
					$c=1;
				}
			}
			else
			{
				echo "QUERY FAILED";
			}
		}
		$i++;
	}
	if ($m == 1)
	{
		$message = "You do not have enough money!";
		echo "<script type='text/javascript'>alert('$message');
		window.location.href='/HIGH5/High5_profile/High5_profile.php';</script>";
	}
	else if ($c == 1)
	{
		$message = "You cannot extend this players contract further!";
		echo "<script type='text/javascript'>alert('$message');
		window.location.href='/HIGH5/High5_profile/High5_profile.php';</script>";
	}
	else
	{
		$message = "Success!";
		echo "<script type='text/javascript'>alert('$message');
		window.location.href='/HIGH5/High5_profile/High5_profile.php';</script>";
	}
}

?>