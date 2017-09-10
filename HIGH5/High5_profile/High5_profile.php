<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profile</title>

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
      <li><a href="../High5_training/High5_training.php">Training</a></li>
      <li><a href="../High5_transfers/High5_transfers.php">Transfers</a></li> 
      <li><a href="../High5_arena/High5_arena.php">Arena</a></li>
      <li class="active"><a href="../High5_profile/High5_profile.php">Profile</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="help-tip">
      		<p>This is the profile tab. Here you can see your stats, renew your players' contracts, change your password and pick a sponsor.</p>
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

<div class="myDiv">
	<div class="table-responsive t1">          
	  <table class="table-condensed table-bordered">
		<thead>
			<tr> <th colspan="2"> Profile </th> </tr>
		</thead>
		<tbody>
		<?php
			$username = $_SESSION['username'];
			
			$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$tim_id = (int)$row['tim_id'];
			$result->close();
			
			////// za Average
			$teamAvg = 0;
			$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$tim_id = (int)$row['tim_id'];
			$result->close();
			$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id'";
			$result = $conn->query($sql);
			
			$niz = array();
			
			if ($result)
			{
				while ($row = $result->fetch_assoc())
				{
					$id = $row['id'];
					$niz[$id]['salary'] = $row['salary'];
					$niz[$id]['contract_length'] = $row['contract_length'];
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
					$teamAvg += $avg2;
					if ($avg2 < 63)
					{
						if ($niz[$id]['starost'] < 23)
						{
							$niz[$id]['new_salary'] = $niz[$id]['salary'] * 1.15;
							$niz[$id]['cost_of_renewal'] = $niz[$id]['new_salary'] * 1.3;
						}
						else if ($niz[$id]['starost'] < 29)
						{
							$niz[$id]['new_salary'] = $niz[$id]['salary'] * 1.05;
							$niz[$id]['cost_of_renewal'] = $niz[$id]['new_salary'] * 1.2;
						}
						else
						{
							$niz[$id]['new_salary'] = $niz[$id]['salary'] * 0.9;
							$niz[$id]['cost_of_renewal'] = $niz[$id]['new_salary'] * 1.1;
						}
					}
					else if ($avg2 < 73)
					{
						if ($niz[$id]['starost'] < 23)
						{
							$niz[$id]['new_salary'] = $niz[$id]['salary'] * 1.2;
							$niz[$id]['cost_of_renewal'] = $niz[$id]['new_salary'] * 1.4;
						}
						else if ($niz[$id]['starost'] < 29)
						{
							$niz[$id]['new_salary'] = $niz[$id]['salary'] * 1.10;
							$niz[$id]['cost_of_renewal'] = $niz[$id]['new_salary'] * 1.3;
						}
						else
						{
							$niz[$id]['new_salary'] = $niz[$id]['salary'] * 0.95;
							$niz[$id]['cost_of_renewal'] = $niz[$id]['new_salary'] * 1.2;
						}
					}
					else
					{
						if ($niz[$id]['starost'] < 23)
						{
							$niz[$id]['new_salary'] = $niz[$id]['salary'] * 1.25;
							$niz[$id]['cost_of_renewal'] = $niz[$id]['new_salary'] * 1.5;
						}
						else if ($niz[$id]['starost'] < 29)
						{
							$niz[$id]['new_salary'] = $niz[$id]['salary'] * 1.15;
							$niz[$id]['cost_of_renewal'] = $niz[$id]['new_salary'] * 1.4;
						}
						else
						{
							$niz[$id]['new_salary'] = $niz[$id]['salary'];
							$niz[$id]['cost_of_renewal'] = $niz[$id]['new_salary'] * 1.3;
						}
					}
				}
			}
			$result->close();
			//////
			
			$sql = "SELECT * FROM tim WHERE id = '$tim_id'";
			$result = $conn->query($sql);
			if ($result)
			{
				$row = $result->fetch_assoc();
				$tn = $row['naziv'];
				$s = $row['stil'];
				$b = $row['balance'];
				$sp = $row['sponzor'];
				$sql = "SELECT COUNT(*) AS cnt FROM igrac WHERE tim_id = '$tim_id'";
				$result1 = $conn->query($sql);
				$row = $result1->fetch_assoc();
				$num = $row['cnt'];
				$result1->close();
				$apr = number_format($teamAvg / $num, 2);
			
				print("<tr>");
					print("<td class='myTd'>"); print("Username"); print("</td>");
					print("<td class='myTd'>"); print($username); print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td class='myTd'>"); print("Team name"); print("</td>");
					print("<td class='myTd'>"); print($tn); print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td class='myTd'>"); print("Style"); print("</td>");
					print("<td class='myTd'>"); print($s); print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td class='myTd'>"); print("Number of players"); print("</td>");
					print("<td class='myTd'>"); print($num); print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td class='myTd'>"); print("Average player rating"); print("</td>");
					print("<td class='myTd'>"); print($apr); print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td class='myTd'>"); print("Balance"); print("</td>");
					print("<td class='myTd'>"); print($b); print(" $"); print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td class='myTd'>"); print("Sponsor"); print("</td>");
					print("<td class='myTd'>"); print($sp); print("</td>");
				print("</tr>");
			}
		?>
		</tbody>
	  </table>
	</div>
	<form action="renew.php" method="post">
	<div class="table-responsive t2">          
	  <table class="table-bordered">
		<thead>
			<tr> <th colspan="6"> Contract </th> </tr>
		</thead>
		<tbody>
		<tr>
			<th class="myTh">Player name</th>
			<th class="myTh">Salary per season</th>
			<th class="myTh">Contract years left</th>
			<th class="myTh">Cost of renewal</th>
			<th class="myTh">New salary</th>
			<th class="myTh"></th>
		</tr>
		<?php 
		$sql = "SELECT count(*) AS n FROM igrac WHERE tim_id = '$tim_id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$n = $row['n'];
		$result->close();
		
		$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id'";
		$result = $conn->query($sql);
		if ($result)
		{
			$i = 0;
			while ($row = $result->fetch_assoc())
			{
				$id = $row['id'];
				$cor = (int) $niz[$id]['cost_of_renewal'];
				$ns = (int) $niz[$id]['new_salary'];
				print("<tr>");
					print("<td class='myTd'>"); print($niz[$id]['ime']); print(" "); print($niz[$id]['prezime']); print("</td>");
					print("<td class='myTd'>"); print($niz[$id]['salary']); print(" $"); print("</td>");
					print("<td class='myTd'>"); print($niz[$id]['contract_length']); print("</td>");
					print("<td class='myTd'>"); print($cor); print(" $"); print("</td>");
					print("<td class='myTd'>"); print($ns); print(" $"); print("</td>");
					print("<th class='myTd'>");
						print("<input type='hidden' name='n' value='" . $n . "'>");
						print("<input type='hidden' name='" . $i . "i' value='" . $id . "'>");
						print("<input type='hidden' name='" . $i . "t' value='" . $tim_id . "'>");
						print("<input type='hidden' name='" . $i . "c' value='" . $cor . "'>");
						print("<input type='hidden' name='" . $i . "n' value='" . $ns . "'>");
						print ("<input type='submit' name='" . $i . "' class='but' value='Renew' onclick=\"return confirm('Are you sure you want to proceed?')\";>");	
					print("</th>");
				print("</tr>");
				$i++;
			}

		}
		?>
		</tbody>
	  </table>
	</div>
	</form>
