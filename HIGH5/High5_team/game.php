<?php

require_once 'config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$message = "Good Luck!";
		echo "<script type='text/javascript'>alert('$message');
		window.location.href='/HIGH5/high5_game/High5_game.php';
		</script>";
		
	}
	else
	{
		$message = "REQUEST_METHOD not equal POST";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}


?>