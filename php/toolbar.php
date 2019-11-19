<?php // this piece of code provides two different toolbars, one for anybody and one for administrator
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
echo '<div class="header">';
if (isset($_SESSION['admin']) and $_SESSION['admin']==1):
   echo  ' <a class="block2" href="/akcije/logout.php"> Odjavi se </a> &nbsp &nbsp <a class="block1" href="/akcije/akcije_tabela_admin.php"> Akcije </a>';
else:
   echo  '<a class="block2" href="/akcije/login.php"> Admin </a> &nbsp &nbsp <a class="block1" href="/akcije/akcije_tabela.php"> Akcije </a>';	
endif;
echo	'</div>';
echo '<img src="./assets/images/patkica.png" class="patkica">';


?>