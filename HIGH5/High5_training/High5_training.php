
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Training</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">

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
		  <li class="active"><a href="../High5_training/High5_training.php">Training</a></li>
		  <li><a href="../High5_transfers/High5_transfers.php">Transfers</a></li> 
		  <li><a href="../High5_arena/High5_arena.php">Arena</a></li>
		  <li><a href="../High5_profile/High5_profile.php">Profile</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		  <li class="help-tip">
				<p>This is the training center. It allows you to improve your players stats through training at the expense of lowering their current stamina. Different training regimes cost a different amount of stamina to execute.</p>
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
	?>
	<div class="tab">
	<form action='train.php' method='post'>
	<table class="table-fill">
		<thead>
			<tr>
				<th class="text-center">Num</th>
				<th class="text-name">Name</th>
				<th class="text-center">Age</th>
				<th class="text-center">Pos</th>
				<th class="text-center">Stam</th>
				<th class="text-center">Mor</th>
				<th class="text-center">Hgt</th>
				<th class="text-center">Spd</th>
				<th class="text-center">Agg</th>
				<th class="text-center">Pt2</th>
				<th class="text-center">Pt3</th>
				<th class="text-center">Pt1</th>
				<th class="text-center">OR</th>
				<th class="text-center">DR</th>
				<th class="text-center">Ast</th>
				<th class="text-center">Drib</th>
				<th class="text-center">Block</th>
				<th class="text-center">Steal</th>
				<th class="text-center">Int</th>
				<th class="text-center">Avg</th>
				<th class="text-progress">Next level</th>
				<th class="text-sell" style="padding-bottom:2px"> Check all &nbsp <input class="checkboxall" type="checkbox" id="checkall" name="checkall" value="Check all"></th>
			</tr>
		</thead>
		<tbody class="table-hover">