</div>
<div style="clear:left	;"></div>
<div class="myD">
<!--<a  data-toggle="modal" href="#myModal1" class="b1"> Change password </a>-->
<button type="button" data-toggle="modal" data-target="#myModal1" class="b1">Change password</button>
<!--<a  data-toggle="modal" href="#myModal2" class="b2"> Pick sponsor </a>-->
<button type="button" data-toggle="modal" data-target="#myModal2" class="b2">Pick sponsor</button>
</div>
<div class="modal fade" id="myModal1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding:15px 30px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Pick your new password</h4>
			</div>
			<div class="modal-body" style="padding:10px 20px;">
				<form role="form" action="changepassword.php" method="post">
									<br>
									<div>
										<input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Old Password">
									</div>
									<br>
									<div>
										<input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="New Password">
									</div>
                                    <br>
									<div class="form-group">
										<input type="password" name="confirmpassword" id="confirnpassword" class="form-control" placeholder="Confirm Password">
									</div>
									<br>
					<input type='submit' name='modalSUB1' value='Confirm'>
				</form>
			</div>
		</div>
	</div>
</div>	
<div class="modal fade" id="myModal2" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding:15px 30px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Pick a sponsor</h4>
			</div>
			<div class="modal-body" style="padding:10px 20px;">
				<form role="form" action="picksponsor.php" method="post">
					<table class='defaulttable' cellspacing="10">
						<tbody>
							<tr>
								<td><label> Nike (gives you 3000$ at the start of the season)</label>
								<td class="desnoModal"><input type="radio" name="sponsor" value="Nike"/></td>
							</tr>
							<tr>
								<td><label> Adidas(gives you 2000$ at the start of the season and 100$ for each win)</label>
								<td class="desnoModal"><input type="radio" name="sponsor" value="Adidas"/></td>
							</tr>
							<tr>
								<td><label> Puma(gives you 1000$ at the start of the season and 140$ for every match) </label>
								<td class="desnoModal"><input type="radio" name="sponsor" value="Puma"/></td>
							</tr>
						<tbody>
					</table>
					<input type='submit' name='modalSUB1' value='Confirm' onclick="return confirm('Are you sure you want to proceed?');">
				</form>
			</div>
		</div>
	</div>
</div>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
