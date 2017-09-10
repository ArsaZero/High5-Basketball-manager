<?php
require_once('config.php');

while(true)
{
	$conn->query("UPDATE igrac 
				  SET stamina = stamina + 1 
                  WHERE tim_id IS NOT NULL AND stamina < 100");
	sleep(1200);
}
?>