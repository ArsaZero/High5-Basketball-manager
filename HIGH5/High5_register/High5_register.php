<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
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
										<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="register.php" method="post" role="form" enctype="multipart/form-data" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
                                    
									<div class="form-group">
										<input type="password" name="confirmpassword" id="confirnpassword" tabindex="3" class="form-control" placeholder="Confirm Password">
									</div>
                                    
									<div class="form-group">
										<input type="text" name="teamname" id="teamname" tabindex="4" class="form-control" placeholder="Team Name">
									</div>
									<div class="form-group">
										<input type="text" name="arenaname" id="arenaname" tabindex="5" class="form-control" placeholder="Arena Name">
									</div>
		
				<div>
					<input type="file" name="file-1" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
					<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose an emblem&hellip;</span></label>
				</div>
		
	<div class="form-group">
	  <input type="submit" name="SubReg" value="Submit" class="btn btn-default">
	</div>

<div class="modal fade" id="aboutModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" style="background-color:#e68a00;">
			<div class="modal-header" style="padding:15px 30px; ">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>About</h3>
			</div>
			<div class="modal-body" style="padding:10px 20px; ">
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
<script src="js/custom-file-input.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
