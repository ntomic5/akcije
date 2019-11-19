<?php
// ova strana je zaštićena. Služi za kreiranje nove akcije u bazi
require_once 'zastita.php';
     
if (isset($_POST['naslov']) AND !empty($_POST['naslov'])){
    $records = $conn->prepare('INSERT INTO akcije 
	(NASLOV,OPIS, LOKACIJA, VREME, KONTAKT, BR_TRAZENIH, BR_PRIJAVLJENIH, MASA_YN, ROK, BELESKE)    
    VALUES (:NASLOV, :OPIS, :LOKACIJA, :VREME, :KONTAKT, :BR_TRAZENIH, :BR_PRIJAVLJENIH, :MASA_YN, :ROK, :BELESKE)');
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
    $records->execute();
    
    header("Location: http://".$_SERVER['HTTP_HOST']."/akcije/akcije_tabela_admin.php");
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
    <form action="akcija_nova_admin.php" method="POST">
    <table>
    <tr><td> Naslov: </td><td><input type="text" class="long" name="naslov" value=""></tr></tr>
    <tr><td> Opis: </td><td><textarea rows = "2" name="opis" ></textarea> </tr></tr>
    <tr><td> Lokacija: </td><td><input type="text" class="long" name="lokacija" value=""></tr></tr>
    <tr><td> Vreme: </td><td><input type="text" class="long" name="vreme" value=""></tr></tr>
	<tr><td> Kontakt: </td><td><input type="text" class="long" name="kontakt" value=""></tr></tr>
    
    <tr><td> Broj traženih osoba: </td><td><input type="text" class="short" name="br_trazenih" value="0"></tr></tr>
    <tr><td> Broj prijavljenih: </td><td><input type="text" class="short" name="br_prijavljenih" value="0"></tr></tr>
	<tr><td> Što više to bolje: </td><td><input type="checkbox" name="masa_yn" value="0" ></tr></tr>
    <tr><td> Rok: </td><td><input type="date" name="rok" value="<?php echo date("Y-m-d", strtotime('tomorrow'));?>"> </tr></tr>
    <tr><td> Beleške: </td><td><textarea rows = "2" name="beleske" > </textarea> </tr></tr>
    <tr><td></td> <td><input type="submit" value="Unesi novu akciju"> </td></tr>
    </table>
    <table>
    </div>
</body>
</html>