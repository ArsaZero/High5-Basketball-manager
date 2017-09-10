<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Timeout</title>

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
<!--<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="images/logo2.jpg" width="46" height="46" class="img-circle">
    </div>
	<ul class="nav navbar-nav">
      <li><a href="../High5_home/High5_home.php">Home</a></li>
      <li class="active"><a href="../High5_team/High5_team.php">Team</a></li>
      <li><a href="../High5_league/High5_league.php">League</a></li> 
      <li><a href="../High5_training/High5_training.php">Training</a></li>
      <li><a href="../High5_transfers/High5_transfers.php">Transfers</a></li> 
      <li><a href="../High5_arena/High5_arena.php">Arena</a></li>
      <li><a href="../High5_profile/High5_profile.php">Profile</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="help-tip">
      		<p>This is the main team management tab. Through it you can set up your starting lineup and playstyle as well as sell your players.</p>
      </li>
      
      <li><a href="#"><span class="glyphicon glyphicon-volume-up"></span> </a></li>
      <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>    
	</ul>
  </div>
</nav>-->

 
<?php
/*	require_once 'config.php';
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
	$sql = "SELECT * FROM utakmica WHERE status IS NULL AND (prvi_tim_id = '$user_team_id' OR drugi_tim_id = '$user_team_id') ORDER BY br_kola ASC";
	$result = $conn->query($sql);
	
	if (!$result)
	{*/
	print("<nav class='navbar navbar-inverse' style='height: 67px;'>");
		print("<div class='row'>");
			print("<div class='col-sm-2'>");
			print("</div>");
			print("<div class='col-sm-2'>");
			print("</div>");
			print("<div class='col-sm-1'>");
			print("</div>");
			print("<div class='col-sm-2'>");
				print("<p class='center-block1'>"); print("Timeout"); print("</p>");
			print("</div>");
			print("<div class='col-sm-1'>");
			print("</div>");
			print("<div class='col-sm-2'>");
			print("</div>");
			print("<div class='col-sm-2'>");
			print("</div>");
		print("</div>");
	print("</nav>");
	/*}
	else
	{
		$row = $result->fetch_assoc();
		$tim1_id = $row['prvi_tim_id'];
		$tim2_id = $row['drugi_tim_id'];
		$vreme_odigravanja = (string)$row['datum_i_vreme'];
		
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
				
				print("<div class='col-sm-2'>");
					print("<p class='center-block1'>"); print(":"); print("</p>");
				print("</div>");
				
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
	}*/
?>

<form action="sell_igrac.php" method="post">
<div class="tab" style="margin-top:60px;">
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
			<th class="text-center">Ind</th>
			<th class="text-center">Pts</th>
			<th class="text-center">Avg</th>
			
        </tr>
    </thead>
	<tbody class="table-hover">
