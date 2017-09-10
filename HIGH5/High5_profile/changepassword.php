<?php
require_once 'config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$myusername = $_SESSION['username'];
		$oldpassword = $_POST['oldpassword'];
		$mypassword = $_POST['newpassword'];
		$myconfirmpassword = $_POST['confirmpassword'];
		$sql = "SELECT password FROM korisnik WHERE username = '$myusername'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$op = $row['password'];
		
		if(!empty($_POST['oldpassword']))			
			{
				if($oldpassword == $op)
				{
					if(!empty($_POST['newpassword']))			
					{
						if($mypassword===$myconfirmpassword)
						{
						$sql = "UPDATE korisnik SET password = '$mypassword' WHERE username = '$myusername'";
						$conn->query($sql);
						echo "<script>
						alert('Success!');
						window.location.href='/HIGH5/High5_profile/High5_profile.php';
						</script>";
						}
						else
						{
							$message = "Passwords do not match!";
							echo "<script type='text/javascript'>alert('$message');
							window.location.href='/HIGH5/High5_profile/High5_profile.php';</script>";
						}
					}
					else
					{
						$message = "Password field is mandatory!";
						echo "<script type='text/javascript'>alert('$message');
						window.location.href='/HIGH5/High5_profile/High5_profile.php';</script>";	
					}
				}
				else
				{
					$message = "Old password is not correct";
					echo "<script type='text/javascript'>alert('$message');
					window.location.href='/HIGH5/High5_profile/High5_profile.php';</script>";
				}
			}
		else
			{
				$message = "Old password field is mandatory!";
				echo "<script type='text/javascript'>alert('$message');
				window.location.href='/HIGH5/High5_profile/High5_profile.php';</script>";	
			}
	}
	else
{
	$message = "Fill the blanks first!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>