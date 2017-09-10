<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>

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
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
     <img src="images/logo2.jpg" width="46" height="46" class="img-circle">
     </div>
    <ul class="nav navbar-nav">
    	<li><p class="navbar-text">High5 Basketball Manager</p></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
    	<li style="float:right"> <a data-toggle="modal" href="#aboutModal"> About </a></li>
    </ul>
  </div>
    
  <!-- /.container-fluid -->
  
</nav>

<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							
							<div class="col-xs-6">
								<a style="color:black" href="../High5_register/High5_register.php"><span class="glyphicon glyphicon-user"></span> Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12" id="add_err">
								<form id="login-form" action="login.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
                                    <div class="form-group">
                                      <input type="submit" id="login" name="login" class="btn btn-default">
									</div>


</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="aboutModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" style="background-color:#e68a00;">
			<div class="modal-header" style="padding:15px 30px; ">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>About</h3>
			</div>
			<div class="modal-body" style="padding:10px 20px;">
				<p>
				High5 is a basketball manager simulator that strives to provide a realistic experience in
				managing your very own basketball team. You can buy, sell and train your players and play other teams in your league.
				</br>
				</br>
				Setting up an account gets you a team, an arena and a starting budget to launch you on your way to the top of your league!
				</br>
				</br>
				Good luck! - <i>The High5 Team</i>
				</p>
			</div>
		</div>
	</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--<script src="js/login.js"></script>-->
</body>
</html>
