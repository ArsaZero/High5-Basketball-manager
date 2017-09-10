<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>

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
      <li class="active"><a href="../High5_home/High5_home.php">Home</a></li>
      <li><a href="../High5_team/High5_team.php">Team</a></li>
      <li><a href="../High5_league/High5_league.php">League</a></li> 
      <li><a href="../High5_training/High5_training.php">Training</a></li>
      <li><a href="../High5_transfers/High5_transfers.php">Transfers</a></li> 
      <li><a href="../High5_arena/High5_arena.php">Arena</a></li>
      <li><a href="../High5_profile/High5_profile.php">Profile</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="help-tip">
      		<p>This is the home tab. It provides you with some team info which includes your current balance, some upcoming games and your league standing.</p>
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
	////////TABELE////////
	
	$sql="SELECT COUNT(*) as br FROM tim";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$br_tima = (int)$row['br'];
	$result->close();
	
	$sql="SELECT naziv,pozicija,balance,logo,br_odigranih,pobede,porazi,kos_kolicnik,br_bodova,forma FROM tim WHERE id = '$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$budzet = (int)$row['balance'];
	$imetima = $row['naziv'];
	$logo = $row['logo'];
	$odigrane = (int)$row['br_odigranih'];
	$pobede = (int)$row['pobede'];
	$porazi = (int)$row['porazi'];
	$kolicnik = (int)$row['kos_kolicnik'];
	$bodovi = (int)$row['br_bodova'];
	$forma = $row['forma'];
	$pozicija = (int)$row['pozicija'];
	$pom = $pozicija;
	
	if($pozicija == 1)
	{
	$sql="SELECT naziv,pozicija,balance,logo,br_odigranih,pobede,porazi,kos_kolicnik,br_bodova,forma FROM tim WHERE pozicija = '2'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$budzet2 = (int)$row['balance'];
	$imetima2 = $row['naziv'];
	$logo2 = $row['logo'];
	$odigrane2 = (int)$row['br_odigranih'];
	$pobede2 = (int)$row['pobede'];
	$porazi2 = (int)$row['porazi'];
	$kolicnik2 = (int)$row['kos_kolicnik'];
	$bodovi2 = (int)$row['br_bodova'];
	$forma2 = $row['forma'];
	$pozicija2 = (int)$row['pozicija'];
	
	$sql="SELECT naziv,pozicija,balance,logo,br_odigranih,pobede,porazi,kos_kolicnik,br_bodova,forma FROM tim WHERE pozicija = '3'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$budzet3 = (int)$row['balance'];
	$imetima3 = $row['naziv'];
	$logo3 = $row['logo'];
	$odigrane3 = (int)$row['br_odigranih'];
	$pobede3 = (int)$row['pobede'];
	$porazi3 = (int)$row['porazi'];
	$kolicnik3 = (int)$row['kos_kolicnik'];
	$bodovi3 = (int)$row['br_bodova'];
	$forma3 = $row['forma'];
	$pozicija3 = (int)$row['pozicija'];
	
	}if($pozicija == $br_tima)
	{
	$br_tima2 = $br_tima-1;
	$br_tima2 = $br_tima-1;
	$sql="SELECT naziv,pozicija,balance,logo,br_odigranih,pobede,porazi,kos_kolicnik,br_bodova,forma FROM tim WHERE pozicija = '$br_tima2'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$budzet2 = (int)$row['balance'];
	$imetima2 = $row['naziv'];
	$logo2 = $row['logo'];
	$odigrane2 = (int)$row['br_odigranih'];
	$pobede2 = (int)$row['pobede'];
	$porazi2 = (int)$row['porazi'];
	$kolicnik2 = (int)$row['kos_kolicnik'];
	$bodovi2 = (int)$row['br_bodova'];
	$forma2 = $row['forma'];
	$pozicija2 = (int)$row['pozicija'];
	
	$br_tima3 = $br_tima-2;
	$sql="SELECT naziv,pozicija,balance,logo,br_odigranih,pobede,porazi,kos_kolicnik,br_bodova,forma FROM tim WHERE pozicija = '$br_tima3'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$budzet3 = (int)$row['balance'];
	$imetima3 = $row['naziv'];
	$logo3 = $row['logo'];
	$odigrane3 = (int)$row['br_odigranih'];
	$pobede3 = (int)$row['pobede'];
	$porazi3 = (int)$row['porazi'];
	$kolicnik3 = (int)$row['kos_kolicnik'];
	$bodovi3 = (int)$row['br_bodova'];
	$forma3 = $row['forma'];
	$pozicija3 = (int)$row['pozicija'];
	}
	
	if($pozicija < $br_tima && $pozicija > 1)
	{
	$pom1 = $pom-1;
	$sql="SELECT naziv,pozicija,balance,logo,br_odigranih,pobede,porazi,kos_kolicnik,br_bodova,forma FROM tim WHERE pozicija = '$pom1'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$budzet2 = (int)$row['balance'];
	$imetima2 = $row['naziv'];
	$logo2 = $row['logo'];
	$odigrane2 = (int)$row['br_odigranih'];
	$pobede2 = (int)$row['pobede'];
	$porazi2 = (int)$row['porazi'];
	$kolicnik2 = (int)$row['kos_kolicnik'];
	$bodovi2 = (int)$row['br_bodova'];
	$forma2 = $row['forma'];
	$pozicija2 = (int)$row['pozicija'];
	
	$pom2 = $pom+1;
	$sql="SELECT naziv,pozicija,balance,logo,br_odigranih,pobede,porazi,kos_kolicnik,br_bodova,forma FROM tim WHERE pozicija = '$pom2'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$budzet3 = (int)$row['balance'];
	$imetima3 = $row['naziv'];
	$logo3 = $row['logo'];
	$odigrane3 = (int)$row['br_odigranih'];
	$pobede3 = (int)$row['pobede'];
	$porazi3 = (int)$row['porazi'];
	$kolicnik3 = (int)$row['kos_kolicnik'];
	$bodovi3 = (int)$row['br_bodova'];
	$forma3 = $row['forma'];
	$pozicija3 = (int)$row['pozicija'];
	}
