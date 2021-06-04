<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$databasename = 'dreamland';

$conn = mysqli_connect ($servername, $username, $password, $databasename);

if(mysqli_connect_errno()){
	die('Connection Error'); //you want to show what in the script
	}



?>
