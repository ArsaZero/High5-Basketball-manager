<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Game</title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery-1.11.2.min.js"></script>


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
      <li><a href="../High5_profile/High5_profile.php">Profile</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="help-tip">
      		<p>This is the live game tab. You can get here only when your match is active. Here you can see both your and your opponents team. You can also see development of the match and call timeouts.</p>
      </li>
      
      <!--<li><a href="#"><span class="glyphicon glyphicon-volume-up"></span> </a></li>-->
      <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>    
	</ul>
  </div>
</nav>
<?php
	require_once 'config.php';
	session_start();
	
	$username = $_SESSION['username'];
	
	$sql = "SELECT id,tim_id FROM korisnik WHERE username = '$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$user_id = $row['id'];
	$tim1_id = $row['tim_id'];
	
	$sql = "SELECT * FROM utakmica WHERE status = 'A' AND (prvi_tim_id = '$tim1_id' OR drugi_tim_id = '$tim1_id')";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	$utakmica_id = $row['id'];
	$tim1_id = $row['prvi_tim_id'];
	$tim2_id = $row['drugi_tim_id'];
	
	
	$poruka = $row['poruka'];
	$tim1_poeni = $row['poeni_prvog_tima'];
	$tim2_poeni = $row['poeni_drugog_tima'];

	$minuti = $row['minuti'];
	$sekunde = $row['sekunde'];
	$cetvrtine = $row['cetvrtina'];
	
	$sql = "SELECT * FROM tim WHERE id='$tim1_id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	$tim1_naziv = $row['naziv'];
	$tim1_logo = $row['logo'];
	
	$sql = "SELECT * FROM tim WHERE id='$tim2_id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	$tim2_naziv = $row['naziv'];
	$tim2_logo = $row['logo'];
	
	////NAV2////
	print("<nav class='navbar navbar-inverse'>");
		print("<div class='row'>");
		
			print("<div class='col-md-2'>");
				print("<img class='center-block img-circle' src='../High5_register/" . $tim1_logo . "' width='50' height='50' style='padding:3px'>");
			print("</div>");
			
			print("<div class='col-md-2'>");
				print("<p class='center-block1'>" . $tim1_naziv . "</p>");
			print("</div>");
			
			print("<div class='col-md-1'>");
				print("<p class='center-block1' id='p_tim1'>" . $tim1_poeni . "</p>");
			print("</div>");
			
			print("<div class='col-md-2'>");
				print("<p class='center-block1'> : </p>");
			print("</div>");
			
			print("<div class='col-md-1'>");
				print("<p class='center-block1' id='p_tim2'>" . $tim2_poeni . "</p>");
			print("</div>");
			
			print("<div class='col-md-2'>");
				print("<p class='center-block1'>" . $tim2_naziv . "</p>");
			print("</div>");
			
			print("<div class='col-md-2'>");
				print("<img class='center-block img-circle' src='../High5_register/" . $tim2_logo . "' width='50' height='50' style='padding:3px'>");
			print("</div>");
			
		print("</div>");
	print("</nav>");
	/////////////////
	
	$niz = array();
	$niz1 = array();
	
	$sql = "SELECT * FROM igrac WHERE tim_id='$tim1_id'";
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc())
	{
			$id = $row['id'];
			$niz[$id]['broj_na_dresu'] = $row['broj_na_dresu'];
			$niz[$id]['ime'] = $row['ime'];
			$niz[$id]['prezime'] = $row['prezime'];
			$niz[$id]['indeks'] = $row['indeks'];
			$niz[$id]['stamina'] = $row['stamina'];
			$niz[$id]['moral'] = $row['moral'];
			$niz[$id]['broj_poena'] = $row['broj_poena'];
			$niz[$id]['aktivan'] = $row['aktivan'];
	}
	
	$sql = "SELECT * FROM igrac WHERE tim_id='$tim2_id'";
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc())
	{
			$id = $row['id'];
			$niz1[$id]['broj_na_dresu'] = $row['broj_na_dresu'];
			$niz1[$id]['ime'] = $row['ime'];
			$niz1[$id]['prezime'] = $row['prezime'];
			$niz1[$id]['indeks'] = $row['indeks'];
			$niz1[$id]['stamina'] = $row['stamina'];
			$niz1[$id]['moral'] = $row['moral'];
			$niz1[$id]['broj_poena'] = $row['broj_poena'];
			$niz1[$id]['aktivan'] = $row['aktivan'];
	}
	
	
