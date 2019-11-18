<?php

session_start();

if( isset($_SESSION['id_korisnika']) ){
	header("Location: /");
}

require 'database.php';

$message = '';

if(!empty($_POST['nalog']) && !empty($_POST['lozinka'])):
	
	// is password entered twice in the same way
	if($_POST['lozinka'] != $_POST['lozinka2']):
	   $message = 'Lozinka nije ispravno potvrđena';
	else:
		// Enter the new user in the database
		$sql = "INSERT INTO korisnici (NALOG, LOZINKA) VALUES (:nalog, :lozinka)";
		$stmt = $conn->prepare($sql);

		$stmt->bindParam(':nalog', $_POST['nalog']);
		$ph = password_hash($_POST['lozinka'], PASSWORD_BCRYPT);
		$stmt->bindParam(':lozinka', $ph);

		if( $stmt->execute() ):
			$message = 'Kreiran novi korisnik';
		else:
			$message = 'Desio se problem, korisnik nijekreiran';
		endif;
	endif;
endif;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Below</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='//fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
		<a href="/"><?= $app_name ?></a>
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Registruj se</h1>
	<span>ili se <a href="login.php">uloguj ovde</a></span>

	<form action="register.php" method="POST">
		
		<input type="text" placeholder="Nalog" name="nalog">
		<input type="password" placeholder="lozinka" name="lozinka">
		<input type="password" placeholder="potvrda lozinke" name="lozinka2">
		<input type="submit" value="Prihvati">

	</form>

</body>
</html>