

<?php
// ova strana je zasticena. Njena uloga je da omogući unos i ažuriranje odredjene akcije

require_once 'zastita.php';

// akcija iz baze
//
if (isset($_POST['ID_AKCIJE'])){
    $_SESSION['ID_AKCIJE'] = $_POST['ID_AKCIJE'];   
}       

if (isset($_POST['naslov'])){
    $records = $conn->prepare('UPDATE akcije SET NASLOV= :NASLOV, 
    OPIS= :OPIS, LOKACIJA= :LOKACIJA, VREME= :VREME, KONTAKT= :KONTAKT, 
    BR_TRAZENIH= :BR_TRAZENIH, BR_PRIJAVLJENIH= :BR_PRIJAVLJENIH, 
    MASA_YN= :MASA_YN, ROK = :ROK, BELESKE= :BELESKE    
    WHERE ID_AKCIJE = :ID_AKCIJE');
    $records->bindParam(':NASLOV', $_POST['naslov']);
    $records->bindParam(':OPIS', $_POST['opis']);
    $records->bindParam(':LOKACIJA', $_POST['lokacija']);
    $records->bindParam(':VREME', $_POST['vreme']);
    $records->bindParam(':KONTAKT', $_POST['kontakt']);
    $records->bindParam(':BELESKE', $_POST['beleske']);
    if (isset($_POST['masa_yn'])){
        $masa_yn = 1;
        $trazeni = 0;
        $prijavljeni =0;
    }
    else {
        $masa_yn = 0;
        $trazeni = $_POST['br_trazenih'];
        $prijavljeni = $_POST['br_prijavljenih'];

    }
    
    $records->bindParam(':MASA_YN', $masa_yn);
    $records->bindParam(':BR_TRAZENIH', $trazeni);
    $records->bindParam(':BR_PRIJAVLJENIH', $prijavljeni);
    $records->bindParam(':ROK', $_POST['rok']);
    $records->bindParam(':ID_AKCIJE', $_SESSION['ID_AKCIJE']);
    $records->execute();
}

if (isset($_SESSION['ID_AKCIJE'])){
    $records = $conn->prepare('SELECT ID_AKCIJE, NASLOV, OPIS, LOKACIJA, VREME, KONTAKT, BR_TRAZENIH, BR_PRIJAVLJENIH, MASA_YN, ROK, BELESKE FROM akcije   
                               WHERE ID_AKCIJE = :ID_AKCIJE');
    $records->bindParam(':ID_AKCIJE', $_SESSION['ID_AKCIJE']);
    $records->execute();

    $akcija = $records->fetch(PDO::FETCH_ASSOC);
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
    <form action="akcija_detalji_admin.php" method="POST">
    <table>
    <tr><td> Naslov: </td><td><input type="text" class="long" name="naslov" value="<?= $akcija['NASLOV'] ?>"></tr></tr>
    <tr><td> Opis: </td><td><textarea rows = "2" name="opis" ><?= $akcija['OPIS'] ?></textarea> </tr></tr>
    <tr><td> Lokacija: </td><td><input type="text" class="long" name="lokacija" value="<?= $akcija['LOKACIJA'] ?>"></tr></tr>
    <tr><td> Vreme: </td><td><input type="text" class="long" name="vreme" value="<?= $akcija['VREME'] ?>"></tr></tr>
	<tr><td> Kontakt: </td><td><input type="text" class="long" name="kontakt" value="<?= $akcija['KONTAKT'] ?>"></tr></tr>
    
    <tr><td> Broj traženih osoba: </td><td><input type="text" class="short" name="br_trazenih" value="<?= $akcija['BR_TRAZENIH'] ?>"></tr></tr>
    <tr><td> Broj prijavljenih: </td><td><input type="text" class="short" name="br_prijavljenih" value="<?= $akcija['BR_PRIJAVLJENIH'] ?>"></tr></tr>
<?php    
    if ($akcija['MASA_YN']==1){
        echo '<tr><td> Što više to bolje: </td><td><input type="checkbox" name="masa_yn" value="1" checked></tr></tr>';
    } 
    else {
        echo '<tr><td> Što više to bolje: </td><td><input type="checkbox" name="masa_yn" value="0" ></tr></tr>';
    }  
?>
    <tr><td> Rok: </td><td><input type="date" name="rok" value="<?= $akcija['ROK'] ?>"></tr></tr>
    <tr><td> Beleške: </td><td><textarea rows = "2" name="beleske" ><?= $akcija['BELESKE'] ?> </textarea> </tr></tr>
    <tr><td></td> <td><input type="submit" value="Sačuvaj"> </td></tr>
    </table>
    <table>
    </div>
</body>
</html>