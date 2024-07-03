<?php require_once('db/conexion.php');
session_start();
include('inc_fechas.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ingresando Pago</title>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
if ( isset($_SESSION['valid_admin']) ) {

		if ( $_POST[cuenta]!="" && $_POST[guardar]=="Guardar" ) {
			//debug echo '<br><b>'.$_POST[guardar].'</b><br>';

			for ( $i=1 ; $i<=100 ; $i++ ) {
				//debug echo '<br>Cta '.$i.')<br>';

				if ( $_POST['cuota_'.$i]>0 ) {
					$sql  =  " INSERT INTO ingresos VALUES (NULL, '".$_POST['plan_pago_'.$i]."'";
					$sql .= ", '".$_POST['cuenta']."'";
					$sql .= ", '".$_POST['cuota_'.$i]."'";

					// Recibe una fecha con formato dd-mm-aaaa y devuelve aaaa-mm-dd.
					$sql .= ", '".mysql_date($_POST['fecha_pago'])."'"; // function mysql_date() by Mich.

					$sql .= ", '".$_POST['forma_pago']."'";
					$sql .= ", '".$_POST['concepto']."'";
					$sql .= ", '".$_POST['factura']."'";
					$sql .= ") ";
					$res = $conn->query($sql);
					//debug echo $sql.'<br>';
				}
				/*//debug echo 'Saldo '.$i.': '.$_POST['saldo_'.$i].'
				  - Pago Cta: '.$_POST['cuota_'.$i].' = Neto: '.($_POST['saldo_'.$i]-$_POST['cuota_'.$i]).'<br>';*/

				// SI saldo>0 (es para evitar update a ya cancelados) Y saldo - cuota = 0 (pone estado de tabla 'ingresos' cancelado)
				if ( $_POST['saldo_'.$i]>0 && ($_POST['saldo_'.$i]-$_POST['cuota_'.$i])==0 ) {

					$update_ppago = " UPDATE plan_pago SET estado = 1 WHERE planpago_id = ".$_POST['plan_pago_'.$i];
					$res_ppago	  = $conn->query($update_ppago);
					//echo 'Estado: Cancelado <br>UPDATE tabla plan_pago<br>';
					//debug echo $update_ppago.'<br><br>';
				}

			}

			$mensaje = "Pago ingresado correctamente.";
		} else {
			$mensaje = "ERROR: el pago NO fue ingresado."; // dejar la palabra ERROR en mayusculas dado que depende de cuentas.php
		} ?>
		<META HTTP-EQUIV="Refresh" CONTENT="0;URL=cuentas.php?id=<?=$_POST[cuenta].'&mensaje='.$mensaje; ?>">
		<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif">
		<a href="cuentas.php?id=<?=$_POST[cuenta].'&mensaje='.$mensaje; ?>">Continuar</a></font></div>
	<?php	exit;
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else { // fin valid_admin
	echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
}?>
</body>
</html>