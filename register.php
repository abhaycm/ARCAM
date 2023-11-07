<html>
<head>
	<title>Welcome to Slotify!</title>
</head>
<body>

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your account</h2>
			<p>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" required>
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" name="loginPassword" type="password" placeholder="your password" required>
			</p>

			<button type="submit" name="loginButton">LOG IN</button>
			
		</form>

		<form id="registerForm" action="register.php" method="POST">
			<h2>Create your account</h2>
			<p>
				<label for="username">Username</label>
				<input id="username" name="username" type="text" placeholder="e.g. bartSimpson" required>
			</p>
			<p>
				<label for="name">Name</label>
				<input id="name" name="name" type="text" placeholder="e.g. bart" required>
			</p>
			<p>
				<label for="email">Email</label>
				<input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com" required>
			</p>

			<p>
				<label for="email2">Confirm Email</label>
				<input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" required>
			</p>
			<p>
				<label for="password">Password</label>
				<input id="password" name="password" type="password" placeholder="your password" required>
			</p>
			<p>
				<label for="password2">Confirm Password</label>
				<input id="password2" name="password2" type="password" placeholder="your password" required>
			</p>

			<button type="submit" name="registerButton">SIGN UP</button>
			
		</form>
	</div>

</body>
</html>