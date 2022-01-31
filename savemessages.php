<?php
/*if (!empty($_GET))     { foreach ($_GET as $key => $value) { $x[$key] = $value; if(!is_array($x[$key])) $x[$key] = trim($x[$key]); }}
elseif (!empty($_POST)) { foreach ($_POST as $key => $value) { $x[$key] = $value; if(!is_array($x[$key])) $x[$key] = trim($x[$key]); }}*/
include_once 'config.php';
if(isset($_POST['action']))
{
	$name=$_REQUEST['name'];
	$message=$_REQUEST['message'];
	if((preg_match("/^[a-zA-Z0-9öäüÖÄÜß]+$/", $name) == 1))	
	{
		$message = str_replace("\n", "(||)", $message);
		$message=str_replace(";", "\?]}", $message);
		$timestamp=time();
		// Nachrichten in Datenbank
		if(!empty($name)&& !empty($message))
		{
			$username=$con->real_escape_string($name);
			$msg=$con->real_escape_string($message);
			$dt=$con->real_escape_string($timestamp);
			$sql = "INSERT INTO messages(uname,message,timestamp)VALUES('$username', '$msg', '$dt')";
			if($con->query($sql)){
				;
			}else{
				echo "ERROR: Message not sent!";
			}
		}
		else 
		{
			echo "Bitte füllen sie alle Felder aus.";
		}
	}
	else 
	{
		echo "Bitte verwenden sie keine Sonderzeichen.";
	}
}
?>