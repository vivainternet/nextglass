<?php require_once('db/conexion.php');
session_start(); //$inicio = microtime(true); // test de tiempo de respuesta de la consulta SQL
include('inc_fechas.php');
?>
<!DOCTYPE html>
<html>

<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> --> <!-- Original -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Mauricio Michajtyszyn">

<title>CAPTACION DE PROCESOS</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<?php include('validateform.php');
if ($_GET['id'] != "")   ?>

<script language="javascript" type="text/javascript">
//SALTO ENTRE CAMPOS PULSANDO ENTER
//nombre del primer campo en la secuencia
siguienteCampo = "empleado"
//nombre del formlario
nombreForm = "form1"
//funcion que gestiona el evento
function TeclaPulsada(e) {
	if (window.event != null) //IE4+
	tecla = window.event.keyCode;
	else if (e != null) //N4+ o W3C compatibles
	tecla = e.which;
	else
	return;

	if (tecla == 190) { //si pulso punto teclado alfabetico 190, enter==13, tabulador 9, asterisco 106 no funciona pone, punto teclado numerico 110
	if (siguienteCampo == 'fin') { //fin de la secuencia, hace el submit
		//alert('Envio del formulario.')	//eliminar este alert para uso normal
		return true //sustituir por return true para hacer el submit
	} else { //da el foco al siguiente campo
		eval('document.' + nombreForm + '.' + siguienteCampo + '.focus()')
		return false
	}
	}
	// DEBBUG alert(tecla);
}

document.onkeydown = TeclaPulsada; //asigna el evento pulsacion tecla a la funcion
if (document.captureEvents) //netscape es especial: requiere activar la captura del evento
	document.captureEvents(Event.KEYDOWN)
</script>
<script language="JavaScript" type="text/JavaScript">
<!-- // NO MODIFICAR. LA ULTIMA LINEA RECARGA LA PAGINA RESETEANDOLA SIMIL BOTON reset /////////////////////////
function MM_findObj(n, d) { //v4.01
var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
if (val) { nm=val.name; if ((val=val.value)!="") {
	if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
	if (p<1 || p==(val.length-1)) errors+='- El '+nm+' debe ser v�lido.\n';
	} else if (test!='R') { num = parseFloat(val);
	if (isNaN(val)) errors+='- El '+nm+' debe ser un n�mero.\n';
	if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
		min=test.substring(8,p); max=test.substring(p+1);
		if (num<min || max<num) errors+='- El valor de '+nm+' debe ser un valor entre '+min+' y '+max+'.\n';
} } } else if (test.charAt(0) == 'R') errors += '- '+nm+': es obligatorio.\n'; }
} if (errors) alert('Datos incompletos:\n'+errors);
document.MM_returnValue = (errors == '');
document.refresh();
}
//-->
</script>
<!--<script Language="JavaScript">self.moveTo(0,0);self.resizeTo(screen.availWidth,screen.availHeight);</script>-->
</head>

