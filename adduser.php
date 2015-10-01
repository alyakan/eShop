<?php

/*** begin our session ***/
session_start();

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>

<html>
	<head>
		<title>Login</title>
	</head>

	<body>
		<h2>Register</h2>
		<form action="adduser_submit.php" method="post">
			<fieldset>
			<p>
				<label for="username">Username</label>
				<input type="text" id="username" name="username" value="" maxlength="20" />
			</p>
			<p>
				<label for="password">Password</label>
				<input type="password" id="password" name="password" value="" maxlength="20" />
			</p>
			<p>
				<label for="conpass">Confirm Password</label>
				<input type="password" id="conpass" name="conpass" value="" maxlength="20" />
			</p>
			<p>
				<label for="email">Email</label>
				<input type="text" id="email" name="email" value="" maxlength="50" />
			</p>
			<p>
				<label for="firstname">First Name</label>
				<input type="text" id="firstname" name="firstname" value="" maxlength="50" />
			</p>
			<p>
				<label for="lastname">Last Name</label>
				<input type="text" id="lastname" name="lastname" value="" maxlength="50" />
			</p>
			<p>
				<label for="avatar">Avatar</label>
				<input type="text" id="avatar" name="avatar" value="" maxlength="50" />
			</p>
			<p>
				<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
				<input type="submit" value="register" />
			</p>
			</fieldset>
		</form>
	</body>
</html>