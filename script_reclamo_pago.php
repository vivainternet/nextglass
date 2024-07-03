<?php require_once('db/conexion.php');
session_start();
include('inc_fechas.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ingresando Reclamo de Pago</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<!-- CALENDARIO -->
  <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-system.css" title="System" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar/calendar.js"></script>

  <!-- language for the calendar --><!-- NO ME FUNCIONA EN ESPA�OL. Mich-->
  <script type="text/javascript" src="calendar/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar/calendar-setup.js"></script>
<!-- CALENDARIO FIN-->
</head>
<body><p>&nbsp;</p>
<?php
if ( isset($_SESSION['valid_admin']) ) {

		if ( $_GET[cuenta]!="" && $_POST[guardar]!="Guardar" ) { // MUESTRA EL FORMULARIO
			//debug echo '<br><b>'.$_POST[guardar].'</b><br>';
			$sql = " SELECT * FROM plan_pago WHERE planpago_id = $_GET[planpago]";
			$res = $conn->query($sql);
			$row = $res->fetch_assoc();
			?>
			<form action="script_reclamo_pago.php?cuenta=<?=$_GET[cuenta]?>" method="post" enctype="multipart/form-data">
			  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
				<tr>
				  <td bordercolor="#CCCCCC"><table width="500" border="0" cellspacing="10" cellpadding="0">
					<tr>
					  <td width="130" align="right"><strong>Fecha:</strong></td>
					  <td width="340">
						  <input name="planpago" type="hidden" value="<?=$_GET[planpago]; ?>">

						  <input type="text" name="fecha_reclamo" id="fecha_reclamo" value="<?=date('d-m-Y');?>"
						   size="7" maxlength="10" readonly/>
							<script type="text/javascript">
									Calendar.setup({
										inputField     :    "fecha_reclamo",	// id of the input field
										ifFormat       :    "%d-%m-%Y",			// format of the input field
										button         :    "fecha_reclamo",	// trigger for the calendar (button ID)
										align          :    "Tl",				// alignment (defaults to "Bl")
										singleClick    :    true
									});
							</script>
					  </td>
					</tr>
					<tr>
					  <td align="right" valign="top"><strong>Detalle:</strong></td>
					  <td><textarea name="detalle_reclamo" cols="30" rows="5" id="detalle_reclamo"><?php
					  		echo $row[detalle_reclamo]?></textarea>
					  </td>
					</tr>
					<tr>
					  <td align="right">&nbsp;</td>
					  <td><input name="guardar" type="submit" value="Guardar"></td>
					</tr>
				  </table></td>
				</tr>
			  </table>
			</form>

		<?php
		} elseif ( $_POST[planpago]!="" && $_POST[guardar]=="Guardar" ) { // GUARDA LOS DATOS DEL RECLAMO

				$update_ppago = " UPDATE plan_pago SET fecha_reclamo = '".mysql_date($_POST[fecha_reclamo])."',
								  detalle_reclamo = '$_POST[detalle_reclamo]'
								  WHERE planpago_id = ".$_POST['planpago'];
				$res_ppago	  = $conn->query($update_ppago);
				//debug echo $update_ppago;

				$mensaje = "Reclamo de pago ingresado correctamente.";
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0;URL=cuentas.php?id=<?=$_GET[cuenta].'&mensaje='.$mensaje; ?>">
		<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><p>&nbsp;</p>
		<a href="cuentas.php?id=<?=$_GET[cuenta].'&mensaje='.$mensaje; ?>">Continuar</a></font></div>
		<?php
		} else {
				$mensaje = "ERROR: el reclamo NO fue ingresado."; // dejar la palabra ERROR en mayusculas dado que depende de cuentas.php
				echo 'ERROR';
				exit;
		}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else { // fin valid_admin
	echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
}?>
</body>
</html>