<?php
?>
<html>
<head>
<link rel="stylesheet" href="chat.css">
</head>
<body>
	<form action="index.php" method="post">
		<p>
		<label for="username">Benutzername:</label>
		<input type="text" name="username" id="benutzername" required>
		</p>
		<p>
		<label for="password">Passwort:</label>
		<input type="password" name="password" class="passwort" required>
		</p>
		<p>
		<label for="again_password">Passwort wiederholen:</label>
		<input type="password" name="password2" class="passwort" required>
		</p>
		<p>
		<input type="submit" value="Registrieren" id="registrieren"> 
		</p>
	</form>
	<p>Oder:</p>
	<p>
	<form action="index.php" method="post">
		<input type="submit" value="Zum Login" id="login">
	</form>
	</p>
</body>
</html>

