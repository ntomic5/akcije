

<?php
// ova strana je zasticena. Služi da prikaže akcije u bazi koje jos nisu istekle u obliku tabele
// nema nikakvog unosa ili menjanja podataka, 
// ali svaka akcija sadrži link ka drugim stranama, jednan je za ažuriranje
// ima i jedno dugme za unos nove akcije 

require_once 'zastita.php';


// akcije u bazi koje nisu istekle
//
$records = $conn->prepare('SELECT ID_AKCIJE, NASLOV, ROK FROM akcije   
						   WHERE ROK > NOW()-1 ORDER BY ROK ');
$records->execute();
//$param = $records->fetch(PDO::FETCH_ASSOC);

$actions = $records->fetchAll();
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
	<h3> Trenutno aktuelne akcije </h3>
    <form action="akcija_nova_admin.php" method="POST">';
        <input type="submit" name="operation" value="Nova akcija"
    </form> 
    
	<table class="center">
	<tr><th>Akcija</th> <th> Rok </th> <th>Detalji </th> <th>  </th>Ažuriranje</tr>
<?php 
    $akc_no = 0;
    $akc_num = sizeof($actions);


    while ($akc_no < $akc_num){
        $date=date_create($actions[$akc_no]['ROK']);
        echo '<tr><td>'.$actions[$akc_no]['NASLOV'].'</td><td>'.date_format($date,"d.m.Y").'</td><td>';
        // ovde ide dugme
        echo '<form action="akcija_detalji.php" method="POST">';
        echo '<input type="hidden" name="ID_AKCIJE" value= "'.$actions[$akc_no]['ID_AKCIJE'].'">';
        echo '<input type="submit" name="operation" value="Detaljnije">';
        echo '</form> </td><td>';
        
        echo '<form action="akcija_detalji_admin.php" method="POST">';
        echo '<input type="hidden" name="ID_AKCIJE" value= "'.$actions[$akc_no]['ID_AKCIJE'].'">';
        echo '<input type="submit" name="operation" value="Promeni">';
        echo '</form> </td></tr>';
        $akc_no = $akc_no + 1;
    }
    echo '</table>';

?>
</body>
</html>