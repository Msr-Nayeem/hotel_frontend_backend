<?php
include("loginCheck.php");
?>
<html>
<head>
	<link rel="stylesheet" href="Login_final.css">
	<script src="https://kit.fontawesome.com/305ea046e0.js" crossorigin="anonymous"></script>

	<title>Login as Admin</title>
</head>
<body>
	<div class="container">
			<div class="header">
			<h3>Welcome</h3>
			</div>
			<form class="form" id="form" action="" method="post">
			<div>
				<i class="fa fa-envelope" id="email" aria-hidden="true"></i>
				<input type="email" name="email" id="email" placeholder="Email" value=" <?php if(isset($_COOKIE['EMAIL'])){ echo $_COOKIE['EMAIL']; } ?> ">

			</div>
			<div>
				<i class="fa fa-lock" id="lock"></i>
				<input type="password" name="password" id="password" placeholder="Password" value=" <?php if(isset($_COOKIE['PASSWORD'])){ echo $_COOKIE['PASSWORD']; }  ?> ">	
			</div>
			<div>
				<input type="checkbox" class="remember" name="remember" <?php if(isset($_COOKIE["MARK"])) { echo "checked"; } ?> />  
     			<label for="remember">Remember me</label>
				<a class="forgot-pass" href="reset_password.php">Forgot password?</a>
			</div>
			<button type="submit" class="log-in" name="log-in">Log In</button>
			<button type="submit" class="sign-up" name="sign-up">Sign Up</button>
			</form>
			<div class="error">
				<?php echo $error ?>
			</div>
	</div>
</body>
</html>