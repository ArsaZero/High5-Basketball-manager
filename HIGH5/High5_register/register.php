<?php
require_once 'config.php';

session_start();

	 function GetImageExtension($imagetype)
     {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }
     }
	 
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (!empty($_FILES["file-1"]["name"]))
		{
      // username and password sent from form 
      
			$myusername = $_POST['username'];
			$mypassword = $_POST['password'];
			$myconfirmpassword = $_POST['confirmpassword'];
			$myteamname = $_POST['teamname'];
			$myarenaname = $_POST['arenaname'];
			
			$file_name=$_FILES["file-1"]["name"];
			$temp_name=$_FILES["file-1"]["tmp_name"];
			$imgtype=$_FILES["file-1"]["type"];
			$ext= GetImageExtension($imgtype);
			$imagename=date("d-m-Y")."-".time().$ext;
			$target_path = "images/".$imagename;


			
			$sql = "SELECT id,username,password FROM korisnik WHERE username = '$myusername'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			if ($result->num_rows == 0)
			{
				$sql = "SELECT * FROM arena WHERE naziv = '$myarenaname'";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				if ($result->num_rows == 0)
				{
					if(move_uploaded_file($temp_name, $target_path))
					{
						if(!empty($_POST['password']))
						{
							if(!empty($_POST['username']))
							{
								if(!empty($_POST['teamname']))
								{
									if(!empty($_POST['arenaname']))
									{
										if($mypassword===$myconfirmpassword)
										{
											$sql = "INSERT INTO arena (naziv, seatsLvl, snacksLvl, parkingLvl, drinksLvl, seats, snacks, parking, drinks, cena_karte)
													VALUES ('$myarenaname', '1', '1', '1', '1', '100', '50', '100', '50', '3')";
											$result = $conn->query($sql);
											


											$sql = "SELECT id FROM arena WHERE naziv = '$myarenaname'";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											$id = (int)$row['id'];
											
											$sql = "INSERT INTO tim (naziv, pozicija, br_odigranih, pobede, porazi, kos_kolicnik, br_bodova, forma, 
													logo, balance, br_osvojenih_titula, stil, arena_id) VALUES ('$myteamname', '0', '0', '0', '0', '0', '0', '', 
													'$target_path', '50000', '0', 'Normal', '$id')";
											$result = $conn->query($sql);
											
											$sql = "SELECT id FROM tim WHERE arena_id = '$id'";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											$idTim = (int)$row['id'];
											$result->close();
											
											$sql ="UPDATE tim SET pozicija=$idTim WHERE id=$idTim";
											$conn->query($sql);
											
											$sql = "SELECT id FROM tim WHERE arena_id = '$id'";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											$idTim = (int)$row['id'];
											$result->close();
											
											
											$sql = "INSERT INTO korisnik (username, password, tim_id)
													VALUES ('$myusername', '$mypassword', '$idTim')";
											$result = $conn->query($sql);
											
											
											$sql = "SELECT id FROM igrac WHERE pozicija = 'PG' AND tim_id IS NULL ORDER BY RAND() LIMIT 2";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											$id1 = (int)$row['id'];
											$row = $result->fetch_assoc();
											$id2 = (int)$row['id'];
											$result->close();
											$sql = "UPDATE igrac SET broj_na_dresu = '4', tim_id = '$idTim', aktivan = '1' WHERE id='$id1'";
											$result = $conn->query($sql);
											$sql = "UPDATE igrac SET broj_na_dresu = '5', tim_id = '$idTim' WHERE id='$id2'";
											$result = $conn->query($sql);
											/////
											$sql = "SELECT id FROM igrac WHERE pozicija = 'G' AND tim_id IS NULL ORDER BY RAND() LIMIT 2";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											$id1 = (int)$row['id'];
											$row = $result->fetch_assoc();
											$id2 = (int)$row['id'];
											$result->close();
											$sql = "UPDATE igrac SET broj_na_dresu = '6', tim_id = '$idTim', aktivan = '2' WHERE id='$id1'";
											$result = $conn->query($sql);
											$sql = "UPDATE igrac SET broj_na_dresu = '7', tim_id = '$idTim' WHERE id='$id2'";
											$result = $conn->query($sql);
											/////
											$sql = "SELECT id FROM igrac WHERE pozicija = 'F' AND tim_id IS NULL ORDER BY RAND() LIMIT 2";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											$id1 = (int)$row['id'];
											$row = $result->fetch_assoc();
											$id2 = (int)$row['id'];
											$result->close();
											$sql = "UPDATE igrac SET broj_na_dresu = '8', tim_id = '$idTim', aktivan = '3' WHERE id='$id1'";
											$result = $conn->query($sql);
											$sql = "UPDATE igrac SET broj_na_dresu = '9', tim_id = '$idTim' WHERE id='$id2'";
											$result = $conn->query($sql);
											/////
											$sql = "SELECT id FROM igrac WHERE pozicija = 'PF' AND tim_id IS NULL ORDER BY RAND() LIMIT 2";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											$id1 = (int)$row['id'];
											$row = $result->fetch_assoc();
											$id2 = (int)$row['id'];
											$result->close();
											$sql = "UPDATE igrac SET broj_na_dresu = '10', tim_id = '$idTim', aktivan = '4' WHERE id='$id1'";
											$result = $conn->query($sql);
											$sql = "UPDATE igrac SET broj_na_dresu = '11', tim_id = '$idTim' WHERE id='$id2'";
											$result = $conn->query($sql);
											/////
											$sql = "SELECT id FROM igrac WHERE pozicija = 'C' AND tim_id IS NULL ORDER BY RAND() LIMIT 2";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											$id1 = (int)$row['id'];
											$row = $result->fetch_assoc();
											$id2 = (int)$row['id'];
											$result->close();
											$sql = "UPDATE igrac SET broj_na_dresu = '12', tim_id = '$idTim', aktivan = '5' WHERE id='$id1'";
											$result = $conn->query($sql);
											$sql = "UPDATE igrac SET broj_na_dresu = '13', tim_id = '$idTim' WHERE id='$id2'";
											$result = $conn->query($sql);
											/////
											$sql = "SELECT id FROM igrac WHERE tim_id IS NULL ORDER BY RAND() LIMIT 2";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											$id1 = (int)$row['id'];
											$row = $result->fetch_assoc();
											$id2 = (int)$row['id'];
											/*echo "<script>
											alert('$id1, $id2');
											window.location.href='/HIGH5/High5_login/High5_login.php';
											</script>";*/
											$result->close();
											$sql = "UPDATE igrac SET broj_na_dresu = '14', tim_id = '$idTim' WHERE id='$id1'";
											$result = $conn->query($sql);
											$sql = "UPDATE igrac SET broj_na_dresu = '15', tim_id = '$idTim' WHERE id='$id2'";
											$result = $conn->query($sql);
											
											echo "<script>
											alert('Success!');
											window.location.href='/HIGH5/High5_login/High5_login.php';
											</script>";
											//header('location: /HIGH5/high5_login/High5_login.php');
										}
										else 
										{  
											$message = "Passwords do not match!";
											echo "<script type='text/javascript'>alert('$message');
											window.location.href='/HIGH5/High5_register/High5_register.php';</script>";
										}
									}
									elseif(empty($_POST['arenaname']))
									{
										$message = "Arena name field is mandatory!";
										echo "<script type='text/javascript'>alert('$message');
										window.location.href='/HIGH5/High5_register/High5_register.php';</script>";	
									}
								}
								elseif(empty($_POST['teamname']))
								{
									$message = "Team name field is mandatory!";
									echo "<script type='text/javascript'>alert('$message');
									window.location.href='http://localhost/HIGH5/High5_register/High5_register.php';</script>";	
								}
							}
							elseif(empty($_POST['username']))
							{
								$message = "Username field is mandatory!";
								echo "<script type='text/javascript'>alert('$message');
								window.location.href='http://localhost/HIGH5/High5_register/High5_register.php';</script>";						
							}
						}
						elseif(empty($_POST['password']))
						{
							$message = "Password field is mandatory!";
							echo "<script type='text/javascript'>alert('$message');
							window.location.href='http://localhost/HIGH5/High5_register/High5_register.php';</script>";						
						}
					}
					else
					{
						$message = "Error while uploading image to the server!";
						echo "<script type='text/javascript'>alert('$message');
						window.location.href='http://localhost/HIGH5/High5_register/High5_register.php';</script>";
					}
				}
				else
				{
					$message = "Already existing arena name!";
					echo "<script type='text/javascript'>alert('$message');
					window.location.href='http://localhost/HIGH5/High5_register/High5_register.php';</script>";					
				}				
				
			}
			else 
			{
				  $message = "Already existing username!";
				  echo "<script type='text/javascript'>alert('$message');
				  window.location.href='http://localhost/HIGH5/High5_register/High5_register.php';</script>";
			}
			$conn->close();
		}
		else
		{
			$message = "You must choose your emblem from files!";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='http://localhost/HIGH5/High5_register/High5_register.php';</script>";
		}
	}
	else
	{
		$message = "REQUEST_METHOD not equal POST";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
?>