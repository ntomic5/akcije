<?php 
// this script looks in the database to check if user that is entered into login script is user saved in the database
// this script should be required_once before each page that is accessible only for database users, like this

// require_once 'zastita.php';


require_once 'database.php';

session_start();

if( isset($_SESSION['id_korisnika']) ){

	$records = $conn->prepare('SELECT ID_KORISNIKA,NALOG,LOZINKA,ULOGA FROM korisnici WHERE ID_KORISNIKA = :id_korisnika');
	$records->bindParam(':id_korisnika', $_SESSION['id_korisnika']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}
    
			
}
if( empty($user) ) {
		header("Location: http://".$_SERVER['HTTP_HOST']."/akcije/login.php");
	}
?>