?>
<div class="container" style="width:60%">
      <div class="row">
    
        <div class="col-md-12 col-lg-12 toppad" >
          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <?php print"<img alt='User Pic' src='../High5_register/$logo' width='200' height='200' class='img-circle img-responsive'>" ?> </div>
           
                <div class=" col-md-9 col-lg-9" style="margin-top:10px;"> 
					  <table class="table table-user-information" style="margin-top:1px;">
						<tbody>
						  <tr>
							<td>Username:</td>
							<td><?php print "$myusername" ?></td>
						  </tr>
						  <tr>
							<td>Team Name:</td>
							<td><?php print "$imetima" ?></td>
						  </tr>
						  <tr>
							<td>Balance:</td>
							<td><?php print "$budzet $" ?></td>
						  </tr>
						  
						</tbody>
					  </table>
                </div>
              </div>
            </div>
                 
          </div>
        </div>
	 </div>
	 <?php
	 print("<div class='row'>");
		print("<div class='col-md-12 col-lg-12  toppad'>");
			print("<table class='table-fill1' style='max-height:100px;'>");
				print("<thead>");
					print("<tr>");
						print("<th class='text-center'>Pos</th>");
						print("<th class='text-center'>Team</th>");
						print("<th class='text-center'>MP</th>");
						print("<th class='text-center'>W</th>");
						print("<th class='text-center'>L</th>");
						print("<th class='text-center'>TP</th>");
						print("<th class='text-center'>PTS</th>");
						print("<th class='text-center'>Form</th>");
					print("</tr>");
				print("</thead>");
				print("<tbody class='table-hover'>");
					//prvi red
					print("<tr>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$pozicija2");
					}
					else if ($pozicija == 1)
					{
						print("$pozicija");
					}
					else if($pozicija == $br_tima)
					{
						print ("$pozicija3");
					}
					
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$imetima2");
					}
					else if ($pozicija == 1)
					{
						print("$imetima");
					}
					else if($pozicija == $br_tima)
					{
						print ("$imetima3");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$odigrane2");
					}
					else if ($pozicija == 1)
					{
						print("$odigrane");
					}
					else if($pozicija == $br_tima)
					{
						print ("$odigrane3");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$pobede2");
					}
					else if ($pozicija == 1)
					{
						print("$pobede");
					}
					else if($pozicija == $br_tima)
					{
						print ("$pobede3");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$porazi2");
					}
					else if ($pozicija == 1)
					{
						print("$porazi");
					}
					else if($pozicija == $br_tima)
					{
						print ("$porazi3");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$kolicnik2");
					}
					else if ($pozicija == 1)
					{
						print("$kolicnik");
					}
					else if($pozicija == $br_tima)
					{
						print ("$kolicnik3");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$bodovi2");
					}
					else if ($pozicija == 1)
					{
						print("$bodovi");
					}
					else if($pozicija == $br_tima)
					{
						print ("$bodovi3");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$forma2");
					}
					else if ($pozicija == 1)
					{
						print("$forma");
					}
					else if($pozicija == $br_tima)
					{
						print ("$forma3");
					}
					print("</td>");
					
					
					//drugi red
					print("<tr>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$pozicija");
					}
					else if ($pozicija == 1)
					{
						print("$pozicija2");
					}
					else if($pozicija == $br_tima)
					{
						print ("$pozicija2");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$imetima");
					}
					else if ($pozicija == 1)
					{
						print("$imetima2");
					}
					else if($pozicija == $br_tima)
					{
						print ("$imetima2");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$odigrane");
					}
					else if ($pozicija == 1)
					{
						print("$odigrane2");
					}
					else if($pozicija == $br_tima)
					{
						print ("$odigrane2");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$pobede");
					}
					else if ($pozicija == 1)
					{
						print("$pobede2");
					}
					else if($pozicija == $br_tima)
					{
						print ("$pobede2");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$porazi");
					}
					else if ($pozicija == 1)
					{
						print("$porazi2");
					}
					else if($pozicija == $br_tima)
					{
						print ("$porazi2");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$kolicnik");
					}
					else if ($pozicija == 1)
					{
						print("$kolicnik2");
					}
					else if($pozicija == $br_tima)
					{
						print ("$kolicnik2");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$bodovi");
					}
					else if ($pozicija == 1)
					{
						print("$bodovi2");
					}
					else if($pozicija == $br_tima)
					{
						print ("$bodovi2");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$forma");
					}
					else if ($pozicija == 1)
					{
						print("$forma2");
					}
					else if($pozicija == $br_tima)
					{
						print ("$forma2");
					}
					print("</td>");
					
					
					//treci red
					print("<tr>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$pozicija3");
					}
					else if ($pozicija == 1)
					{
						print("$pozicija3");
					}
					else if($pozicija == $br_tima)
					{
						print ("$pozicija");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$imetima3");
					}
					else if ($pozicija == 1)
					{
						print("$imetima3");
					}
					else if($pozicija == $br_tima)
					{
						print ("$imetima");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$odigrane3");
					}
					else if ($pozicija == 1)
					{
						print("$odigrane3");
					}
					else if($pozicija == $br_tima)
					{
						print ("$odigrane");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$pobede3");
					}
					else if ($pozicija == 1)
					{
						print("$pobede3");
					}
					else if($pozicija == $br_tima)
					{
						print ("$pobede");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$porazi3");
					}
					else if ($pozicija == 1)
					{
						print("$porazi3");
					}
					else if($pozicija == $br_tima)
					{
						print ("$porazi");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$kolicnik3");
					}
					else if ($pozicija == 1)
					{
						print("$kolicnik3");
					}
					else if($pozicija == $br_tima)
					{
						print ("$kolicnik");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$bodovi3");
					}
					else if ($pozicija == 1)
					{
						print("$bodovi3");
					}
					else if($pozicija == $br_tima)
					{
						print ("$bodovi");
					}
					print("</td>");
					print("<td class='text-center'>");
					if($pozicija!= 1 && $pozicija!= $br_tima)
					{
						print("$forma3");
					}
					else if ($pozicija == 1)
					{
						print("$forma3");
					}
					else if($pozicija == $br_tima)
					{
						print ("$forma");
					}
					print("</td>");
					
				print("</tbody>");
			print("</table>");
		print("</div>");
	print("</div>");
	  ?>
	  <div class="row">
		<div class="col-md-12 col-lg-12 toppad">
			<table class="table-fill1">
				<thead>
					<tr> <th colspan="5" style="font-size:19px;"> Schedule </th> </tr>
					<tr>
						<th class="text-center">Time</th>
						<th class="text-center">Team1</th>
						<th class="text-center">Team2</th>
					</tr>
				</thead>

				<tbody class="table-hover" >
