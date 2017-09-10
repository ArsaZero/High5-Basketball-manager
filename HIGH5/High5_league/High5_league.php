<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>League</title>

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
      <li class="active"><a href="../High5_league/High5_league.php">League</a></li> 
      <li><a href="../High5_training/High5_training.php">Training</a></li>
      <li><a href="../High5_transfers/High5_transfers.php">Transfers</a></li> 
      <li><a href="../High5_arena/High5_arena.php">Arena</a></li>
      <li><a href="../High5_profile/High5_profile.php">Profile</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="help-tip">
      		<p>This is the league tab. It shows the current standings for the league your team is in as well as all the games that are to be or have been played during its course.</p>
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

<div class="sve" style="margin-left:20px; margin-right:20px;">
    <table class="table-fill1" align="left">
    	<thead>
    		<tr>
    			<th class="text-pos">Pos</th>
    			<th class="text-center">Team</th>
                <th class="text-center">MP</th>
                <th class="text-center">W</th>
    			<th class="text-center">L</th>
    			<th class="text-center">Diff</th>
                <th class="text-center">PTS</th>
                <th class="text-center">Form</th>
    		</tr>
    	</thead>
    <tbody class="table-hover">
<?php
	
	$sql = "SELECT * FROM tim ORDER BY pozicija";
	$result = $conn->query($sql);
	if ($result)
	{
		$i = 1;
		$niz = array();
		while ($row = $result->fetch_assoc())
		{
			$id = $row['id'];
			$niz[$id]['naziv'] = $row['naziv'];
			$niz[$id]['br_odigranih'] = $row['br_odigranih'];
			$niz[$id]['pobede'] = $row['pobede'];
			$niz[$id]['porazi'] = $row['porazi'];
			$niz[$id]['kos_kolicnik'] = $row['kos_kolicnik'];
			$niz[$id]['br_bodova'] = $row['br_bodova'];
			$niz[$id]['forma'] = $row['forma'];
			
			print("<tr>");
					print("<td class='text-left'>"); print($i . "."); print("</td>");
					print("<td class='text-center'>"); print($niz[$id]["naziv"]); print("</td>");
					print("<td class='text-center'>"); print($niz[$id]["br_odigranih"]); print("</td>");
					print("<td class='text-center'>"); print($niz[$id]["pobede"]); print("</td>");
					print("<td class='text-center'>"); print($niz[$id]["porazi"]); print("</td>");
					print("<td class='text-center'>"); print($niz[$id]["kos_kolicnik"]); print("</td>");
					print("<td class='text-center'>"); print($niz[$id]["br_bodova"]); print("</td>");
					print("<td class='text-center'>"); print($niz[$id]["forma"]); print("</td>");
			print("</tr>");
			
			$i++;
			
		}
		
	}
?>
    </tbody>
    </table>
    <table class="table-fill2" align="right">
    	<thead>
    		<tr>
    			<th class="schedule"></th>
    			<th class="schedule">Schedule</th>
                <th class="schedule"></th>
    		</tr>
    		<tr>
    			<th class="text-center">Time</th>
    			<th class="text-center">Team1</th>
                <th class="text-center">Team2</th>
    		</tr>
    	</thead>

    <tbody class="table-hover">
<?php
	$sql = "SELECT tr_kolo FROM liga";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$result->close();
	
	$kolo = $row['tr_kolo'];
	
	$sql = "SELECT id, naziv FROM tim";
	$result = $conn->query($sql);
	$niz = array();
	while ($row = $result->fetch_assoc())
	{
		$id = $row['id'];
		$niz[$id]['naziv'] = $row['naziv'];
	}
	$result->close();
	
	$sql = "SELECT * FROM utakmica WHERE br_kola='$kolo'";
	$result = $conn->query($sql);
	
	
	$niz1 = array();
	while ($row = $result->fetch_assoc())
	{
		$id = $row['id'];
		$niz1[$id]['datum_i_vreme'] = $row['datum_i_vreme'];
		$niz1[$id]['prvi_tim_id'] = $row['prvi_tim_id'];
		$niz1[$id]['drugi_tim_id'] = $row['drugi_tim_id'];
	}
	
	foreach ($niz1 as $utakmice)
	{
		$id1 = $utakmice['prvi_tim_id'];
		$id2 = $utakmice['drugi_tim_id'];
		print("<tr>");
				print("<td class='text-center'>"); print($utakmice['datum_i_vreme']); print("</td>");
				print("<td class='text-center'>"); print($niz[$id1]["naziv"]); print("</td>");
				print("<td class='text-center'>"); print($niz[$id2]["naziv"]); print("</td>");
		print("</tr>");
	}
	$result->close();

