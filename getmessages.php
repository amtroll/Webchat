<?php
include_once 'config.php';
$username=$_SESSION['user'];
?>
<html>
<div class="tf">
<?php 
$query = "SELECT * FROM messages";
$run = $con->query($query);
$i = 0;
while($row = $run->fetch_array()):
	if($row['uname']!=$username)
	{
		?>
		<div class="container_theres">
			<div class="name">
			<?php 
			$tsmp = $row['timestamp'];
			echo $row['uname']. " " .date("d-m-Y H:i", $row['timestamp']); //username, timestamp
			?>
			</div><br />
			<div class="message">
			<?php 
			$messages=str_replace("(||)", "<br />", $row['message']);
			$messages=str_replace("\?]}", ";", $messages);
			echo $messages; //Nachrichteninhalt
			?>
			</div>
		</div>
		<?php 
	}

	else if($row['uname']==$username)
	{
		?>
		<div class="container_mine">
			<div class="name">
			<?php 
			echo $row['uname']. " " .date("d-m-Y H:i", $row['timestamp']);//.date("H:i", $message[1])
			?>
			</div><br />
			<div class="message">
			<?php 
			$messages=str_replace("(||)", "<br />", $row['message']);
			$messages=str_replace("\?]}", ";", $messages);
			echo $messages;
			?>
			</div>
		</div>
		<?php
		
	}
endwhile;

?>
</div>
</html>
<?php
?>