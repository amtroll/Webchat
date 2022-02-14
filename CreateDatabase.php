<?php
$servername = "localhost";
$db_username = "root";
$password = "test"; //Put your Password here
$db_name = "chat"; //DatabaseName
//Create connection
$con = new mysqli($servername, $db_username, $password);


//Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

//Create Database
$dbname=$con->real_escape_string($db_name);
$sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET latin1";
if ($con->query($sql) === TRUE) {
    //echo "Database ".$db_name." created successfully";
}
else
{
    echo "Error creating database: " . $con->error;
}

$con->close();


$con = new mysqli($servername, $db_username, $password, $db_name);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql="CREATE TABLE IF NOT EXISTS user(uname TEXT(50), pwd TEXT(50))";
if ($con->query($sql) === TRUE) {
    //echo "Table user created successfully";
}
else
{
    echo "Error creating database: " . $con->error;
}
$sql="CREATE TABLE IF NOT EXISTS messages(uname TEXT(50), message TEXT(500), timestamp TEXT(10))";
if ($con->query($sql) === TRUE) {
    ///echo "Table messages created successfully";
}
else
{
    echo "Error creating database: " . $con->error;
}

$con->close();
?>
