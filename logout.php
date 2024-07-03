<?php session_start();

// Destruye todas las variables de la sesion
unset($_SESSION['valid_admin']);
unset($_SESSION['filtrocobrador']);
unset($_SESSION['filtroformapago']);
unset($_SESSION['filtroconcepto']);
unset($_SESSION['filtroingresoanual']);
session_unset();
session_destroy();

echo '<title>Saliendo del sistema</title><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Saliendo del Sistema...</font></div>';
echo '<meta http-equiv="refresh" content="0;URL=admin.php">';

exit;
?>