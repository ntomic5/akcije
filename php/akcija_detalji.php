

<?php
// ova strana nije zasticena. Njena uloga je da prikaze detalje odredjene akcije, nema ažuriranje

require_once 'database.php';

session_start();

// akcije u bazi koje nisu istekle
//
if (isset($_POST['ID_AKCIJE'])){
    $records = $conn->prepare('SELECT ID_AKCIJE, NASLOV, OPIS, LOKACIJA, VREME, KONTAKT, BR_TRAZENIH, BR_PRIJAVLJENIH, MASA_YN, ROK FROM akcije   
                               WHERE ID_AKCIJE = :ID_AKCIJE');
    $records->bindParam(':ID_AKCIJE', $_POST['ID_AKCIJE']);
    $records->execute();

    $akcija = $records->fetch(PDO::FETCH_ASSOC);
}
else {
    header("Location: http://".$_SERVER['HTTP_HOST']."/akcije/akcija_tabela.php");
}
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dobrodošli - <?=$app_name ?> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<?php
    require_once 'toolbar.php';
    
    ?>
    <div class="oglas">
    
    <h3> Akcija: <?= $akcija['NASLOV'] ?></h3>
    <br>
	<?php 
    echo 'Opis: '. $akcija['OPIS'] ;
    
    echo '<br> Lokacija: '.$akcija['LOKACIJA'] ;
    echo '<br> Vreme: '.$akcija['VREME'] ;
    echo '<br> Kontakt: '.$akcija['KONTAKT'] ;
    echo '<br> Broj osoba koje se traže: ';
    if ($akcija['MASA_YN']==1){
        echo 'Što masovnije to bolje';      
    }
    else if ($akcija['BR_PRIJAVLJENIH']!=0){
        echo $akcija['BR_TRAZENIH'].', prijavilo se '.$akcija['BR_PRIJAVLJENIH'];
    }
    else {
            echo $akcija['BR_TRAZENIH'];
    }
    
    $date=date_create($akcija['ROK']);
    echo '<br><br> Rok za prijavu / isticanje akcije: '.date_format($date,"d.m.Y") ;
?>
    </div>
</body>
</html>