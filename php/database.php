<?php // this script provides database information and creates connection with it

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'akcije';

$app_name = 'Aktivisti';
$create_admin = '0';
$app_logo = ' NDMBGD ';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
$conn->query('SET NAMES utf8');
?>