<?php
	
	require_once 'config.php';
	session_start();

	
	$username = $_SESSION['username'];
	$teamAvg = 0;
	$average = array();
	$sql = "SELECT tim_id FROM korisnik WHERE username = '$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$tim_id = (int)$row['tim_id'];
	$result->close();
	
	$sql = "SELECT balance FROM tim WHERE id = '$tim_id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$budz = $row['balance'];
	$result->close();
	
	$sql = "SELECT stil FROM tim WHERE id = '$tim_id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$stil = $row['stil'];
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
			$niz[$id]['indeks'] = $row['indeks'];
			$niz[$id]['broj_poena'] = $row['broj_poena'];
			
			$avg = ($niz[$id]['brzina'] + $niz[$id]['agresivnost'] + 
			$niz[$id]['sut_za_2'] + $niz[$id]['sut_za_3'] + 
			$niz[$id]['sut_za_slobodna'] + $niz[$id]['skok_u_napadu'] + 
			$niz[$id]['asistencija'] + $niz[$id]['dribling'] + 
			$niz[$id]['skok_u_odbrani'] + $niz[$id]['blokada'] + 
			$niz[$id]['presecen_pas'] + $niz[$id]['ukradena_lopta']) / 12;
			$avg2 = number_format($avg, 2);
			$average[$id] = $avg2;
			$teamAvg += $avg2;
			
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
					print("<td class='text-center'>"); print($niz[$id]["indeks"]); print("</td>");
					print("<td class='text-center'>"); print($niz[$id]["broj_poena"]); print("</td>");
					print("<td class='text-center'>"); print($avg2); print("</td>");
					/*print("<td class='text-center'>");
						print ("<input type='submit' class='but' id='$id' name='$id' value='Sell' onclick=\"return confirm('Are you sure you want to proceed?')\";>");
					print("</td>");*/
			print("</tr>");
		}
		$result->close();
	}
	
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 1";
	$result = $conn->query($sql);
	$poz1 = array();
	$poz1 = $result->fetch_assoc();
	$result->close();

	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 2";
	$result = $conn->query($sql);
	$poz2 = array();
	$poz2 = $result->fetch_assoc();
	$result->close();
	
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 3";
	$result = $conn->query($sql);
	$poz3 = array();
	$poz3 = $result->fetch_assoc();
	$result->close();
	
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 4";
	$result = $conn->query($sql);
	$poz4 = array();
	$poz4 = $result->fetch_assoc();
	$result->close();
	
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan = 5";
	$result = $conn->query($sql);
	$poz5 = array();
	$poz5 = $result->fetch_assoc();
	$result->close();
	
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan IS NULL AND (pozicija = 'C' OR pozicija = 'PF')";
	$result = $conn->query($sql);
	if ($result)
	{
		$slob5 = array();
		while ($row = $result->fetch_assoc())
		{
			$id = $row['id'];
			$slob5[$id]['broj_na_dresu'] = $row['broj_na_dresu'];
			$slob5[$id]['ime'] = $row['ime'];
			$slob5[$id]['prezime'] = $row['prezime'];
			$slob5[$id]['pozicija'] = $row['pozicija'];
			$slob5[$id]['stamina'] = $row['stamina'];
			$slob5[$id]['moral'] = $row['moral'];
			$slob5[$id]['avg'] = $average[$id];
		}
	}
	else { 	$message = "Greska";
	echo "<script type='text/javascript'>alert('$message');</script>";}
	//$result->close();
	
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan IS NULL AND (pozicija = 'C' OR pozicija = 'PF' OR pozicija = 'F')";
	$result = $conn->query($sql);
	if ($result)
	{
		$slob4 = array();
		while ($row = $result->fetch_assoc())
		{
			$id = $row['id'];
			$slob4[$id]['broj_na_dresu'] = $row['broj_na_dresu'];
			$slob4[$id]['ime'] = $row['ime'];
			$slob4[$id]['prezime'] = $row['prezime'];
			$slob4[$id]['pozicija'] = $row['pozicija'];
			$slob4[$id]['stamina'] = $row['stamina'];
			$slob4[$id]['moral'] = $row['moral'];
			$slob4[$id]['avg'] = $average[$id];
		}
	}
	//$result->close();
	
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan IS NULL AND (pozicija = 'G' OR pozicija = 'PF' OR pozicija = 'F')";
	$result = $conn->query($sql);
	if ($result)
	{
		$slob3 = array();
		while ($row = $result->fetch_assoc())
		{
			$id = $row['id'];
			$slob3[$id]['broj_na_dresu'] = $row['broj_na_dresu'];
			$slob3[$id]['ime'] = $row['ime'];
			$slob3[$id]['prezime'] = $row['prezime'];
			$slob3[$id]['pozicija'] = $row['pozicija'];
			$slob3[$id]['stamina'] = $row['stamina'];
			$slob3[$id]['moral'] = $row['moral'];
			$slob3[$id]['avg'] = $average[$id];
		}
	}
	//$result->close();
	
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan IS NULL AND (pozicija = 'G' OR pozicija = 'PG' OR pozicija = 'F')";
	$result = $conn->query($sql);
	if ($result)
	{
		$slob2 = array();
		while ($row = $result->fetch_assoc())
		{
			$id = $row['id'];
			$slob2[$id]['broj_na_dresu'] = $row['broj_na_dresu'];
			$slob2[$id]['ime'] = $row['ime'];
			$slob2[$id]['prezime'] = $row['prezime'];
			$slob2[$id]['pozicija'] = $row['pozicija'];
			$slob2[$id]['stamina'] = $row['stamina'];
			$slob2[$id]['moral'] = $row['moral'];
			$slob2[$id]['avg'] = $average[$id];
		}
	}
	//$result->close();
	
	$sql = "SELECT * FROM igrac WHERE tim_id = '$tim_id' AND aktivan IS NULL AND (pozicija = 'G' OR pozicija = 'PG')";
	$result = $conn->query($sql);
	if ($result)
	{
		$slob1 = array();
		while ($row = $result->fetch_assoc())
		{
			$id = $row['id'];
			$slob1[$id]['broj_na_dresu'] = $row['broj_na_dresu'];
			$slob1[$id]['ime'] = $row['ime'];
			$slob1[$id]['prezime'] = $row['prezime'];
			$slob1[$id]['pozicija'] = $row['pozicija'];
			$slob1[$id]['stamina'] = $row['stamina'];
			$slob1[$id]['moral'] = $row['moral'];
			$slob1[$id]['avg'] = $average[$id];
		}
	}
	//$result->close();
