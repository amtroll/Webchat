<?php
include_once 'config.php';
//Chat Login nach Absenden des Formulars signup.php

if (isset($_POST['username']))
{
    //Prüfen, ob die Passwörter übereinstimmen
	if($_POST['password2']!=$_POST['password'])
	{
		echo "Die Passw&oumlrter stimmen nicht &uumlberein. <br />
			Bitte versuchen Sie es erneut.";
		?>
		<link rel="stylesheet" href="chat.css">
		<div class="wrong">
		<form action="signup_test.php" method="post">
		<input type="submit" value="Zurück zur Registrierung" id="login">
		</form>
		</div>
		<?php 
	}

    //Prüfen, ob alle Felder ausgefüllt sind
	else if(empty($_POST['username'])|| empty($_POST['password2'])|| empty($_POST['password']))
	{
		echo "Bitte f6uumlllen Sie alle Felder aus.<br />";
		?>
		<link rel="stylesheet" href="chat.css">
		<div class="wrong">
		<form action="signup_test.php">
		<input type="submit" value="zurück zur Registrierung" id="back">
		</form>
		</div>
		<?php 
	}
	
    //Prüfen, dass keine Sonderzeichen im Benutzernamen verwendet wurden
	else if(!empty($_POST['username'])&& !empty($_POST['password2'])&& !empty($_POST['password'])&& $_POST['password2'] == $_POST['password'])
	{
		if((preg_match("/^[a-zA-Z0-9öäüÖÄÜß]+$/", $_POST['username']) != 1))
		{
			echo "Bitte verwenden sie keine Sonderzeichen im Benutzernamen.";
			?>
			<link rel="stylesheet" href="chat.css">
			<div class="wrong">
			<form action="signup_test.php">
			<input type="submit" value="zurück zur Registrierung" id="back">
			</form>
			</div>
			<?php 
		}

        //Prüfen, ob Nutzername noch verfügbar
		else if((preg_match("/^[a-zA-Z0-9öäüÖÄÜß]+$/", $_POST['username']) == 1))
		{
			//Prüfen ob spezifischer uname gefunden wird
			$test=True;
			$search=$_POST['username'];
			$sql="SELECT uname FROM user";
			$run = $con->query($sql);
			while($row=$run->fetch_array())
			{
				if($search==$row['uname']){
					echo "Dieser Benutzername ist bereits vergeben";
					$test=False;
					?>
					<html>
					<link rel="stylesheet" href="chat.css">
					<form action="signup_test.php" method="post">
					<label for="signup">Zurück zur Registrierung:</label>
					<input type="submit" value="zur Registrierung" id="login">
					</form>
					<form action="login_chat_test.php/?seite=login" method="post">
					<p>Oder:</p>
					<label for="login">Zum Login:</label>
					<input type="submit" value="Zum Login" id="login">
					</form>
					</html>
					<?php
					break;
				}
			}			
		}

        //anlegen des neuen Benutzers
		if($test)
		{
			$username=$con->real_escape_string($_POST['username']);
			$pwd=sha1($_POST['password']);
			$pass=$con->real_escape_string($pwd);
			$sql = "INSERT INTO user(uname, pwd)VALUES('$username', '$pass')";
			if($con->query($sql)){
				echo "Sie haben sich erfolgreich registriert.";
			}else{
				echo "ERROR: Anlegen fehlgeschlagen";
			}

			?>
			<html>
			<link rel="stylesheet" href="chat.css">
			<form action="login_chat_test.php" method="post" >
			<input type="submit" value="Zum Login" id="login">
			</form>
			</html>
			<?php
		}
	}
}
else
{
	?>
<html>
<head>
<link rel="stylesheet" href="chat.css">
</head>
<body>
		<form action="chat_test.php" method="post">
			<p>
			<label for="username">Benutzername:</label>
			<input type="text" name="username" required>
			</p>
			<p>
			<label for="password">Passwort:</label>
			<input type="password" name="password" required>
			</p>
			<input type="hidden" name="login" value="hidden">
			<input type="submit" value="Login" id="registrieren">
			</form>
			<p>
			<form action="signup_test.php" method="post" >
			</p>
			<p>Oder:</p>
			<input type="submit" name="zumsignup" value="Zum Registrieren" id="login">
		</form>
</body>
</html>
	<?php 
}

?>