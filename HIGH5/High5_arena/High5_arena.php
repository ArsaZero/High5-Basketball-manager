<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Arena</title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="images/logo2.jpg" width="46" height="46" class="img-circle">
    </div>
    <ul class="nav navbar-nav">
      <li><a href="../High5_home/High5_home.php">Home</a></li>
      <li><a href="../High5_team/High5_team.php">Team</a></li>
      <li><a href="../High5_league/High5_league.php">League</a></li> 
      <li><a href="../High5_training/High5_training.php">Training</a></li>
      <li><a href="../High5_transfers/High5_transfers.php">Transfers</a></li> 
      <li class="active"><a href="../High5_arena/High5_arena.php">Arena</a></li>
      <li><a href="../High5_profile/High5_profile.php">Profile</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="help-tip">
      		<p>This is the arena tab. Here you can use your funds to upgrade your teams home which will in turn make you more money when playing home games.</p>
      </li>
      
      <!--<li><a href="#"><span class="glyphicon glyphicon-volume-up"></span> </a></li>-->
      <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>    
	</ul>
  </div>
</nav>



<?php
	require_once 'config.php';
	session_start();
	

	////////NAVBAR2////////
	
	$myusername = $_SESSION['username'];
	
	$sql="SELECT id,tim_id FROM korisnik WHERE username = '$myusername'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$id = (int)$row['tim_id'];
	
	$user_team_id = $id;
	
	//$sql = "SELECT tr_kolo FROM liga";
	//$result = $conn->query($sql);
	//$row = $result->fetch_assoc();
	//$broj_trenutnog_kola = (int)$row['tr_kolo'];
	
		//ucitavanje utakmice
	$sql = "SELECT * FROM utakmica WHERE (status IS NULL OR status = 'A') AND (prvi_tim_id = '$user_team_id' OR drugi_tim_id = '$user_team_id') ORDER BY br_kola ASC";
	$result = $conn->query($sql);
	
	if (!$result)
	{
		print("<nav class='navbar navbar-inverse'>");
		print("<div class='row'>");
		
			print("<div class='col-sm-2'>");
				print("<p class='center-block1'>"); print("Time"); print("</p>");
			print("</div>");
		
			print("<div class='col-sm-2'>");
				print("<img class='center-block img-circle' src='logo2.jpg' width='50' height='50' style='padding:3px'>");
			print("</div>");
			
			print("<div class='col-sm-1'>");
				print("<p class='center-block1'>"); print("Team1"); print("</p>");
			print("</div>");
			
			print("<div class='col-sm-2'>");
				print("<p class='center-block1'>"); print(":"); print("</p>");
			print("</div>");
			
			print("<div class='col-sm-1'>");
				print("<p class='center-block1'>"); print("Team2"); print("</p>");
			print("</div>");
			
			print("<div class='col-sm-2'>");
				print("<img class='center-block img-circle' src='logo2.jpg' width='50' height='50' style='padding:3px'>");
			print("</div>");
			
			print("<div class='col-sm-2'>");
				print("<p class='center-block1'>"); print("Arena"); print("</p>");
			print("</div>");
		print("</div>");
	print("</nav>");
	}
	else
	{
		$row = $result->fetch_assoc();
		$tim1_id = $row['prvi_tim_id'];
		$tim2_id = $row['drugi_tim_id'];
		$vreme_odigravanja = (string)$row['datum_i_vreme'];
		$status = $row['status'];
		
			//ucitava se naziv i logo domaceg tima
		$sql = "SELECT naziv,arena_id,logo FROM tim WHERE id = '$tim1_id' ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$result->close();
		$tim1_naziv = $row['naziv'];
		$arena_id = $row['arena_id'];
		$tim1_logo = $row['logo'];
		
			//ucitavanje naziva arene domaceg tima
		$sql = "SELECT naziv FROM arena WHERE id = '$arena_id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$arena_naziv = $row['naziv'];
			
			//ucitavanje naziva i logo gostujuceg tima
		$sql = "SELECT naziv,logo FROM tim WHERE id = '$tim2_id' ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$result->close();
		$tim2_naziv = $row['naziv'];
		$tim2_logo = $row['logo'];
		print("<form action='game.php' method='post'>");
		print("<nav class='navbar navbar-inverse'>");
			print("<div class='row'>");
			
				print("<div class='col-sm-2'>");
					print("<p class='center-block1'>"); print($vreme_odigravanja); print("</p>");
				print("</div>");
			
				print("<div class='col-sm-2'>");
					print("<img class='center-block img-circle' src='../High5_register/" . $tim1_logo . "' width='50' height='50' style='padding:3px'>");
				print("</div>");
				
				print("<div class='col-sm-1'>");
					print("<p class='center-block1'>"); print($tim1_naziv); print("</p>");
				print("</div>");
				
				
				
				if($status == 'A')
				{
					print("<div class='col-sm-2'>");
						print("<input type='submit' name='trainBtn' class='enjoy-css-button' value='Live Game'/>");
					print("</div>");
				}
				else
				{
					print("<div class='col-sm-2'>");
						print("<p class='center-block1'>"); print(":"); print("</p>");
					print("</div>");
				}
				print("<div class='col-sm-1'>");
					print("<p class='center-block1'>"); print($tim2_naziv); print("</p>");
				print("</div>");
				
				print("<div class='col-sm-2'>");
					print("<img class='center-block img-circle' src='../High5_register/" . $tim2_logo . "' width='50' height='50' style='padding:3px'>");
				print("</div>");
				
				print("<div class='col-sm-2'>");
					print("<p class='center-block1'>"); print($arena_naziv); print("</p>");
				print("</div>");
			print("</div>");
		print("</nav>");
		print("</form>");
	}
	
	
	$sql="SELECT balance FROM tim WHERE id = '$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$budzet = (int)$row['balance'];
	
	$sql = "SELECT arena_id FROM tim WHERE id = $id";
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
	$se1=$se*2;
	$sn1=$sn*2;
	$pa1=$pa*2;
	$dr1=$dr*2;
	$cose=$se*3*10;
	$cosn=$sn*8;
	$copa=$pa*8;
	$codr=$dr*8;
	$ce1=3;
	$ce2=4;
	$ce3=5;
	$ce4=6;
	$niz = array();
	
	$niz[1] = $ce1;
	$niz[2] = $ce2;
	$niz[3] = $ce3;
	$niz[4] = $ce4;
	
	$sel=1;
	
	$i = 0;
	if($ce2==$ce)
	{
		$sel=2;
	}
	if($ce3==$ce)
	{
		$sel=3;
	}
	if($ce4==$ce)
	{
		$sel=4;
	}
	
	