<?php
	$sql = "SELECT * from liga";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$result->close();
	
	$tr_kolo = (int)$row['tr_kolo'];
	$kolo1;
	$kolo2;
	
	if($tr_kolo < 17)
	{
		$kolo1 = $tr_kolo + 1;
		$kolo2 = $tr_kolo + 2;
	}
	else if ($tr_kolo == 17)
	{
		$kolo1 = 16;
		$kolo2 = 18;
	}
	else if ($tr_kolo == 18)
	{
		$kolo1 = 16;
		$kolo2 = 17;
	}
	
	$kola = array($tr_kolo, $kolo1, $kolo2);
	sort($kola);
	
	for ($i = 0; $i < 3; $i++)
	{
		$pom = $kola[$i];
		$sql = "SELECT * FROM utakmica WHERE br_kola = '$pom' AND (prvi_tim_id = '$user_team_id' OR drugi_tim_id = '$user_team_id')";
		$result = $conn->query($sql);
		
		$row = $result->fetch_assoc();
		$result->close();
		
		$time_td = $row['datum_i_vreme'];
		$tim1_id = $row['prvi_tim_id'];
		$tim2_id = $row['drugi_tim_id'];
		
		$sql = "SELECT naziv FROM tim WHERE id = '$tim1_id' ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$result->close();
		$tim1_naziv = $row['naziv'];
		
		$sql = "SELECT naziv FROM tim WHERE id = '$tim2_id' ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$result->close();
		$tim2_naziv = $row['naziv'];
		
		print("<tr>");
			print("<td class='text-center'>"); print("$time_td"); print("</td>");
			print("<td class='text-center'>"); print("$tim1_naziv"); print("</td>");
			print("<td class='text-center'>"); print("$tim2_naziv"); print("</td>");
		print("</tr>");
	}
?>
				</tbody>
			</table>
		</div>
	  
    </div>










</body>
</html>