<?php
		

		$username = $_SESSION['username'];
		$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$tim_id = (int)$row['tim_id'];
		$result->close();	
		
		$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' ORDER BY broj_na_dresu";
		$result = $conn->query($sql);
		if ($result)
		{
			$niz = array();
			while ($row = $result->fetch_assoc())
			{
				$id = $row['id'];
				$niz[$id]['broj_na_dresu'] = $row['broj_na_dresu'];
				$niz[$id]['ime'] = $row['ime'];
				$niz[$id]['prezime'] = $row['prezime'];
				$niz[$id]['starost'] = $row['starost'];
				$niz[$id]['stamina'] = $row['stamina'];
				$niz[$id]['moral'] = $row['moral'];
				$niz[$id]['visina'] = $row['visina'];
				$niz[$id]['pozicija'] = $row['pozicija'];
				$niz[$id]['brzina'] = $row['brzina'];
				$niz[$id]['agresivnost'] = $row['agresivnost'];
				$niz[$id]['sut_za_2'] = $row['sut_za_2'];
				$niz[$id]['sut_za_3'] = $row['sut_za_3'];
				$niz[$id]['sut_za_slobodna'] = $row['sut_za_slobodna'];
				$niz[$id]['skok_u_napadu'] = $row['skok_u_napadu'];
				$niz[$id]['asistencija'] = $row['asistencija'];
				$niz[$id]['dribling'] = $row['dribling'];
				$niz[$id]['skok_u_odbrani'] = $row['skok_u_odbrani'];
				$niz[$id]['blokada'] = $row['blokada'];
				$niz[$id]['presecen_pas'] = $row['presecen_pas'];
				$niz[$id]['ukradena_lopta'] = $row['ukradena_lopta'];
				$niz[$id]['next_level'] = $row['next_level'];
				$niz[$id]['cost'] = $row['cost'];
				$avg = ($niz[$id]['brzina'] + $niz[$id]['agresivnost'] + 
				$niz[$id]['sut_za_2'] + $niz[$id]['sut_za_3'] + 
				$niz[$id]['sut_za_slobodna'] + $niz[$id]['skok_u_napadu'] + 
				$niz[$id]['asistencija'] + $niz[$id]['dribling'] + 
				$niz[$id]['skok_u_odbrani'] + $niz[$id]['blokada'] + 
				$niz[$id]['presecen_pas'] + $niz[$id]['ukradena_lopta']) / 12;
				$avg2 = number_format($avg, 2);
				
				print("<tr>");
						print("<td class='text-center'>"); print($niz[$id]["broj_na_dresu"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["ime"]); print(" "); print($niz[$id]["prezime"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["starost"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["pozicija"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["stamina"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["moral"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["visina"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["brzina"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["agresivnost"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["sut_za_2"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["sut_za_3"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["sut_za_slobodna"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["skok_u_napadu"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["skok_u_odbrani"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["asistencija"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["dribling"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["blokada"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["ukradena_lopta"]); print("</td>");
						print("<td class='text-center'>"); print($niz[$id]["presecen_pas"]); print("</td>");
						print("<td class='text-center'>"); print($avg2); print("</td>");
						print("<td class='progress'>");
								print("<div class='progress-bar' role='progressbar' aria-valuenow='" . $niz[$id]['next_level'] . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $niz[$id]['next_level'] . "%'>");
								print(number_format($niz[$id]["next_level"], 0));
								print("%</div>");
						print("</td>");
						print("<td class='text-center'>");
							print("<input class='checkbox1' type='checkbox' name='" . $id . "' value='Player2'>");
						print("</td>");
				print("</tr>");
			}
		}
?>
		</tbody>
	</table>
	<div class="myDiv3">
		<label class="tac"> Trainings: &nbsp&nbsp </label>
		<select name='tr_dif'>
		<?php
		  $tr = $_SESSION['vrstatreninga'];
		  if( $tr == 1 ){
			 print("<option value='1' selected>Stretching (Easy)</option>");
		  }
		  else{
			 print("<option value='1'>Stretching (Easy)</option>"); 
		  }
		  if( $tr == 2 ){
			  print("<option value='2' selected>Cardio (Medium)</option>");
		  }
		  else{
			  print("<option value='2'>Cardio (Medium)</option>");
		  }
		  if( $tr == 3 ){
			  print("<option value='3' selected>Match (Hard)</option>");
		  }
		  else{
			  print("<option value='3'>Match (Hard)</option>");
		  }	  
		?>
		</select>
	</div>
	<div style="clear:right;"></div>
	<div class="myDiv4" align="right">
		<input type='submit' name='trainBtn' class="enjoy-css-button" value='Train'/>
	</div>
	</form>
	<div style="clear:both;"></div>
	<div class="myDiv2" align="left">
	Num - Number &nbsp&nbsp&nbsp| 
	&nbsp&nbsp&nbsp Pos - Position &nbsp&nbsp&nbsp |
	&nbsp&nbsp&nbsp Stam - Stamina &nbsp&nbsp&nbsp |
	&nbsp&nbsp&nbsp Agg - Aggressivness
	<br>
	Pt2 - Two point shoot &nbsp&nbsp&nbsp|
	&nbsp&nbsp&nbsp Pt3 - Three point shoot &nbsp&nbsp&nbsp |
	&nbsp&nbsp&nbsp Pt1 - Free throw shoot
	<br>
	OR - Offensive Rebound &nbsp&nbsp&nbsp|
	&nbsp&nbsp&nbsp DR - Defensive Rebound &nbsp&nbsp&nbsp |
	&nbsp&nbsp&nbsp Ast - Assist
	<br>
	Drib - Dribbling &nbsp&nbsp&nbsp|
	&nbsp&nbsp&nbsp Avg - Average rating &nbsp&nbsp&nbsp |
	&nbsp&nbsp&nbsp Int - Intercepted pass
	<br>
	Mor - Moral &nbsp&nbsp&nbsp|
	&nbsp&nbsp&nbsp Hgt - Height &nbsp&nbsp&nbsp |
	&nbsp&nbsp&nbsp Spd - Speed
	</div>
	
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/checkall.js"></script>
	</body>
</html>