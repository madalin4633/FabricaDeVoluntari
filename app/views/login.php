<?php
	require_once __DIR__.'/../controllers/User.php';

	$user = new User();

	$result = $user->login_with_facebook();

	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}	
?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/public/styles/auth_style.css"/>	
</head>
<body>
	<div class="container" id="login_page">
		<div class="img">
			<img src="/public/images/quote.png" alt="quote">
		</div>
		<div class="login-content">
			<form method="POST" action="/user/login">
				<img class="avatar" src="/public/images/fabrica_logo.png" alt="logo">
				<p id="text_error"><?php echo($data['error']);?></p>
				<div class="form__group">
  					<input type="text" class="form__input" name="email" placeholder="Email" required="" />
				</div>

				<div class="form__group">
  					<input type="password" class="form__input" name="password" placeholder="Password" required="" />
				</div>
				
				<input type="submit" class="btn" value="Login">
				
				<a href="/user/register" id="reg_link"><button type="button" class="btn">Register</button></a>

				<input type="button" class="btn" value="Login with facebook" onclick="window.location ='<?php echo $result?>'">
				
				<!-- <img id="fb_button" onclick="windows.location ='"  src="/public/images/fb_login.png" alt="Login with fb"> -->
				
			</form>
		</div>
		
	</div>
	<?php 
		if (isset($_SESSION['fresh_registered'])){
			alert("Felicitari! V-ati inregistrat cu succes!");
			unset($_SESSION['fresh_registered']);
		}
	?>
</body>
</html>