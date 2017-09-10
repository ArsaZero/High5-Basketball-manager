<?php
require_once 'config.php';

session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
      // username and password sent from form 
      
		$myusername = $_POST['username'];
		$mypassword = $_POST['password'];

		$sql = "SELECT id,username,password FROM korisnik WHERE username = '$myusername' and password = '$mypassword'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($result->num_rows == 1 && $row["username"]===$myusername && $row["password"]===$mypassword) 
		{
			$_SESSION['username'] = $myusername;
			header('location: /HIGH5/High5_home/High5_home.php');
		}	
		else
		{
			echo "<script>
				alert('Wrong username or password!');
				window.location.href='/HIGH5/High5_login/High5_login.php';
				</script>";
		}
		$conn->close();

	}
?>