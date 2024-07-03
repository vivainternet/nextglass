<?php require_once('db/conexion.php');
session_start();
include('inc_fechas.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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

// if($_POST['procesos'] !='' ){

				$sql  = " SELECT * FROM procesos, empleados, altas, operaciones WHERE ";

			// FILTRA POR ORDEN
			if ( $_POST['ord_b']!=0 )
				$sql .= " procesos.auto = ".$_POST['ord_b']." AND ";	// auto es el alta_id

			// FILTRA POR EMPLEADO
			if ( $_POST['empleado']!=0 )
				$sql .= " procesos.empleado = ".$_POST['empleado']." AND ";

			// FILTRA POR FECHA
			if( $_POST['desde']!='' )	// desde
				$sql .= " procesos.dia >= '".$_POST['desde']."' AND ";
			if( $_POST['hasta']!='' )	// hasta
				$sql .= " procesos.dia <= '".$_POST['hasta']."' AND ";

				$sql .= " procesos.auto = altas.alta_id AND procesos.operacion = operaciones.operaciones_id ";
				$sql .= " AND procesos.empleado = empleados.empleado_id ";

			if( $_POST['ordenar_por']=='ob' )						// ORDER BY ob
				$sql .= " ORDER BY altas.orden ASC, altas.asistencia_t ASC ";

			if( $_POST['ordenar_por']=='empleado' )			// ORDER BY empleado
				$sql .= " ORDER BY empleados.apellido_e ASC, empleados.nombre_e ASC ";

				$res = $conn->query($sql);
				// debug echo $sql; ?>

		<table width="950" border="0" cellpadding="0" cellspacing="3">
				<tr>
					<td height="52" colspan="8" align="center" valign="middle" class="border"><font class="Estilo3"><b>Procesos</b></font></td>
				</tr>
				<tr class="border">
					<td width="170" height="30" valign="middle" class="border"><b>OB - ATO</b></td>
					<td width="149" height="30" valign="middle" class="border"><b>Marca y Modelo</b></td>
					<td width="85" valign="middle" class="border"><b>Dominio</b></td>
					<td width="150" valign="middle" class="border"><b>Empleado</b></td>
					<td width="150" valign="middle" class="border"><b>Operaci&oacute;n</b></td>
					<td width="99" valign="middle" class="border"><b>Ingreso</b></td>
					<td width="100" valign="middle" class="border"><b>Egreso</b></td>
					<td width="70" valign="middle" class="border"><b>Total</b> Hr:Min:Seg</td>
				</tr>

		<?php while($row = $res->fetch_assoc() ) {  ?>
					<tr>
						<td 	height="30"	valign="middle" class="border">
								<?=($row['orden']?'OB '.$row['orden']:'')?> <?=($row['asistencia_t']?'ATO '.$row['asistencia_t']:'')?></td>
						<td 	class="border"><?=$row['marca'].' '.$row['modelo']; ?></td>
						<td 	class="border"><?=$row['matricula']; ?></td>
						<td 	class="border"><?=$row['apellido_e'].' '.$row['nombre_e']; ?></td>
						<td 	class="border"><?=$row['nombre_o']; ?></td>
						<td 	class="border"><?=$row['inicio']; ?></td>
						<td 	class="border"><?=($row['fin']!=0?$row['fin']:'-'); ?></td>
						<td 	class="border"><?=($row['fin']!=0 ? resta_fechas_hora($row['fin'],$row['inicio']) : '-' ); ?></td>
					</tr><?php
				} ?>
		</table>
			<?php
//	}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else { // fin valid_admin
	echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
}  ?>

</body>
</html>
