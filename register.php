<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
?>

<html>
<head>
	<title>Welcome to ARCAM!</title>
</head>
<body>

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your account</h2>
			<p>
				<?php echo $account->getError(Constants::$loginFailed); ?>
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
				<?php echo $account->getError(Constants::$usernameCharacters); ?>
				<?php echo $account->getError(Constants::$usernameTaken); ?>
				<label for="username">Username</label>
				<input id="username" name="username" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('username') ?>" required>
			</p>
			<p>
				<?php echo $account->getError(Constants::$nameCharacters); ?>
				<label for="name">Name</label>
				<input id="name" name="name" type="text" placeholder="e.g. bart" value="<?php getInputValue('name') ?>" required>
			</p>
			<p>
				<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
				<?php echo $account->getError(Constants::$emailInvalid); ?>
				<?php echo $account->getError(Constants::$emailTaken); ?>
				<label for="email">Email</label>
				<input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email') ?>" required>
			</p>

			<p>
				<label for="email2">Confirm Email</label>
				<input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email2') ?>" required>
			</p>
			<p>
				<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
				<?php echo $account->getError(Constants::$passwordCharacters); ?>
				<label for="password">Password</label>
				<input id="password" name="password" type="password" placeholder="your password"  required>
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