<?php

session_start();

require_once 'database.php';

if ( isset($_SESSION['message'])){
	$message = $_SESSION['message'];
}

if(!empty($_POST['nalog']) && !empty($_POST['lozinka'])):
	
	$records = $conn->prepare('SELECT ID_KORISNIKA,NALOG,LOZINKA,ULOGA FROM korisnici WHERE NALOG = :nalog');
	$records->bindParam(':nalog', $_POST['nalog']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';
    
// checking is password supplied matches password in the database for the supplied user	
	if(count($results) > 0 && password_verify($_POST['lozinka'], $results['LOZINKA']) ){

		$_SESSION['id_korisnika'] = $results['ID_KORISNIKA'];
		$_SESSION['admin'] = $results['ULOGA'];
		
		if ($_SESSION['admin'] == 1){
		   header("Location: http://".$_SERVER['HTTP_HOST']."/akcije/akcije_tabela_admin.php");	
		   }
		else {
			header("Location: http://".$_SERVER['HTTP_HOST']."/akcije/akcije_tabela.php");
		   }

	} else {
		
        
        header("Location: http://".$_SERVER['HTTP_HOST']."/akcije/akcije_tabela.php");
	}

endif;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Logovanje</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'> 
</head>
<body>

	<div class="header">
		<a href="/"><?= $app_name ?></a>
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Prijavi se: </h1>
	 
	
   
	<form action="login.php" method="POST" autocomplete="off" >
		
		<input type="text"  placeholder="nalog" name="nalog" class="center" >
		<input type="password"  placeholder="lozinka" name="lozinka" class="center">

		<input value="Prijavi se" type="submit">

	</form>
   
	
</body>
</html>