<body onLoad="document.form1.empleado.focus();">
<div align="center">
<?php
if ($_POST['Grabar'] == "Grabar") {

	//debug
	echo 'Empleado: '.$_POST['empleado'].'<br>Veh&iacute;culo: '.$_POST['vehiculo'].'<br>Proceso: '.$_POST['proceso'];
	//SELLECCINA vehic, empleados, operaciones DE SUS RESPECTIVAS TABLAS
	$sql = "SELECT 	altas.alta_id, altas.marca, altas.modelo, altas.code_a,
					empleados.empleado_id, empleados.nombre_e, empleados.apellido_e,
					operaciones.operaciones_id, operaciones.nombre_o
			FROM	altas, empleados, operaciones
			WHERE 	altas.code_a 				= '$_POST[vehiculo]'
			AND 	empleados.empleado_id		= '$_POST[empleado]'
			AND		operaciones.operaciones_id	= '$_POST[proceso]' ";

	//debug
	echo '<br><br>'.$sql.'<br>';

	$res = $conn->query($sql);
	$row = mysqli_fetch_assoc($res);
	//$numfields = mysqli_num_fields($res); // Cantidad de campos de ESTA consulta SQL.
	$num = mysqli_num_rows($res);

	//debug echo '<br>'.$row[code_a].'<br>'.$row[marca].' '.$row[modelo].' - '.$row[nombre_e].' '.$row[apellido_e].' - '.$row[nombre_o];

	//MUESTRA MENSAJE DE ERROR SI ALGUNO DE LOS DATOS NO CORRESPONDE A UN REGISTRO EN LA BASE DE DATOS
	//DEBBUG echo '<br>mysqli_num_rows($res):'.mysqli_num_rows($res).'<br><br>';
	if ($num == 0) {
	echo "<script>alert('ERROR: DATOS INEXISTENTES DE \\nEMPLEADO VEHICULO O PROCESO.\\n\\nNO SE GRABARAN LOS DATOS.')</script>";
	} elseif ($num > 0) { // ACTUALIZA LOS DATOS DE UN REGISTRO EXISTENTE DE procesos

	$sql_proc = " SELECT * FROM procesos WHERE auto = $row[alta_id] AND empleado = $row[empleado_id]
										AND operacion = $row[operaciones_id] AND fin = '0000-00-00 00:00:00' ";

	$res_proc = $conn->query($sql_proc);
	$num_proc = mysqli_num_rows($res_proc);
	//debugg
	echo 'cantidad de procesos: '.$num_proc;
	if ($num_proc > 0) {

		$sql_proc_update = " UPDATE procesos SET fin = '" . date('Y-m-d H:i:s') . "'
							WHERE auto = $row[alta_id] AND empleado = $row[empleado_id]
							AND operacion = $row[operaciones_id] AND fin = '0000-00-00 00:00:00' ";

		//debug echo '<br><br>'.$sql_proc_update;
		$res_proc_pdate = $conn->query($sql_proc_update);

		//debug echo '<br><br>Affected Rows UPDATE: '.mysql_affected_rows();
		echo '<br><B><U>PROCESO FINALIZADO</U>:</B>';
	} else { //INSERTA UN NUEVO REGISTRO DE PROCESO
		echo '<br><b><u>PROCESO NUEVO</u>: </b>';
		//debug echo '<br>Affectes rows ES CERO';
		$sql_proc_nuevo  = " INSERT INTO procesos VALUES (NULL,'" . $row['empleado_id'] . "'";
		$sql_proc_nuevo .= ", $row[alta_id] ";
		$sql_proc_nuevo .= ", $row[operaciones_id]  ";
		$sql_proc_nuevo  .= ", '" . date('Y-m-d') . "' ";
		$sql_proc_nuevo  .= ", '" . date('Y-m-d H:i:s') . "' ";
		$sql_proc_nuevo  .= ", 0 ";
		$sql_proc_nuevo  .= ", '" . $code . "' ";
		$sql_proc_nuevo  .= ", 1 ";
		$sql_proc_nuevo  .= " ) ";

		$res_proc_nuevo = $conn->query($sql_proc_nuevo);

		//debug		echo '<br>'.$sql_proc_nuevo.'<br>Affected rows INSERT: '. mysql_affected_rows();

	}

	echo "<b>&nbsp;".$row['nombre_o']."&nbsp;</b> &nbsp; | &nbsp; <b>&nbsp;<u>VEHICULO</u>: ".$row['marca']." ".$row['modelo']."</b> &nbsp; | &nbsp; <b><u>EMPLEADO</u>: "
		.$row['nombre_e']." ".$row['apellido_e']."</b>";

/* 	echo '<b>&nbsp;' . $row['nombre_o'] . '&nbsp;</b> &nbsp; | &nbsp; <b>&nbsp;<u>VEHICULO</u>: ' . $row[marca] . ' ' . $row[modelo] . '</b> &nbsp; | &nbsp; <b><u>EMPLEADO</u>: '
		. $row[nombre_e] . ' ' . $row[apellido_e] . '</b>'; */
	}
} // FIN DE Grabar

?>

<form action="home.php" method="post" enctype="application/x-www-form-urlencoded" name="form1" id="form1" onSubmit="MM_validateForm('empleado','','R','vehiculo','','R','proceso','','R');return document.MM_returnValue;
					document.form1.vehiculo.focus();">
	<table width="600" height="380" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
	<tr>
		<td align="center" background="images/fondo_captacion.jpg">
		<table width="450" border="0" align="center" cellpadding="0" cellspacing="0" class="textazul">
			<tr>
			<td width="450">
				<table width="450" height="80" border="0" cellpadding="0" cellspacing="0" class="textazul">
				<tr>
					<td width="27" align="right" valign="top"><img src="images/fecha_borde_L.jpg" width="25" height="80"></td>
					<td width="164" align="center" valign="middle" background="images/fecha_fondo.jpg">
					<font size="+2"><b><?php echo date("G:i:s"); ?></b></font>
					</td>
					<td width="25" valign="top"><img src="images/fecha_borde_D.jpg" width="25" height="80"></td>
					<td width="18" align="center" valign="middle">&nbsp;</td>
					<td width="25" align="right" valign="top"><img src="images/fecha_borde_L.jpg" width="25" height="80"></td>
					<td width="164" align="center" valign="middle" background="images/fecha_fondo.jpg">
					<font size="+2"><b><?php echo date("d/m/Y"); ?></b></font>
					</td>
					<td width="27" valign="top"><img src="images/fecha_borde_D.jpg" width="25" height="80"></td>
				</tr>
				</table>
			</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>

				<h3>Empleado:<br>
				<input name="empleado" id="empleado" type="text" onFocus="siguienteCampo='vehiculo'" size="68">
				</h3>
				<h3>Veh&iacute;culo:<br>
				<input name="vehiculo" id="vehiculo" type="text" onFocus="siguienteCampo='proceso'" size="68">
				</h3>
				<h3>Proceso:<br>
				<input name="proceso" id="proceso" type="text" onFocus="siguienteCampo='Grabar'" size="68"><br>
				</h3>

				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="50%" align="center">
					<input name="Grabar" id="Grabar" value="Grabar" type="submit" class="buttonGrabar">
					</td>
					<td width="50%" align="center">
					<input name="Reset" type="reset" class="buttonReset" value="Borrar">
					</td>
				</tr>
				</table>
			</td>
			</tr>
		</table>
		</td>
	</tr>
	</table>
</form>
</div>
</body>

</html>