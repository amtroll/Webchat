<?php
setcookie('chat',"",time() - 3600);
echo "Logout abgeschlossen"
?>
<link rel="stylesheet" href="chat.css">
<form action="index.php" method="post">
<input type="submit" name="zumlogin" value="Zurück zum Login" id="login">
</form>