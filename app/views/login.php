<!DOCTYPE html>
<html lang="ro">
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/public/styles/login_voluntar.css"/>	
</head>
<body>
	<div class="container">
		<div class="img">
			<img src="/public/images/quote.png" alt="quote">
		</div>
		<div class="login-content">
			<form>
				<img class="avatar" src="/public/images/fabrica_logo.png" alt="logo">
				
				<div class="form__group">
  					<input type="text" class="form__input" id="name" placeholder="Username" required="" />
				</div>

				<div class="form__group">
  					<input type="password" class="form__input" id="name" placeholder="Password" required="" />
				</div>
				
				<input type="submit" class="btn" value="Login">
				
				<a href="http://localhost:8888/users/register" id="reg_link"><button type="button" class="btn">Register</button></a>
				
				<img id="fb_button" src="/public/images/fb_login.png" alt="Login with fb">
			
				
			</form>
		</div>
		
	</div>
</body>
</html>