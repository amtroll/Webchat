<?php
include_once 'CreateDatabase.php';
$con = new mysqli($servername, $username, $password, $db_name);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>