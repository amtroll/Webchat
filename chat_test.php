<?php
include_once 'config.php';

SESSION_START();
if(isset($_POST["login"]))
{
	if(isset($_COOKIE["chat"]))
	{
		$userdata = explode ("||", $_COOKIE["chat"]);
	}
	else if(!isset($_COOKIE["chat"]))
	{
		$user=$_POST['username'];   
		$password=$_POST['password'];
		$userdata = array($user, $password);
		
	}
	$username = $userdata[0];
	$password =$userdata[1];
	$pass = sha1($password);

	$test=True;
	$search=$_POST['username'];
	$uname =$con->real_escape_string($_POST['username']);
	$sql="SELECT * FROM user WHERE uname = '$uname'";
	$run = $con->query($sql);
	$row = $run->fetch_array();
	
//$row_cnt = $row->num_rows;
	/*if($row->num_rows == null){
		echo "Benutzername existiert nicht. Versuchen Sie es bitte erneut.<br>";
		?>
		<link rel="stylesheet" href="chat.css">
		<form action="login_chat_test.php" method="post">
		<input type="submit" name="tologin" value="Zurück zum Login" id="login">
		</form>
		<?php
	}
	else*/ if($row['pwd']==$pass) 
	{
		$_SESSION['user']=$username;
		if(!isset($_COOKIE["chat"]))
		{
			$userdata =  implode ("||", $userdata);
			setcookie("chat",$userdata,0);
			header('Location: chat_test.php');
		}
	}
	else
	{
		echo "Ihr Benutzername oder Passwort ist falsch. Versuchen Sie es bitte erneut.<br>";
		?>
		<link rel="stylesheet" href="chat.css">
		<form action="login_chat_test.php" method="post">
		<input type="submit" name="tologin" value="Zurück zum Login" id="login">
		</form>
		<?php
	}
}
if(isset($_COOKIE["chat"]))
{
	
	?>
	<?php require 'savemessages.php';?>
	<?php require 'getmessages.php';?>
	<html>
	<head>
	<title>M&M</title>
	<link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Motorola_M_symbol_black.svg/2000px-Motorola_M_symbol_black.svg.png">
		<link rel="stylesheet" href="chat.css">
	</head>
	
	<body>
	<div class="logout">
		<form action="logout_chat.php" method="post">
			<input type="submit" name="logout" value="logout">
		</form>
	</div>
		<div class="input">
			<form method="POST">
				<input type="hidden" name="action">	
				<p>
					<label for="name"></lable>
				</p>
				<p>
					<input type="text" id="name" name="name" value="<?=$username?>" readonly>
				</p>
				<p>
					<textarea cols=30 rows=5 maxlength="500" name="message" required></textarea>
					<button type="submit">senden</button>
				</p>
			</form>
		</div>
		</body>
	</html>
	<?php
}
else
{
	echo "Sie sind noch nicht angemeldet.<br />";
	?>
	<link rel="stylesheet" href="chat.css">
	<form action="login_chat_test.php" method="post">
	<input type="submit" name="tologin" value="Zum Login" id="login">
	</form>
	<?php
}
?>