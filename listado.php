<?php require_once('db/conexion.php'); session_start(); include('inc_fechas.php'); ?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Listados</title>
<link href="styles.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.Estilo1 {font-size: 24px}
.border {
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #000000;
}
.Estilo3 {
	font-size: 18;
	font-weight: bold;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #000000;
}
.Estilo5 {font-size: 24px; font-weight: bold; }
-->
</style>
</head>

<body>
<?php
if ( isset($_SESSION['valid_admin']) ) {

 if($_POST['tipo'] =='operaciones' ){ ?>
		<?php
		$sql 	 = "SELECT * FROM operaciones WHERE publico_o=1 ORDER BY nombre_o ASC";
		$result = $conn->query($sql);
		?>
		<table width="770" border="0" cellpadding="0" cellspacing="0">
				<tr class="border">
   				<td width="250" height="30" valign="middle" class="Estilo3">&nbsp;</td>
    			<td width="520" height="30" valign="middle" class="Estilo3"><font> Operaci&oacute;n</font></td>
  			</tr><?php
		  while($row = mysqli_fetch_array($result)) {  ?>
			  <tr>
					<td class="Estilo3">
						<img src='barcode/image.php?code=<?=$row['operaciones_id']?>.&style=196&type=C128B&width=200&height=100&xres=2&font=5'>
					</td>
					<td class="Estilo3"><?=strtoupper($row['nombre_o']);?>&nbsp;</td>
			  </tr><?php
		  } ?>
		</table><?php
	}


 if($_POST['tipo'] =='empleados' ){

		$sql = "SELECT * FROM empleados WHERE publico_e=1 ORDER BY apellido_e ASC";
		$result = $conn->query($sql);
		//$i = 1; ?>
		<table width="770" border="0" cellpadding="0" cellspacing="0">
		  <tr>
    		 <td height="40" valign="middle" class="Estilo3">&nbsp;</td>
		     <td colspan="3" valign="middle" class="Estilo3"><font>Empleados</font></td>
			</tr>
			<tr class="border">
     		<td width="250" height="30" valign="middle" class="Estilo3">&nbsp;</td>
				<td width="200" height="30" valign="middle" class="Estilo3"><font> Apellido </font></td>
				<td width="200" valign="middle" class="Estilo3"><font>Nombre</font></td>
				<td width="120" valign="middle" class="Estilo3"><font>DNI</font></td>
			</tr><?php
			while($row = mysqli_fetch_array($result)) {  ?>
				<tr>
					<td valign="middle" class="Estilo3">
					<img src="./barcode/image.php?code=<?=$row['empleado_id']?>.&style=196&type=C128B&width=200&height=100&xres=2&font=5" border="0">
					</td>
					<td valign="middle" class="Estilo3"><?=strtoupper($row['apellido_e']);?>&nbsp;</td>
					<td valign="middle" class="Estilo3"><?=strtoupper($row['nombre_e']);?>&nbsp;</td>
					<td valign="middle" class="Estilo3"><?=$row['dni_e'];?>&nbsp;</td>
				</tr><?php
  		} ?>
		</table><?php
	}


 if($_POST['tipo'] =='autos' ){

		$sql 		= "SELECT * FROM altas where publico_a=1 order by marca asc";
		$result = $conn->query($sql);
		//debug echo $sql;
	 	?>
			<table width="770" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="40" colspan="4" align="center" valign="middle" class="Estilo3"><font>Veh&iacute;culos</font></td>
				</tr>
				<tr>
					<td width="455" height="30" align="center" valign="middle" class="Estilo3">&nbsp;</td>
					<td width="105" height="30" valign="middle" class="Estilo3">Marca</td>
					<td width="105" valign="middle" class="Estilo3">Modelo</td>
					<td width="105" valign="middle" class="Estilo3">Dominio</td>
				</tr><?php
				while($row = mysqli_fetch_array($result)) {  ?>
					<tr>
						<td valign="middle" class="Estilo3">

						<img src="barcode/image.php?code=<?=$row['code_a']?>.&style=196&type=C128B&width=460&height=100&xres=2&font=5" border="0">

						</td>
						<td valign="middle" class="Estilo3"><?=strtoupper($row['marca']);?></td>
						<td valign="middle" class="Estilo3"><?=strtoupper($row['modelo']);?></td>
						<td valign="middle" class="Estilo3"><?=strtoupper($row['matricula']);?></td>
					</tr><?php
				} ?>
			</table><?php
 }

 if($_POST['tipo'] =='acciones' ){ ?>
		<table width="770" border="0" cellpadding="0" cellspacing="0">
				<tr class="border">
   				<td width="250" height="30" valign="middle" class="Estilo3">&nbsp;</td>
    			<td width="520" height="30" valign="middle" class="Estilo3"><font> Acci&oacute;n</font></td>
  			</tr>
			  <tr>
					<td height="200" class="Estilo3">
						<img src='barcode/image.php?code=GUARDAR .&style=196&type=C128B&width=460&height=100&xres=2&font=5'>					</td>
					<td class="Estilo3">GUARDAR</td>
			  </tr>

			  <tr>
					<td height="200" class="Estilo3">
						<img src='barcode/image.php?code=BORRAR .&style=196&type=C128B&width=460&height=100&xres=2&font=5'>					</td>
					<td class="Estilo3">BORRAR</td>
			  </tr>
		</table><?php
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else { // fin valid_admin
	echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
}  ?>
</body>
</html>
