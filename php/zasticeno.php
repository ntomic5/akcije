<?php

require_once 'zastita.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to your Web App</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
		<a href="/"><?= $app_name ?></a>
	</div>

	<br />Korisnik <?= $user['NALOG']; ?> sa ovlašćenjem administratora 
	<br /><br />Ovo je zaštićena strana kojoj ste pristupili jer ste se prijavili kao korisnik administrator!
	<br /><br />
	<a href="logout.php">odjavite se?</a>

</body>
</html>