?>
    
    </tbody>
</table>
</form>
<div class="myDiv">
	<a data-toggle="modal" href="#myModal1" class="round-button1">
	<?php
		print($poz5['broj_na_dresu']);
	?>
	</a>
	<a data-toggle="modal" href="#myModal2" class="round-button2">
	<?php
		print($poz4['broj_na_dresu']);
	?>
	</a>
	<div style="clear:left;"></div>
	<a data-toggle="modal" href="#myModal3" class="round-button3">
	<?php
		print($poz3['broj_na_dresu']);
	?>
	</a>
	<a data-toggle="modal" href="#myModal4" class="round-button4">
	<?php
		print($poz2['broj_na_dresu']);
	?>
	</a>
	<div style="clear:both;"></div>
	<a data-toggle="modal" href="#myModal5" class="round-button5">
	<?php
		print($poz1['broj_na_dresu']);
	?>
	</a>
</div>
</div>
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
<form action="tactics.php" method="post">
<div class="myDiv3">
	<label class="tac"> Style: &nbsp&nbsp </label>
	<select name="sel">
	<?php
		if ($stil === "Defensive")
		{
			print "<option value='Defensive' selected>Defensive</option>";
		}
		else
		{
			print "<option value='Defensive'>Defensive</option>";
		}
		if ($stil === "Offensive")
		{
			print "<option value='Offensive' selected>Offensive</option>";
		}
		else
		{
			print "<option value='Offensive'>Offensive</option>";
		}
		if ($stil === "Normal")
		{
			print "<option value='Normal' selected>Normal</option>";
		}
		else
		{
			print "<option value='Normal'>Normal</option>";
		}
	?>
	</select>
	&nbsp&nbsp
	<input type='submit' class='but1' name='style' value="Confirm">
</div>
</form>

<!--Current balance-->

<!--<div style="clear:both;"></div>
<br>
<div class='row'>
<div class='col-sm-4'></div>
<div class='col-sm-4'>
<table class="nova">
<tbody>
	<tr>
		<td style='font-size: 22px !important; width:250px !important;'>Current balance</td>
		<?php
		print("<td style='font-size: 22px !important; width:250px !important;'>");
		print("$budz");
		print(" $");
		print("</td>");
		?>
	</tr>
</tbody>
</table>
</div>
<div class='col-sm-4'></div>
</div>-->


<!-- Modal1 -->
<div class="modal fade" id="myModal1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding:15px 30px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>Select player for position 5</h3>
			</div>
			<div class="modal-body" style="padding:10px 20px;">
				<form role="form" action="postavi5.php" method="post">
					<table class='defaulttable'>
						<thead>
							<th>Num</th><th>Name</th><th>Position</th><th>Stamina</th><th>Morale</th><th>Average</th><th></th>
						</thead>
						<tbody>
						<?php
							foreach($slob5 as $id=>$free5)
							{
								print("<tr><td>"); print($free5['broj_na_dresu']); print("</td>");
								print("<td>"); print($free5['ime']); print(" "); print($free5['prezime']); print("</td>");
								print("<td>"); print($free5['pozicija']); print("</td>");
								print("<td>"); print($free5['stamina']); print("</td>");
								print("<td>"); print($free5['moral']); print("</td>");
								print("<td>"); print($free5['avg']); print("</td>");
								print("<td><input type='radio' name='mod1' value='$id'></td></tr>");
							}		
						?>
						<tbody>
					</table>
					<br>
					<input class='btn btn-primary btn-block' type='submit' name='modalSUB1' value='Confirm'>
				</form>
			</div>
		</div>
	</div>
</div>	