?>

<div class="tab">
<table class="table-fill">
    <thead>
        <tr>
            <th class="text-center">Num</th>
            <th class="text-name">Name</th>
            <th class="text-center">Index</th>
            <th class="text-center">Stam</th>
            <th class="text-center">Moral</th>
			<th class="text-center">Pts</th>
        </tr>
    </thead>
	<tbody class='table-hover' id="tim1">
<?php
		foreach($niz as $igrac_tim1)
		{	
			print("<tr>");
				print("<td class='text-center'>"); print($igrac_tim1['broj_na_dresu']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim1['ime'] . " " . $igrac_tim1['prezime']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim1['indeks']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim1['stamina']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim1['moral']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim1['broj_poena']); print("</td>");
			print("</tr>");
		}
	?>
	</tbody>
</table>

</div>

	<div class="tab1">
	
	<div class='row center-block2' style="margin-top: 0px;">
		<nav class='navbar navbar-inverse' style="opacity: 0.85;">
<?php
			//print("<p id='p_poruka' class='center-block' style='color: white; padding-top: 14px; word-wrap: break-word;'>"); print($poruka); print("</p>");
			
			print("<div class='col-md-2'>");
				print("<p class='center-block1' id='p_overtime'> QTR </p>");
			print("</div>");
			
			print("<div class='col-md-3'>");
				print("<p class='center-block1' id='p_cetvrtina' style='float:left';>" . $cetvrtine . "</p>");
			print("</div>");
			
			print("<div class='col-md-1'>");
				print("<p class='center-block1' id='p_minuti'>" . $minuti . "</p>");
			print("</div>");
			
			print("<div class='col-md-1'>");
				print("<p class='center-block1'> : </p>");
			print("</div>");
			
			print("<div class='col-md-1'>");
				print("<p class='center-block1' id='p_sekunde'>" . $sekunde . "</p>");
			print("</div>");
?>
		</nav>
	</div>
	
		<div class="hp">