?>
		<tr>
			 <td style="text-align:center;" colspan="3"> <button style="width:95%; color:black;" data-toggle="modal" href="#fullScheduleModal">See full schedule </button> </td>
		</tr>
		
    </tbody>
    </table>
	<div style="clear:both;"></div>
    <table class="table-fill3" align="right">
    	<thead>
    		<tr>
    			<th class="awards">Awards</th>
    			<th class="awards"></th>
    		</tr>
    	</thead>
        <tbody class="table-hover">
            <tr>
            <td class="text-left" style="font-size:15px; font-weight:300">First</td>
            <td class="text-left" style="font-size:15px; font-weight:300">20000$</td>
            </tr>
            <tr>
            <td class="text-left" style="font-size:13px; font-weight:200">Second</td>
            <td class="text-left" style="font-size:13px; font-weight:200">10000$</td>
            </tr>
            <tr>
            <td class="text-left" style="font-size:11px; font-weight:100">Third</td>
            <td class="text-left" style="font-size:11px; font-weight:100">5000$</td>
            </tr>
         </tbody>
    </table>
</div>

<!-- Modal5 -->
<div class="modal fade" id="fullScheduleModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding:15px 30px; text-align:center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>League schedule</h3>
			</div>
			<div class="modal-body" style="padding:10px 20px;">
					<table class='defaulttable' style="width:100%;">
						<thead>
							<th>Time</th><th>Team1</th><th>Result</th><th>Team2</th>
						</thead>
						<tbody>
						<?php
							$sql = "SELECT id, naziv FROM tim";
							$result = $conn->query($sql);
							$niz = array();
							while ($row = $result->fetch_assoc())
							{
								$id = $row['id'];
								$niz[$id]['naziv'] = $row['naziv'];
							}
							$result->close();
							
							
							$sql = "SELECT * FROM utakmica ORDER BY br_kola ASC";
							$result = $conn->query($sql);
							$niz1 = array();
							while($row = $result->fetch_assoc())
							{
								$id = $row['id'];
								$niz1[$id]['br_kola'] = $row['br_kola'];
								$niz1[$id]['prvi_tim_id'] = $row['prvi_tim_id'];
								$niz1[$id]['drugi_tim_id'] = $row['drugi_tim_id'];
								$niz1[$id]['poeni_prvog_tima'] = $row['poeni_prvog_tima'];
								$niz1[$id]['poeni_drugog_tima'] = $row['poeni_drugog_tima'];
								$niz1[$id]['datum_i_vreme'] = $row['datum_i_vreme'];
							}
							$result->close();
							
							$rnd = 0;
							foreach($niz1 as $utakmice)
							{
								$id1 = $utakmice['prvi_tim_id'];
								$id2 = $utakmice['drugi_tim_id'];
								
								if($rnd == $utakmice['br_kola'])
								{
									print("<tr>");
											//print("<td class='text-center'>"); print($utakmice['br_kola']); print("</td>");
											print("<td class='text-center'>"); print($utakmice['datum_i_vreme']); print("</td>");
											print("<td class='text-center'>"); print($niz[$id1]["naziv"]); print("</td>");
											print("<td class='text-center'>"); print($utakmice['poeni_prvog_tima']); print("  :  "); print($utakmice['poeni_drugog_tima']); print("</td>");
											print("<td class='text-center'>"); print($niz[$id2]["naziv"]); print("</td>");
									print("</tr>");
								}
								else
								{
									$rnd = $utakmice['br_kola'];
									print("<tr>");
											print("<td class='text-center' colspan='4'>"); print("<b>Round "); print($rnd); print("</b>"); print("</td>");
									print("</tr>");
									print("<tr>");
											//print("<td class='text-center'>"); print($utakmice['br_kola']); print("</td>");
											print("<td class='text-center'>"); print($utakmice['datum_i_vreme']); print("</td>");
											print("<td class='text-center'>"); print($niz[$id1]["naziv"]); print("</td>");
											print("<td class='text-center'>"); print($utakmice['poeni_prvog_tima']); print("  :  "); print($utakmice['poeni_drugog_tima']); print("</td>");
											print("<td class='text-center'>"); print($niz[$id2]["naziv"]); print("</td>");
									print("</tr>");
								}
							}
							
							print("<tr>");
											print("<td class='text-center' colspan='4'>"); print("<b>End of season</b>"); print("</td>");
							print("</tr>");
						?>
						<tbody>
					</table>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