<!-- Modal2 -->
<div class="modal fade" id="myModal2" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding:15px 30px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>Select player for position 4</h3>
			</div>
			<div class="modal-body" style="padding:10px 20px;">
				<form role="form" action="postavi4.php" method="post">
					<table class='defaulttable'>
						<thead>
							<th>Num</th><th>Name</th><th>Position</th><th>Stamina</th><th>Morale</th><th>Average</th><th></th>
						</thead>
						<tbody>
						<?php
							foreach($slob4 as $id=>$free4)
							{
								print("<tr><td>"); print($free4['broj_na_dresu']); print("</td>");
								print("<td>"); print($free4['ime']); print(" "); print($free4['prezime']); print("</td>");
								print("<td>"); print($free4['pozicija']); print("</td>");
								print("<td>"); print($free4['stamina']); print("</td>");
								print("<td>"); print($free4['moral']); print("</td>");
								print("<td>"); print($free4['avg']); print("</td>");
								print("<td><input type='radio' name='mod2' value='$id'></td></tr>");
							}		
						?>
						<tbody>
					</table>
					<br>
					<input class='btn btn-primary btn-block' type='submit' name='modalSUB2' value='Confirm'>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal3 -->
<div class="modal fade" id="myModal3" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding:15px 30px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>Select player for position 3</h3>
			</div>
			<div class="modal-body" style="padding:10px 20px;">
				<form role="form" action="postavi3.php" method="post">
					<table class='defaulttable'>
						<thead>
							<th>Num</th><th>Name</th><th>Position</th><th>Stamina</th><th>Morale</th><th>Average</th><th></th>
						</thead>
						<tbody>
						<?php
							foreach($slob3 as $id=>$free3)
							{
								print("<tr><td>"); print($free3['broj_na_dresu']); print("</td>");
								print("<td>"); print($free3['ime']); print(" "); print($free3['prezime']); print("</td>");
								print("<td>"); print($free3['pozicija']); print("</td>");
								print("<td>"); print($free3['stamina']); print("</td>");
								print("<td>"); print($free3['moral']); print("</td>");
								print("<td>"); print($free3['avg']); print("</td>");
								print("<td><input type='radio' name='mod3' value='$id'></td></tr>");								
							}		
						?>
						<tbody>
					</table>
					<br>
					<input class='btn btn-primary btn-block' type='submit' name='modalSUB3' value='Confirm'>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal4 -->
<div class="modal fade" id="myModal4" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding:15px 30px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>Select player for position 2</h3>
			</div>
			<div class="modal-body" style="padding:10px 20px;">
				<form role="form" action="postavi2.php" method="post">
					<table class='defaulttable'>
						<thead>
							<th>Num</th><th>Name</th><th>Position</th><th>Stamina</th><th>Morale</th><th>Average</th><th></th>
						</thead>
						<tbody>
						<?php
							foreach($slob2 as $id=>$free2)
							{
								print("<tr><td>"); print($free2['broj_na_dresu']); print("</td>");
								print("<td>"); print($free2['ime']); print(" "); print($free2['prezime']); print("</td>");
								print("<td>"); print($free2['pozicija']); print("</td>");
								print("<td>"); print($free2['stamina']); print("</td>");
								print("<td>"); print($free2['moral']); print("</td>");
								print("<td>"); print($free2['avg']); print("</td>");
								print("<td><input type='radio' name='mod4' value='$id'></td></tr>");								
							}		
						?>
						<tbody>
					</table>
					<br>
					<input class='btn btn-primary btn-block' type='submit' name='modalSUB4' value='Confirm'>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal5 -->
<div class="modal fade" id="myModal5" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding:15px 30px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>Select player for position 1</h3>
			</div>
			<div class="modal-body" style="padding:10px 20px;">
				<form role="form" action="postavi1.php" method="post">
					<table class='defaulttable'>
						<thead>
							<th>Num</th><th>Name</th><th>Position</th><th>Stamina</th><th>Morale</th><th>Average</th><th></th>
						</thead>
						<tbody>
						<?php
							foreach($slob1 as $id=>$free1)
							{
								print("<tr><td>"); print($free1['broj_na_dresu']); print("</td>");
								print("<td>"); print($free1['ime']); print(" "); print($free1['prezime']); print("</td>");
								print("<td>"); print($free1['pozicija']); print("</td>");
								print("<td>"); print($free1['stamina']); print("</td>");
								print("<td>"); print($free1['moral']); print("</td>");
								print("<td>"); print($free1['avg']); print("</td>");
								print("<td><input type='radio' name='mod5' value='$id'></td></tr>");
							}										
						?>
						<tbody>
					</table>
					<br>
					<input class='btn btn-primary btn-block' type='submit' name='modalSUB5' value='Confirm'>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	setInterval(function(){
			
			
			$.ajax({
				type:"POST",
				url: "timeoutEnd.php",
				data: {},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: timeoutEndRedirect});
			
		}, 30000);	
		
	function timeoutEndRedirect()
	{
		window.location = "../High5_game/High5_game.php";
	}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>