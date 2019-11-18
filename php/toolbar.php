<?php // this piece of code provides two different toolbars, one for anybody and one for administrator
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
echo '<div class="header">';
if (isset($_SESSION['admin']) and $_SESSION['admin']==1):
   echo   $app_logo.' <a href="/akcije/logout.php"> [Odjavi se] </a>  <a href="/akcije/akcije_tabela_admin.php"> [Akcije] </a>'.$app_logo;
else:
   echo  $app_logo .' <a href="/akcije/login.php"> [Admin] </a>  <a href="/akcije/akcije_tabela.php"> [Akcije] </a>'.$app_logo;	
endif;
echo	'</div>';


?>