<?php
		foreach($niz as $igrac_tim1)
		{
			if ($igrac_tim1['aktivan'] == 2)
			{
				print("<a class='round-button2' id='tim1_2'>"); print($igrac_tim1['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
		
		foreach($niz1 as $igrac_tim2)
		{
			if ($igrac_tim2['aktivan'] == 2)
			{
				print("<a class='round-button7' id='tim2_2'>"); print($igrac_tim2['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
		
		print("<div style='clear:both;'></div>");
		
		foreach($niz as $igrac_tim1)
		{
			if ($igrac_tim1['aktivan'] == 4)
			{
				print("<a class='round-button4' id='tim1_4'>"); print($igrac_tim1['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
		
		foreach($niz1 as $igrac_tim2)
		{
			if ($igrac_tim2['aktivan'] == 4)
			{
				print("<a class='round-button9' id='tim2_4'>"); print($igrac_tim2['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
		
		print("<div style='clear:both;'></div>");
		
		foreach($niz as $igrac_tim1)
		{
			if ($igrac_tim1['aktivan'] == 1)
			{
				print("<a class='round-button1' id='tim1_1'>"); print($igrac_tim1['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
		
		foreach($niz1 as $igrac_tim2)
		{
			if ($igrac_tim2['aktivan'] == 1)
			{
				print("<a class='round-button6' id='tim2_1'>"); print($igrac_tim2['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
		
		print("<div style='clear:both;'></div>");
		
		foreach($niz as $igrac_tim1)
		{
			if ($igrac_tim1['aktivan'] == 5)
			{
				print("<a class='round-button5' id='tim1_5'>"); print($igrac_tim1['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
		
		foreach($niz1 as $igrac_tim2)
		{
			if ($igrac_tim2['aktivan'] == 5)
			{
				print("<a class='round-button10' id='tim2_5'>"); print($igrac_tim2['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
		
		print("<div style='clear:both;'></div>");
		
		foreach($niz as $igrac_tim1)
		{
			if ($igrac_tim1['aktivan'] == 3)
			{
				print("<a class='round-button3' id='tim1_3'>"); print($igrac_tim1['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
		
		foreach($niz1 as $igrac_tim2)
		{
			if ($igrac_tim2['aktivan'] == 3)
			{
				print("<a class='round-button8' id='tim2_3'>"); print($igrac_tim2['broj_na_dresu']); print("</a>");
				break;
			}
			
		}
?>
		</div>
		
		<div class='row center-block2' style="margin-top: 10px;">
			<nav class='navbar navbar-inverse' style="opacity: 0.85;">
<?php
				print("<p id='p_poruka' class='center-block' style='color: white; padding-top: 14px; word-wrap: break-word;'>"); print($poruka); print("</p>");
?>
			</nav>
		</div>
		<div class='row center-block' style="max-width: 140px;">
			
			<form action='timeout.php' method='post'>
<?php
				print("<input type='hidden' id='id_utakmice' value='$utakmica_id'/>");
?>
				<input type="submit" name="trainBtn" value="Timeout" class="enjoy-css-button">
			</form>
		</div>
		
	</div>

<div class="tab2">
<table class="table-fill">
    <thead>
        <tr>
            <th class="text-center">Num</th>
            <th class="text-name">Name</th>
            <th class="text-center">Index</th>
            <th class="text-center">Stam</th>
            <th class="text-center">Moral</th>
			<th class="text-center">Pts</th>
        </tr>
    </thead>
	<tbody class='table-hover' id="tim2">
<?php
		foreach($niz1 as $igrac_tim2)
		{
			print("<tr>");
				print("<td class='text-center'>"); print($igrac_tim2['broj_na_dresu']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim2['ime'] . " " . $igrac_tim2['prezime']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim2['indeks']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim2['stamina']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim2['moral']); print("</td>");
				print("<td class='text-center'>"); print($igrac_tim2['broj_poena']); print("</td>");
			print("</tr>");
		}
	
?>
    </tbody>
</table>
</div>

	
<script>
		setInterval(function(){
			
			var id_u = $("#id_utakmice").val();
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url: "Refresh1.php",
				data: {"id_utak":id_u},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: prikaz1});
			
		}, 2000);
		
		setInterval(function(){
			
			var id_u = $("#id_utakmice").val();
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url: "Refresh2.php",
				data: {"id_utak":id_u},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: prikaz2});
			
		}, 2000);
		
		setInterval(function(){
			
			var id_u = $("#id_utakmice").val();
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url: "Refresh3.php",
				data: {"id_utak":id_u},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: prikaz3});
			
		}, 2000);
		
		setInterval(function(){
			
			var id_u = $("#id_utakmice").val();
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url: "Refresh4.php",
				data: {"id_utak":id_u},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: prikaz4});
			
		}, 2000);
		
		setInterval(function(){
			
			var id_u = $("#id_utakmice").val();
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url: "Refresh5.php",
				data: {"id_utak":id_u},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: prikaz5});
			
		}, 2000);
		
		setInterval(function(){
			var id_u = $("#id_utakmice").val();
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url: "timeoutGranted.php",
				data: {"id_utak":id_u},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: timeoutRedirect});
			
		}, 500);
		
		
		
		setInterval(function(){
			
			var id_u = $("#id_utakmice").val();
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url: "Refresh6.php",
				data: {"id_utak":id_u},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: prikaz6});
			
		}, 2000);
		
		setInterval(function(){
			
			var id_u = $("#id_utakmice").val();
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url: "Refresh7.php",
				data: {"id_utak":id_u},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: prikaz7});
			
		}, 2000);
		
		setInterval(function(){
			
			var id_u = $("#id_utakmice").val();
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url: "Refresh8.php",
				data: {"id_utak":id_u},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus + " : " + errorThrown);
				},
			success: prikaz8});
			
		}, 2000);

		
		//function prikaz(tim1_igraci, tim2_igraci, poeni1, poeni2, nova_poruka)
		function timeoutRedirect(t)
		{
			if(t.nova_poruka == 'nije')
			{
				
			}
			else if (t.nova_poruka == 'jeste')
			{
				window.location = "../High5_subs/High5_subs.php";
			}
		}
		
		function prikaz1(tim1_igraci)
		{
			if(tim1_igraci == 'greska')
			{
				alert("Database error.");
			}	
			else
			{
				$("#tim1").empty();
				$.each(tim1_igraci, function(i, igrac)
				{
					$("#tim1").append("<tr><td class='text-center'>" + igrac.number + "</td><td class='text-center'>"
										+ igrac.ime + " " + igrac.prezime + "</td><td class='text-center'>" + igrac.index + "</td><td class='text-center'>"
										+ igrac.stamina + "</td><td class='text-center'>" + igrac.moral + "</td><td class='text-center'>" + igrac.poeni + "</td></tr>");
					
					if(igrac.aktivan == 1)
					{
						$("#tim1_1").html(igrac.number);
					}
					else if(igrac.aktivan == 2)
					{
						$("#tim1_2").html(igrac.number);
					}
					else if(igrac.aktivan == 3)
					{
						$("#tim1_3").html(igrac.number);
					}
					else if(igrac.aktivan == 4)
					{
						$("#tim1_4").html(igrac.number);
					}
					else if(igrac.aktivan == 5)
					{
						$("#tim1_5").html(igrac.number);
					}
				});
				
			}
		}
		
		function prikaz2(tim2_igraci)
		{
			if(tim2_igraci == 'greska')
			{
				alert("Database error.");
			}	
			else
			{
				$("#tim2").empty();
				$.each(tim2_igraci, function(i, igrac)
				{
					$("#tim2").append("<tr><td class='text-center'>" + igrac.number + "</td><td class='text-center'>"
										+ igrac.ime + " " + igrac.prezime + "</td><td class='text-center'>" + igrac.index + "</td><td class='text-center'>"
										+ igrac.stamina + "</td><td class='text-center'>" + igrac.moral + "</td><td class='text-center'>" + igrac.poeni + "</td></tr>");
					
					if(igrac.aktivan == 1)
					{
						$("#tim2_1").html(igrac.number);
					}
					else if(igrac.aktivan == 2)
					{
						$("#tim2_2").html(igrac.number);
					}
					else if(igrac.aktivan == 3)
					{
						$("#tim2_3").html(igrac.number);
					}
					else if(igrac.aktivan == 4)
					{
						$("#tim2_4").html(igrac.number);
					}
					else if(igrac.aktivan == 5)
					{
						$("#tim2_5").html(igrac.number);
					}
				});
				
			}
		}
		
		function prikaz3(poeni1)
		{
			if(poeni1 == 'greska')
			{
				alert("Database error.");
			}	
			else
			{
				$("#p_tim1").html(poeni1.pts);
			}
		}
		
		function prikaz4(poeni2)
		{
			if(poeni2 == 'greska')
			{
				alert("Database error.");
			}	
			else
			{
				$("#p_tim2").html(poeni2.pts);
			}
		}
		
		function prikaz5(msg)
		{
			if(msg == 'greska')
			{
				alert("Database error.");
			}	
			else
			{
				$("#p_poruka").html(msg.nova_poruka);
			}
		}
		
		function prikaz6(cetvrtina)
		{
			if(cetvrtina == 'greska')
			{
				alert("Database error.");
			}	
			else
			{
				$("#p_cetvrtina").html(cetvrtina.cet);
			}
		}
		
		function prikaz7(minuti)
		{
			if(minuti == 'greska')
			{
				alert("Database error.");
			}	
			else
			{
				$("#p_minuti").html(minuti.minut);
			}
		}
		
		function prikaz8(sekunde)
		{
			if(sekunde == 'greska')
			{
				alert("Database error.");
			}	
			else
			{
				$("#p_sekunde").html(sekunde.sek);
			}
		}
</script>
	
	
</body>
</html>
