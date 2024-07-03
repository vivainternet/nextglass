<?php require_once('db/conexion.php');
session_start();
include('inc_fechas.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Veh&iacute;culos</title>
	<link href="styles.css" rel="stylesheet" type="text/css">

	<?php include('validateform.php');

	if ($_GET['id'] != "") // muestra la empleado seleccionada
	?>

	<!-- CALENDARIO -->
	<!-- calendar stylesheet -->
	<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-system.css" title="System" />

	<!-- main calendar program -->
	<script type="text/javascript" src="calendar/calendar.js"></script>

	<!-- language for the calendar --><!-- NO ME FUNCIONA EN ESPA�OL. Mich-->
	<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>

	<!-- the following script defines the Calendar.setup helper function, which makes adding a calendar a matter of 1 or 2 lines of code. -->
	<script type="text/javascript" src="calendar/calendar-setup.js"></script>
	<!-- CALENDARIO FIN-->

	<!-- MOSTRAR ELEMENTOS DEL FORM (solo muestra Inputs y Botones -->
	<script language="JavaScript" type="text/JavaScript">
		function MostrarElementosForm(numformulario){ // by Mich. numformulario numero de la matriz del formularios por ej. forms[0], forms[1]
	for ( var i=0; i < document.forms[numformulario].elements.length; i++ ){
		var elemento = document.forms[numformulario].elements[i].style.visibility = "visible";
		if ( elemento.type=="text" ) {
			elemento.visibility = visible
		}
	}
}

function mOvr(src,clrOver) {
  if (!src.contains(event.fromElement)) {
  src.bgColor = clrOver;
  src.borderColor = '';
  }
}

function mOut(src,clrIn) {
  if (!src.contains(event.toElement)) {
    src.style.cursor = 'default';
	src.bgColor = clrIn;
	src.borderColor = '';
  }
}

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

</script>

	<!-- SALTO ENTRE CAMPOS PULSANDO ENTER -->
	<script language="javascript" type="text/javascript">
		<!--
		//nombre del primer campo en la secuencia
		siguienteCampo = "cuota_1"

		//nombre del formlario
		nombreForm = "ingresos"

		//funcion que gestiona el evento
		function TeclaPulsada(e) {
			if (window.event != null) //IE4+
				tecla = window.event.keyCode;
			else if (e != null) //N4+ o W3C compatibles
				tecla = e.which;
			else
				return;

			if (tecla == 13) { //se pulso enter
				if (siguienteCampo == 'fin') { //fin de la secuencia, hace el submit
					alert('Envio del formulario.') //eliminar este alert para uso normal
					return false //sustituir por return true para hacer el submit
				} else { //da el foco al siguiente campo
					eval('document.' + nombreForm + '.' + siguienteCampo + '.focus()')
					return false
				}
			}
		}

		document.onkeydown = TeclaPulsada; //asigna el evento pulsacion tecla a la funcion
		if (document.captureEvents) //netscape es especial: requiere activar la captura del evento
			document.captureEvents(Event.KEYDOWN)

		function MM_findObj(n, d) { //v4.01
			var p, i, x;
			if (!d) d = document;
			if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
				d = parent.frames[n.substring(p + 1)].document;
				n = n.substring(0, p);
			}
			if (!(x = d[n]) && d.all) x = d.all[n];
			for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
			for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
			if (!x && d.getElementById) x = d.getElementById(n);
			return x;
		}

		function MM_validateForm() { //v4.0
			var i, p, q, nm, test, num, min, max, errors = '',
				args = MM_validateForm.arguments;
			for (i = 0; i < (args.length - 2); i += 3) {
				test = args[i + 2];
				val = MM_findObj(args[i]);
				if (val) {
					nm = val.name;
					if ((val = val.value) != "") {
						if (test.indexOf('isEmail') != -1) {
							p = val.indexOf('@');
							if (p < 1 || p == (val.length - 1)) errors += '- ' + nm + ' must contain an e-mail address.\n';
						} else if (test != 'R') {
							num = parseFloat(val);
							if (isNaN(val)) errors += '- ' + nm + ' must contain a number.\n';
							if (test.indexOf('inRange') != -1) {
								p = test.indexOf(':');
								min = test.substring(8, p);
								max = test.substring(p + 1);
								if (num < min || max < num) errors += '- ' + nm + ' must contain a number between ' + min + ' and ' + max + '.\n';
							}
						}
					} else if (test.charAt(0) == 'R') errors += '- ' + nm + ' is required.\n';
				}
			}
			if (errors) alert('The following error(s) occurred:\n' + errors);
			document.MM_returnValue = (errors == '');
		}
		//
		-->
	</script>
</head>

<body>
	<?php
if (isset($_SESSION['valid_admin'])) { ?>

		<?php include('menu.php'); ?>
		<table width="780" border="0" align="center" cellpadding="0" cellspacing="0" id="buscar">
			<tr>
				<form action="altas.php" name="buscarmatricula" method="post" enctype="application/x-www-form-urlencoded">
					<td width="76" height="50"><span class="buscarLegend">Matr&iacute;cula:</span><br>
						<input name="buscarmatricula" type="text" class="inputBuscar" value="<?= $_POST['buscarmatricula'] ?>" size="15">
					</td>
				</form>
				<form action="altas.php" name="buscarmarca" method="post" enctype="application/x-www-form-urlencoded">
					<td width="235"><span class="buscarLegend">Buscar por Marca:</span><br>
						<input name="buscarmarca" type="text" class="inputBuscar" size="35" maxlength="40" value="<?= $_POST['buscarmarca'] ?>">
					</td>
				</form>
				<form action="altas.php" name="buscarClienteID" method="post" enctype="application/x-www-form-urlencoded">
				</form>
				<form action="altas.php" name="buscarCliente" method="post" enctype="application/x-www-form-urlencoded">
				</form>
				<?php if ($_POST['save'] == 'Guardar') {

					if ($HTTP_POST_FILES['file']['name'] != '') {
						$imagen_home = $HTTP_POST_FILES['file']['name'];
						//debbug
						//echo 'max + 1 ='.$id_imagen;
						//$DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];
						$nombre_archivo2 = "images/vehic/" . $imagen_home; // agrega el ID al nombre de la imagen
						//$imagen_home = $id_imagen.'_'.$nombre_archivo; // agrega el ID al nombre de la imagen
						//debugg
						//echo '<br>'.$nombre_archivo;
						//echo '<br>'.$imagen_home;


						// si la imagen se carg� correctamente inserta los datos en la tabla
						move_uploaded_file($HTTP_POST_FILES['file']['tmp_name'], $nombre_archivo2);
						/////////////////////////////////////////////////////
						//// RESIZE_IMAGE
						$image = "images/vehic/" . $imagen_home;

						if (!$max_width)
							$max_width = 200;
						if (!$max_height)
							$max_height = 200;
						$size = GetImageSize($image);
						$width = $size[0];
						$height = $size[1];

						$x_ratio = $max_width / $width;
						$y_ratio = $max_height / $height;

						if (($width <= $max_width) && ($height <= $max_height)) {
							$tn_width = $width;
							$tn_height = $height;
						} else if (($x_ratio * $height) < $max_height) {
							$tn_height = ceil($x_ratio * $height);
							$tn_width = $max_width;
						} else {
							$tn_width = ceil($y_ratio * $width);
							$tn_height = $max_height;
						}


						////////////////
						//echo $imagen;
						$origen  = "images/vehic/" . $imagen_home;
						$destino = "images/vehic/" . $imagen_home;


						$destino_temporal = tempnam("tmp/", "tmp");

						redimensionar_jpeg($origen, $destino_temporal, $tn_width, $tn_height, 100);

						// guardamos la imagen
						$fp = fopen($destino, "w");
						fputs($fp, fread(fopen($destino_temporal, "r"), filesize($destino_temporal)));
						fclose($fp);

						// mostramos la imagen
						//echo "<img src='images/nuevaimagen.jpg'>";
						//////////////////////////////////////////

					}

					// CREA EL $codigo PARA EL CAMPO code_a
					if ($_POST['orden'] != '' && $_POST['asistencia_t'] != '') {
						$codigo = 'OB ' . $_POST['orden'] . ' ATO ' . $_POST['asistencia_t']; //.' '.strtoupper($_POST[marca]);

					} elseif ($_POST['orden'] != '') {
						$codigo = 'OB ' . $_POST['orden']; //.' '.strtoupper($_POST[marca]);

					} elseif ($_POST['asistencia_t'] != '') {
						$codigo = 'ATO ' . $_POST['asistencia_t']; //.' '.strtoupper($_POST[marca]);
					}

					$sql  = " INSERT INTO altas VALUES ('NULL'";
					$sql .= ", UPPER('" . $_POST['orden'] . "')";
					$sql .= ", 			 '" . $_POST['asistencia_t'] . "'";
					$sql .= ", UPPER('" . $_POST['marca'] . "')";
					$sql .= ", UPPER('" . $_POST['modelo'] . "')";
					$sql .= ", 			 '" . $_POST['anio'] . "'";
					$sql .= ", UPPER('" . $_POST['chasis'] . "')";
					$sql .= ", UPPER('" . $_POST['motor'] . "')";
					$sql .= ", UPPER('" . $_POST['matricula'] . "')";
					$sql .= ", UPPER('" . $_POST['combustible'] . "')";
					$sql .= ", UPPER('" . $_POST['color'] . "')";
					$sql .= ", UPPER('" . $_POST['nivel_brindaje'] . "')";
					$sql .= ", UPPER('" . $_POST['multa'] . "')";
					$sql .= ", UPPER('" . $_POST['renar'] . "')";
					$sql .= ", 			 '" . $_POST['f_ingreso'] . "'";
					$sql .= ", 			 '" . $_POST['f_entrega'] . "'";
					$sql .= ", 			 '" . $_POST['cinta'] . "'";
					$sql .= ", 			 '" . $_POST['techo'] . "'";
					$sql .= ", 			 '" . $_POST['sirena_s'] . "'";
					$sql .= ", 			 '" . $_POST['sirena_c'] . "'";
					$sql .= ", 			 '" . $_POST['tanque_blindado'] . "'";
					$sql .= ", 			 '" . $_POST['run_flat'] . "'";
					$sql .= ", 			 '" . $_POST['piso_b'] . "'";
					$sql .= ", 			 '" . $_POST['com_motor'] . "'";
					$sql .= ", 			 '" . $_POST['cob_bateria'] . "'";
					$sql .= ", 			 '" . $_POST['filtro_aire'] . "'";
					$sql .= ", 			 '" . $_POST['techo_trans'] . "'";
					$sql .= ", UPPER('" . $_POST['color_vidrios'] . "')";
					$sql .= ", 			 '" . $_POST['num_llanta'] . "'";
					$sql .= ", UPPER('" . $_POST['vendedor'] . "')";
					$sql .= ", 			 '" . $_POST['vehi_taller'] . "'";
					$sql .= ", 			 '" . $codigo . "'";
					$sql .= ", 			 '" . $imagen_home . "'";
					$sql .= ", '1'";
					$sql .= " ) ";

					$res = $conn->query($sql);
					//echo $sql;
					echo '<div align="center"><strong><br>Registro Ingresado.</strong></div>';
				}

				if ($_POST['modificar'] == 'Modificar') {

					if ($HTTP_POST_FILES['file']['name'] != '') {
						$imagen_home = $HTTP_POST_FILES['file']['name'];
						//debbug
						$nombre_archivo2 = "images/vehic/" . $imagen_home; // agrega el ID al nombre de la imagen
						//echo '<br>'.$imagen_home;

						if (move_uploaded_file($HTTP_POST_FILES['file']['tmp_name'], $nombre_archivo2)) {
							/////////////////////////////////////////////////////
							//// RESIZE_IMAGE
							$image = "images/vehic/" . $imagen_home;

							if (!$max_width)
								$max_width = 200;
							if (!$max_height)
								$max_height = 200;
							$size = GetImageSize($image);
							$width = $size[0];
							$height = $size[1];

							$x_ratio = $max_width / $width;
							$y_ratio = $max_height / $height;

							if (($width <= $max_width) && ($height <= $max_height)) {
								$tn_width = $width;
								$tn_height = $height;
							} else if (($x_ratio * $height) < $max_height) {
								$tn_height = ceil($x_ratio * $height);
								$tn_width = $max_width;
							} else {
								$tn_width = ceil($y_ratio * $width);
								$tn_height = $max_height;
							}


							////////////////
							//echo $imagen;
							$origen  = "images/vehic/" . $imagen_home;
							$destino = "images/vehic/" . $imagen_home;

							$destino_temporal = tempnam("tmp/", "tmp");

							redimensionar_jpeg($origen, $destino_temporal, $tn_width, $tn_height, 100);

							// guardamos la imagen
							$fp = fopen($destino, "w");
							fputs($fp, fread(fopen($destino_temporal, "r"), filesize($destino_temporal)));
							fclose($fp);

							// mostramos la imagen
							//echo "<img src='images/nuevaimagen.jpg'>";
							//////////////////////////////////////////Borra imagen anterior
							if ($_POST['imagen_a'] != '') {

								$archi = "images/vehic/" . $_POST['imagen_a'];
								if (file_exists($archi)) {
									unlink($archi);
									clearstatcache();
								}
							}
						}
					} else {
						$imagen_home = $_POST['imagen_a'];
					}


					// CREA EL $codigo PARA EL CAMPO code_a
					if ($_POST['orden'] != '' && $_POST['asistencia_t'] != '') {
						$codigo = 'OB ' . $_POST['orden'] . ' ATO ' . $_POST['asistencia_t']; //.' '.strtoupper($_POST[marca]);

					} elseif ($_POST['orden'] != '') {
						$codigo = 'OB ' . $_POST['orden']; //.' '.strtoupper($_POST[marca]);

					} elseif ($_POST['asistencia_t'] != '') {
						$codigo = 'ATO ' . $_POST['asistencia_t']; //.' '.strtoupper($_POST[marca]);
					}

					$sql  =  " UPDATE  altas SET ";
					$sql .= "  orden 				= 			'" . $_POST['orden'] . "'";
					$sql .= ", asistencia_t = 			'" . $_POST['asistencia_t'] . "'";
					$sql .= ", marca 				= UPPER('" . $_POST['marca'] . "')";
					$sql .= ", modelo				= UPPER('" . $_POST['modelo'] . "')";
					$sql .= ", anio					= 			'" . $_POST['anio'] . "'";
					$sql .= ", chasis				= UPPER('" . $_POST['chasis'] . "')";
					$sql .= ", motor				= UPPER('" . $_POST['motor'] . "')";
					$sql .= ", matricula		= UPPER('" . $_POST['matricula'] . "')";
					$sql .= ", combustible	= UPPER('" . $_POST['combustible'] . "')";
					$sql .= ", color				= UPPER('" . $_POST['color'] . "')";
					$sql .= ", nivel_brindaje = UPPER('" . $_POST['nivel_brindaje'] . "')";
					$sql .= ", multa				= UPPER('" . $_POST['multa'] . "')";
					$sql .= ", renar				= UPPER('" . $_POST['renar'] . "')";
					$sql .= ", f_ingreso		=				'" . $_POST['f_ingreso'] . "'";
					$sql .= ", f_entrega		=				'" . $_POST['f_entrega'] . "'";
					$sql .= ", cinta				=				'" . $_POST['cinta'] . "'";
					$sql .= ", techo				=				'" . $_POST['techo'] . "'";
					$sql .= ", sirena_s			=				'" . $_POST['sirena_s'] . "'";
					$sql .= ", sirena_c			=				'" . $_POST['sirena_c'] . "'";
					$sql .= ", tanque_blindado =		'" . $_POST['tanque_blindado'] . "'";
					$sql .= ", run_flat			=				'" . $_POST['run_flat'] . "'";
					$sql .= ", piso_b				=				'" . $_POST['piso_b'] . "'";
					$sql .= ", com_motor		=				'" . $_POST['com_motor'] . "'";
					$sql .= ", cob_bateria	=				'" . $_POST['cob_bateria'] . "'";
					$sql .= ", filtro_aire	=				'" . $_POST['filtro_aire'] . "'";
					$sql .= ", techo_trans	=				'" . $_POST['techo_trans'] . "'";
					$sql .= ", color_vidrios = UPPER('" . $_POST['color_vidrios'] . "')";
					$sql .= ", num_llanta		=				'" . $_POST['num_llanta'] . "'";
					$sql .= ", vendedor			= UPPER('" . $_POST['vendedor'] . "')";
					$sql .= ", vehi_taller	=				'" . $_POST['vehi_taller'] . "'";
					$sql .= ", code_a				=				'" . $codigo . "'";
					$sql .= ", imagen_a			=				'" . $imagen_home . "'";
					$sql .= " WHERE alta_id 	=				" . $_POST['id_modificar'];

					$res = $conn->query($sql);
					//echo $sql;
					echo '<div align="center"><strong><br>Registro Modificado.</strong></div>';
				}

				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if ($_POST['si'] == 'Si') {
					$sql_p = " UPDATE altas SET publico_a = '0' WHERE alta_id = " . $_POST['id_baja'];
					$res_p = $conn->query($sql_p);
					//echo $sql_p;
					echo '<div align="center"><strong><br>Registro Borrado.</strong></div>';
				}	?>
				<td width="390"><?php if (substr($_GET['mensaje'], 0, 5) == "ERROR") $color_error = "#FF0000"; // pone el mensaje de ERROR en rojo
												?>
					<font color="<?= $color_error; ?>">&nbsp;<b><?= $_GET['mensaje']; ?></b></font>
				</td>
			</tr>
		</table>

		<?php if ($_POST['baja'] == 'Baja') { ?>

			<form action="altas.php?menu=<?= $_GET['menu'] ?>" method="post" name="bajaVehic" id="bajaVehic">
				<table width="313" align="center">
					<tr>
						<td width="305">
							<fieldset>
								<font color="#FF0000"><b><br>
										&nbsp;&nbsp;Confirma la Baja del Veh&iacute;culo:<br>
										&nbsp;&nbsp;<?= $_POST['marca']; ?> <?= $_POST['modelo']; ?>
										<br>&nbsp; Matr&iacute;cula: <?= $_POST['matricula']; ?>
										<input name="id_baja" type="hidden" id="id_baja" value="<?= $_POST['id_modificar']; ?>">
									</b></font><br><br>
								<table width="65%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td width="50%" height="30" align="center" valign="middle"><input name="Submit" type="submit" id="Submit" value="No"></td>
										<td width="50%" height="30" align="center" valign="middle"><input name="si" type="submit" id="btnBajaSi" value="Si"></td>
									</tr>
								</table>
							</fieldset>
						</td>
					</tr>
				</table>
			</form>
		<?php } ?>
		<br>
		<?php if ($_GET['alta'] == 'n') {
			if ($_GET['id'] != '') {
				$sql_alta = "	SELECT * FROM altas WHERE altas.alta_id = " . $_GET['id']; // NO HACE FALTA OPTIMIZAR XQ FILTRA UN SOLO REGISTRO

				$res_alta = $conn->query($sql_alta);
				$row_alta = $res_alta->fetch_assoc();
			} ?>

			<form action="altas.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="MM_validateForm('modelo','','R');return document.MM_returnValue">
				<input name="id_modificar" type="hidden" id="id_modificar" value="<?= $_GET['id']; ?>">
				<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="3">&nbsp;&nbsp;&nbsp;<img src="images/text_AltaoModdeVeh.jpg" width="228" height="15"></td>
					</tr>
					<tr>
						<td width="30"><img src="images/esq_si.jpg" width="30" height="30"></td>
						<td width="720" background="images/borde_s.jpg"></td>
						<td width="30"><img src="images/esq_sd.jpg" width="30" height="30"></td>
					</tr>
					<tr>
						<td background="images/borde_iz.jpg"></td>
						<td bgcolor="#E4E9ED">
							<table width="100%" class="textazul">
								<tr>
									<td width="25%" align="right"><u>ORDEN DE BLINDAJE</u>:</td>
									<td width="24%">
										<input name="orden" type="text" id="orden" style="font-weight:bold" value="<?= $row_alta['orden']; ?>" size="17">
									</td>
									<td align="right"><u>ASISTENCIA TECNICA</u>:</td>
									<td width="24%">
										<input name="asistencia_t" type="text" id="asistencia_t" style="font-weight:bold" value="<?= $row_alta['asistencia_t']; ?>" size="17">
									</td>
								</tr>
								<tr>
									<td align="right">Marca:</td>
									<td><input name="marca" type="text" id="marca" value="<?= $row_alta['marca']; ?>"></td>
									<td align="right">Modelo:</td>
									<td><input name="modelo" type="text" id="modelo" value="<?= $row_alta['modelo']; ?>"></td>
								</tr>
								<tr>
									<td align="right">Chasis:</td>
									<td><input name="chasis" type="text" id="chasis" value="<?= $row_alta['chasis']; ?>"></td>
									<td width="27%" align="right">Motor:</td>
									<td><input name="motor" type="text" id="motor" value="<?= $row_alta['motor']; ?>"></td>
								</tr>
								<tr>
									<td align="right">Matr&iacute;cula:</td>
									<td><input name="matricula" type="text" id="matricula" value="<?= $row_alta['matricula']; ?>"></td>
									<td align="right">Combustible:</td>
									<td>
										<select name="combustible" id="combustible">
											<option value="Nafta" <?php if ($row_alta['combustible'] == 'Nafta') 	echo 'selected'; ?>>Nafta </option>
											<option value="Diesel" <?php if ($row_alta['combustible'] == 'Diesel')	echo 'selected'; ?>>Diesel</option>
											<option value="GNC" <?php if ($row_alta['combustible'] == 'GNC') 		echo 'selected'; ?>>GNC </option>
											<option value="ND" <?php if ($row_alta['combustible'] == 'ND') 		echo 'selected'; ?>>ND </option>
											<option value="Otro" <?php if ($row_alta['combustible'] == 'Otro') 	echo 'selected'; ?>>Otro </option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right">A&ntilde;o:</td>
									<td><input name="anio" type="text" id="anio" value="<?= $row_alta['anio']; ?>"></td>
									<td align="right">Color:</td>
									<td><input name="color" type="text" id="color" value="<?= $row_alta['color']; ?>"></td>
								</tr>

								<tr>
									<td align="right">Nivel de Blindaje:</td>
									<td><input name="nivel_brindaje" type="text" id="nivel_brindaje" value="<?= $row_alta['nivel_brindaje']; ?>"></td>
									<td align="right">Fecha de Ingreso: </td>
									<td>
										<input type="text" name="f_ingreso" id="f_date_c" value="<?php if ($row_alta['f_ingreso'] != '0000-00-00') echo $row_alta['f_ingreso'];
																																							else echo date('d-m-Y'); ?>" size="10" maxlength="10" readonly />
										<script type="text/javascript">
											Calendar.setup({
												inputField: "f_date_c", // id of the input field
												ifFormat: "%d-%m-%Y", // format of the input field
												button: "f_ingreso", // trigger for the calendar (button ID)
												align: "Tl", // alignment (defaults to "Bl")
												singleClick: true
											});
										</script>
									</td>
								</tr>
								<tr>
									<td align="right">Multa Prevista:</td>
									<td><input name="multa" type="text" id="multa" value="<?= $row_alta['multa']; ?>"></td>
									<td align="right">Fecha de Egreso: </td>
									<td>
										<input type="text" name="f_entrega" id="f_date_d" value="<?php if ($row_alta['f_entrega'] != '0000-00-00') echo $row_alta['f_entrega'];
																																							else echo date('d-m-Y'); ?>" size="10" maxlength="10" readonly />
										<script type="text/javascript">
											Calendar.setup({
												inputField: "f_date_d", // id of the input field
												ifFormat: "%d-%m-%Y", // format of the input field
												button: "f_entrega", // trigger for the calendar (button ID)
												align: "Tl", // alignment (defaults to "Bl")
												singleClick: true
											});
										</script>
									</td>
								</tr>
								<tr>
									<td align="right">Renar:</td>
									<td><input name="renar" type="text" id="renar" value="<?= $row_alta['renar']; ?>"></td>
									<td align="right">&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="right">&nbsp;</td>
									<td>&nbsp;</td>
									<td align="right">&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							</table>
							<fieldset class="textazul"><br> &nbsp;&nbsp;&nbsp;&nbsp;<u>Opcionales</u>:<br><br>
								<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="textazul">
									<tr>
										<td width="39%">Cinta de Seguridad en las Ruedas: </td>
										<td width="12%"><input name="cinta" type="checkbox" id="cinta" value="1" <?php if ($row_alta['cinta'] == 1) { ?>checked<?php } ?>></td>
										<td width="27%">Piso Blindado: </td>
										<td width="22%">
											<input name="piso_b" type="checkbox" id="piso_b" value="1" <?php if ($row_alta['piso_b'] == 1) { ?>checked<?php } ?>>
										</td>
									</tr>
									<tr>
										<td width="39%">Techo Solar M&oacute;vil Blindado: </td>
										<td width="12%"><input name="techo" type="checkbox" id="techo" value="1" <?php if ($row_alta['techo'] == 1) { ?>checked<?php } ?>></td>
										<td width="27%">Compartimiento de Motor: </td>
										<td width="22%">
											<input name="com_motor" type="checkbox" id="com_motor" value="1" <?php if ($row_alta['com_motor'] == 1) { ?>checked<?php } ?>>
										</td>
									</tr>
									<tr>
										<td width="39%">Sirena Simple: </td>
										<td width="12%">
											<input name="sirena_s" type="checkbox" id="sirena_s" value="1" <?php if ($row_alta['sirena_s'] == 1) { ?>checked<?php } ?>>
										</td>
										<td width="27%">Cobertura para la Bater&iacute;a: </td>
										<td width="22%">
											<input name="cob_bateria" type="checkbox" id="cob_bateria" value="1" <?php if ($row_alta['cob_bateria'] == 1) { ?>checked<?php } ?>>
										</td>
									</tr>
									<tr>
										<td width="39%">Sirena Completa con Intercomunicador: </td>
										<td width="12%">
											<input name="sirena_c" type="checkbox" id="sirena_c" value="1" <?php if ($row_alta['sirena_c'] == 1) { ?>checked<?php } ?>>
										</td>
										<td width="27%">Filtro de Aire: </td>
										<td width="22%">
											<input name="filtro_aire" type="checkbox" id="filtro_aire" value="1" <?php if ($row_alta['filtro_aire'] == 1) { ?>checked<?php } ?>>
										</td>
									</tr>
									<tr>
										<td width="39%">Tanque de Combustible Blindado: </td>
										<td width="12%"><input name="tanque_blindado" type="checkbox" id="tanque_blindado" value="1" <?php if ($row_alta['tanque_blindado'] == 1) { ?>checked<?php } ?>></td>
										<td width="27%">Techo Transparente: </td>
										<td width="22%">
											<input name="techo_trans" type="checkbox" id="techo_trans" value="1" <?php if ($row_alta['techo_trans'] == 1) { ?>checked<?php } ?>>
										</td>
									</tr>
									<tr>
										<td width="39%">Run Flat: </td>
										<td width="12%">
											<input name="run_flat" type="checkbox" id="run_flat" value="1" <?php if ($row_alta['run_flat'] == 1) { ?>checked<?php } ?>>
										</td>
										<td colspan="2">
											<table width="100%" border="0" cellpadding="0" cellspacing="0" class="textazul">
												<tr>
													<td width="56%">N&deg; de Llanta :</td>
													<td width="44%">
														<input name="num_llanta" type="text" id="num_llanta" value="<?= $row_alta['num_llanta']; ?>" size="15">
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<table width="100%" border="0" cellpadding="0" cellspacing="0" class="textazul">
												<tr>
													<td width="45%">Color de Vidrios:</td>
													<td width="55%">
														<input name="color_vidrios" type="text" id="color_vidrios" value="<?= $row_alta['color_vidrios']; ?>" size="15">
													</td>
												</tr>
											</table>
										</td>
										<td colspan="2">
											<table width="100%" border="0" cellpadding="0" cellspacing="0" class="textazul">
												<tr>
													<td width="56%">Vendedor Responsable: </td>
													<td width="44%"><input name="vendedor" type="text" id="vendedor" value="<?= $row_alta['vendedor']; ?>" size="15"></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</fieldset>
							<br>
							<fieldset class="textazul">
								<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="textazul">
									<tr>
										<td width="20" height="41">
											<input name="vehi_taller" type="radio" value="1" <?php if ($row_alta['vehi_taller'] == 1) { ?>checked<?php } ?>>
										</td>
										<td width="200">Veh&iacute;culo Dentro del Taller.</td>
										<td width="20"><input name="vehi_taller" type="radio" value="0" <?php if ($row_alta['vehi_taller'] == 0) { ?>checked<?php } ?>></td>
										<td width="200">Veh&iacute;culo Fuera del Taller.</td>
									</tr>
								</table>
							</fieldset>
							<br>
							<fieldset><br>

								<table width="581" border="0" align="center" cellpadding="0" cellspacing="2" class="textazul">
									<tr>
										<td width="133" align="right" valign="middle">Imagen:&nbsp;&nbsp;</td>
										<td width="442" align="center" valign="middle">
											<table width="100%" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td width="42%" valign="middle"><?php
																													if ($row_alta['imagen_a'] != '') {
																														//// RESIZE_IMAGE
																														$image = "images/vehic/" . $row_alta['imagen_a'];

																														if (!$max_width)
																															$max_width = 150;
																														if (!$max_height)
																															$max_height = 150;
																														$size = GetImageSize($image);
																														$width = $size[0];
																														$height = $size[1];

																														$x_ratio = $max_width / $width;
																														$y_ratio = $max_height / $height;

																														if (($width <= $max_width) && ($height <= $max_height)) {
																															$tn_width = $width;
																															$tn_height = $height;
																														} else if (($x_ratio * $height) < $max_height) {
																															$tn_height = ceil($x_ratio * $height);
																															$tn_width = $max_width;
																														} else {
																															$tn_width = ceil($y_ratio * $width);
																															$tn_height = $max_height;
																														}


																														////////////////
																													?>
															<img src='<?= $image; ?>' width="<?= $tn_width; ?>" height="<?= $tn_height; ?>">
														<?php } else {
																														echo 'Sin imagen';
																													} ?>
														<input name="imagen_a" type="hidden" id="imagen_a" value="<?= $row_alta['imagen_a']; ?>">
													</td>
													<td width="58%" align="center" valign="middle"><input type="file" name="file"></td>
												</tr>
											</table>
										</td>
									</tr>
									<?php if ($_GET['id'] != '') { ?>
										<tr>
											<td width="133" align="right" valign="middle">C&oacute;digo de Barra:&nbsp;&nbsp;</td>
											<td width="442" valign="middle">
												<img src='./barcode/image.php?code=<?= $row_alta['code_a'] ?>&style=196&type=C128B&width=460&height=75&xres=2&font=5'>
											</td>
										</tr>
									<?php } ?>
								</table>
							</fieldset>
							<br><br>
							<div align="center">
								<?php if ($_GET['id'] != '') { ?>
									<input name="modificar" type="submit" id="modificar" value="Modificar">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input name="baja" type="submit" id="Baja" value="Baja">
								<?php } else { ?>
									<input name="save" type="submit" id="save" value="Guardar"><?php } ?>
							</div><br>

						</td>
						<td background="images/borde_der.jpg">&nbsp;</td>
					</tr>
					<tr>
						<td><img src="images/esq_ii.jpg" width="30" height="30"></td>
						<td background="images/borde_i.jpg">&nbsp;</td>
						<td><img src="images/esq_id.jpg" width="30" height="30"></td>
					</tr>
				</table>
			</form><?php
						}

						/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

						if ($_POST['baja'] != 'Baja' && $_GET['alta'] != 'n' && $_GET['id'] <= '0') {
							$sql  = "SELECT * from altas where publico_a=1";
							// BUSCAR //////////////////////////////////////////////////////////
							if ($_POST['buscarmatricula'] != "") 																// BUSCA POR MATRICULA
								$sql .= " AND altas.matricula LIKE '%$_POST[buscarmatricula]%' ";	//
							//
							if ($_POST['buscarmarca'] != "") 																		// BUSCA POR MARCA
								$sql .= " AND altas.marca LIKE '%$_POST[buscarmarca]%' ";					//
							if ($_GET['enTaller'] != "") 																				// BUSCA POR EN TALLER
								$sql .= " AND altas.vehi_taller = $_GET[enTaller] ";							//

							$res = $conn->query($sql);
							// echo $sql;
							?>
			<table width="770" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#195089">
				<tr>
					<td>
						<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" bordercolor="#FFFFFF" id="vehiculos">
							<tr>
								<td width="66" height="25" class="tdBordeCelesteInfBG">OB</td>
								<td width="66" class="tdBordeCelesteInfBG">AT</td>
								<td width="132" class="tdBordeCelesteInfBG">Marca</td>
								<td width="180" class="tdBordeCelesteInfBG">Modelo</td>
								<td width="60" class="tdBordeCelesteInfBG">A&ntilde;o</td>
								<td width="89" class="tdBordeCelesteInfBG">Matr&iacute;cula</td>
								<td width="119" class="tdBordeCelesteInfBG">Nivel de Blindaje</td>
							</tr>
							<?php for ($i = 0; $i < $res->num_rows; $i++) {

								$row = $res->fetch_assoc();

								if (($i % 2) == 0) {
									$fondo = "#FFFFFF";
								} else {
									$fondo = "#E6E6E6";
								} ?>
								<tr onMouseOver="mOvr(this,'#CAE4FF');" onMouseOut="mOut(this,'<?= $fondo; ?>');" bgcolor="<?= $fondo; ?>">
									<td width="66" height="10"><b>
											<a href="altas.php?menu=<?= $_GET['menu'] ?>&id=<?= $row['alta_id']; ?>&alta=n" title="Ver"><?= $row['orden']; ?></a>
										</b>&nbsp;</td>
									<td width="66"><strong>
											<a href="altas.php?menu=<?= $_GET['menu'] ?>&id=<?= $row['alta_id']; ?>&alta=n" title="Ver"><?= $row['asistencia_t']; ?></a>
										</strong>&nbsp;</td>
									<td width="132"><strong><?= $row['marca']; ?>&nbsp;</strong></td>
									<td width="180"><strong><?= $row['modelo']; ?>&nbsp;</strong></td>
									<td width="60"><strong><?= $row['anio']; ?></strong>&nbsp;</td>
									<td width="89"><strong><?= $row['matricula']; ?>&nbsp;</strong></td>
									<td width="119"><strong><?= $row['nivel_brindaje']; ?>&nbsp;</strong></td>
									<?php include('inc_estado.php'); ?>
								</tr>
								<tr>
									<td colspan=7 height="1" bgcolor="#CCCCCC"></td>
								</tr>
							<?php } // FIN DEL FOR
							?>
						</table>
					</td>
				</tr>
			</table>
	<?php echo '<br><div align="center">' . $res->num_rows . ' Resultados</div>';
						}
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					} else { // fin valid_admin
						echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
					}
					///////////////////////////////////////////////////////////////////
					function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad)
					{
						// crear una imagen desde el original
						$img = ImageCreateFromJPEG($img_original);
						////////////////
						$white = ImageColorAllocate($img, 255, 255, 255);
						// crear una imagen nueva
						$thumb = imagecreatetruecolor($img_nueva_anchura, $img_nueva_altura);
						/////////////////////////////
						ImageString($img, 5, 5, 0, '', $white);
						// redimensiona la imagen original copiandola en la imagen
						ImageCopyResized($thumb, $img, 0, 0, 0, 0, $img_nueva_anchura, $img_nueva_altura, ImageSX($img), ImageSY($img));
						// guardar la nueva imagen redimensionada donde indicia $img_nueva
						ImageJPEG($thumb, $img_nueva, $img_nueva_calidad);
						ImageDestroy($img);
					}
					////////////////////////////////////////////////////
	?>
</body>

</html>