print
"<form id='form' action='arena.php' method='post' role='form'>
	<div class='table-responsive'>
	  <table class='table  table-condensed table-bordered'>
		<thead>
		  <tr>
			<th id='naziv' colspan='5'>$naziv</th>
		  </tr>
		</thead>
		<thead>
		  <tr>
			<th>Name</th>
			<th>Level</th>
			<th>Description</th>
			<th>Cost</th>
			<th></th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td>Seats</td>
			<td>$seats</td>
			<td>$se seats,upgrade to $se1</td>
			<td>$cose $</td>
			<td><input name='seats' type='submit' style='color:black' value='Upgrade' onclick=\"return confirm('Are you sure you want to upgrade seats?')\";></td>
		  </tr>
		   <tr>
			<td>Snacks</td>
			<td>$snacks</td>
			<td>$sn dollars per home game,upgrade to $sn1 dollars</td>
			<td>$cosn $</td>
		   <td><input name='snacks' type='submit' style='color:black' value='Upgrade' onclick=\"return confirm('Are you sure you want to upgrade snacks?')\";></td>
		  </tr>
		   <tr>
			<td>Parking</td>
			<td>$parking</td>
			<td>$pa dollars per home game,upgrade to $pa1 dollars</td>
			<td>$copa $</td>
			<td><input name='parking' type='submit' style='color:black' value='Upgrade' onclick=\"return confirm('Are you sure you want to upgrade parking?')\";></td>
		  </tr>
		   <tr>
			<td>Drinks</td>
			<td>$drinks</td>
			<td>$dr dollars per home game,upgrade to $dr1 dollars</td>
			<td>$codr $</td>
			<td><input type='submit' name='drinks' style='color:black' value='Upgrade' onclick=\"return confirm('Are you sure you want to upgrade drinks?')\";></td>
		  </tr>
		</tbody>
	  </table>
	  </div>
	  
	  <div class='row'>
	  <div class='col-sm-4'></div>
	  <div class='col-sm-4'><div class='table-responsive' max-width='100px'>
		  <table class='table table-condensed table-bordered'>
			<tr>
				<th class='thclass1'>Ticket price</th>
				<th>
				<select name='cena' style='color:black'>";
					for ($i = 1; $i < 5; $i++)
					{
						if ($sel === $i)
						{
							print ("<option value='$niz[$i]' selected='selected'>"); print ("$niz[$i]"); print("</option>");
						}
						else 
						{
							print ("<option value='$niz[$i]'>"); print ("$niz[$i]"); print("</option>");
						}
					}
				print "</select>
				<input type='submit' class='dugmecena' name='cena_karte' style='color:black' value='Update'></input>
				</th>
			</tr>
			<tr>
				<th class='thclass'>Current Balance</th>
				<th class='thclass'>$budzet $</th>
			</tr>
		  </table>
	  </div></div>
	  <div class='col-sm-4'></div>
	  </div>
	  </form>";   
	  
	  
?>

</body>
</html>
