<?php require_once('db/conexion.php'); session_start(); include('inc_fechas.php'); ?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Empleados</title>
	<link href="styles.css" rel="stylesheet" type="text/css">

	<?php include('validateform.php');

	if ($_GET['id'] != "")  // muestra la empleado seleccionada

	?>

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
		nombreForm = "form1"

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

		function MM_popupMsg(msg) { //v1.0
			if (confirm(msg)) {
				alert(msg);
			} else {}

		}

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
		<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" id="buscar">
			<tr>
				<form action="empleados.php" name="buscarempleadoID" method="post" enctype="application/x-www-form-urlencoded">
					<td width="39" height="50"><span class="buscarLegend">Id:</span><br>
						<input name="buscarempleadoID" type="text" class="inputBuscarID" maxlength="20" value="<?= $_POST['buscarempleadoID'] ?>">
					</td>
				</form>
				<form action="empleados.php" name="buscarempleado" method="post" enctype="application/x-www-form-urlencoded">
					<td width="258"><span class="buscarLegend">Buscar <i>&quot;Empleado&quot;</i> por Nombre:</span><br>
						<input name="buscarempleado" type="text" class="inputBuscar" size="35" maxlength="40" value="<?= $_POST['buscarempleado'] ?>">
					</td>
				</form>
				<form action="empleados.php" name="buscarClienteID" method="post" enctype="application/x-www-form-urlencoded">
				</form>
				<form action="empleados.php" name="buscarCliente" method="post" enctype="application/x-www-form-urlencoded">
				</form>
				<?php if ($_POST['save'] == 'Guardar') {

					if ($_FILES['file']['name'] != '') {
						$imagen_home = $_FILES['file']['name'];
						// debug
						//echo 'max + 1 ='.$id_imagen;
						//$DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];
						$nombre_archivo2 = "images/empleados/" . $imagen_home; // agrega el ID al nombre de la imagen
						//$imagen_home = $id_imagen.'_'.$nombre_archivo; // agrega el ID al nombre de la imagen
						// debugg
						//echo '<br>'.$nombre_archivo;
						//echo '<br>'.$imagen_home;


						// si la imagen se carg� correctamente inserta los datos en la tabla
						move_uploaded_file($_FILES['file']['tmp_name'], $nombre_archivo2);
						/////////////////////////////////////////////////////
						//// RESIZE_IMAGE
						$image = "images/empleados/" . $imagen_home;

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
						$origen = "images/empleados/" . $imagen_home;
						$destino = "images/empleados/" . $imagen_home;


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

					$s = $_POST['codigo'];

					$code =	sprintf("*E%05s*", $s); // el relleno con ceros funciona con cadenas tambien

					$sql  =  " INSERT INTO empleados VALUES ('" . $_POST['codigo'] . "'";
					$sql .= ", UPPER('" . $_POST['nombre'] . "')";
					$sql .= ", UPPER('" . $_POST['apellido'] . "')";
					$sql .= ", '" . $_POST['dni'] . "'";
					$sql .= ", '" . $_POST['grupo'] . "'";
					$sql .= ", '" . $code . "'";
					$sql .= ", '" . $imagen_home . "'";
					$sql .= ", '1'";
					$sql .= " ) ";
					$res = $conn->query($sql);
					// Debug echo $sql;
					echo '<div align="center"><strong>Registro Ingresado.</strong></div>';
				}

				///////////////////////////////////////////////////////////////////////////////////
				//BAJA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if ($_POST['borraremp'] == 'Si') {
					$sql_p = "UPDATE empleados SET  publico_e= '0' WHERE empleado_id = " . $_POST['id_baja'];
					$res_p = $conn->query($sql_p);
					//echo $sql_p;

					echo '<div align="center"><strong>Registro Borrado.</strong></div>';
				}





				//MODIFICACION //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if ($_POST['modificar'] == 'Modificar') {

					if ($_FILES['file']['name'] != '') {
						$imagen_home = $_FILES['file']['name'];
						// debug
						$nombre_archivo2 = "images/empleados/" . $imagen_home; // agrega el ID al nombre de la imagen
						///echo '<br>'.$imagen_home;

						if (move_uploaded_file($_FILES['file']['tmp_name'], $nombre_archivo2)) {
							/////////////////////////////////////////////////////
							//// RESIZE_IMAGE
							$image = "images/empleados/" . $imagen_home;

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
							$origen = "images/empleados/" . $imagen_home;
							$destino = "images/empleados/" . $imagen_home;


							$destino_temporal = tempnam("tmp/", "tmp");

							redimensionar_jpeg($origen, $destino_temporal, $tn_width, $tn_height, 100);

							// guardamos la imagen
							$fp = fopen($destino, "w");
							fputs($fp, fread(fopen($destino_temporal, "r"), filesize($destino_temporal)));
							fclose($fp);

							// mostramos la imagen
							//echo "<img src='images/nuevaimagen.jpg'>";
							//////////////////////////////////////////Borra imagen anterior
							if ($_POST['imagen_e'] != '') {

								$archi = "images/empleados/" . $_POST['imagen_e'];
								if (file_exists($archi)) {
									unlink($archi);
									clearstatcache();
								}
							}
						}
					} else {
						$imagen_home = $_POST['imagen_e'];
					}


					$s = $_POST['codigo'];
					$code =	sprintf("*E%05s*",   $s); // el relleno con ceros funciona con cadenas tambien

					$sql_m  =  " UPDATE empleados SET nombre_e = UPPER('" . $_POST['nombre'] . "'),
															apellido_e = UPPER('" . $_POST['apellido'] . "'), dni_e='" . $_POST['dni'] . "', grupo_e='" . $_POST['grupo'] . "' ,
															code_e='" . $code . "' , imagen_e='" . $imagen_home . "' WHERE empleado_id = " . $_POST['id_m'];
					$res_m = $conn->query($sql_m);
					//echo $sql_m;
					echo '<div align="center"><strong>Registro Modificado.</strong></div>';
				}

				///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				?>
				<td width="404"><?php if (substr($_GET['mensaje'], 0, 5) == "ERROR") $color_error = "#FF0000"; // pone el mensaje de ERROR en rojo
												?>
					<font color="<?= $color_error; ?>">&nbsp;<b><?= $_GET['mensaje']; ?></b></font>
				</td>
			</tr>
		</table>
		<?php if ($_GET['b'] == '1') { ?>
			<form action="empleados.php?menu=em" method="post" name="bajaEmp" id="bajaEmp">
				<table width="313" align="center">
					<tr>
						<td width="305">
							<fieldset>
								<font color="#FF0000"><b><br>
										&nbsp;&nbsp;Confirma la BAJA del empleado: <br>
										&nbsp;&nbsp;<?= strtoupper($_GET['empleado']); ?></b></font>
								<input name="id_baja" type="hidden" id="id_baja" value="<?= $_GET['id_baja']; ?>">
								<br>
								<br>
								<table width="65%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td width="50%" height="30" align="center" valign="middle">
											<input name="Submit" type="submit" id="Submit" value="No">
										</td>
										<td width="50%" height="30" align="center" valign="middle">
											<input name="borraremp" type="submit" id="borraremp" value="Si">
										</td>
									</tr>
								</table>
							</fieldset>
						</td>
					</tr>
				</table>
			</form>
		<?php } ?>

		<?php
		if ($_GET['alta'] == 'n') { ?>
			<form action="empleados.php?menu=ea" method="post" enctype="multipart/form-data" name="form1" onSubmit="MM_validateForm('nombre','','R','apellido','','R');return document.MM_returnValue">
				<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="3">&nbsp;&nbsp;&nbsp;<img src="images/text_AltadeEmp.jpg" width="135" height="18"></td>
					</tr>
					<tr>
						<td width="30"><img src="images/esq_si.jpg" width="30" height="30"></td>
						<td width="720" background="images/borde_s.jpg">&nbsp;</td>
						<td width="30"><img src="images/esq_sd.jpg" width="30" height="30"></td>
					</tr>
					<tr>
						<td background="images/borde_iz.jpg">&nbsp;</td>
						<td bgcolor="#E4E9ED">
							<table width="100%" class="textazul">
								<tr>
									<td width="25%" align="right"><u>CODIGO DE EMPLEADO </u>:</td>
									<td width="24%">
										<?php
										$sql_max = "select max(empleado_id) as m from empleados";
										$res_max = $conn->query($sql_max);
										$row_max = $res_max->fetch_array();
										$id_empleado = $row_max['m'] + 1; ?>

										<input name="codigo" type="text" id="codigo" value="<?= $id_empleado; ?>" readonly>
									</td>
									<td align="right">&nbsp;</td>
									<td width="36%">&nbsp;</td>
								</tr>
								<tr>
									<td align="right">Nombre:</td>
									<td><input name="nombre" type="text" id="nombre"></td>
									<td align="right">Apellido:</td>
									<td><input name="apellido" type="text" id="apellido"></td>
								</tr>
								<tr>
									<td align="right">DNI:</td>
									<td><input name="dni" type="text" id="dni"></td>
									<td width="15%" align="right">Grupo:</td>
									<td><select name="grupo" id="grupo">
											<option selected>Seleccionar</option>
											<option value="Administrador">Administrador</option>
											<option value="Produccion">Produccion</option>
										</select></td>
								</tr>
								<tr>
									<td align="right">&nbsp;</td>
									<td colspan="3">&nbsp;</td>
								</tr>


								<tr>
									<td align="right">Imagen:</td>
									<td colspan="3"><input type="file" name="file"></td>
								</tr>
								<tr>
									<td align="right">&nbsp;</td>
									<td colspan="3">&nbsp;</td>
								</tr>
							</table>
							<br>
							<div align="center"><input name="save" type="submit" id="save" value="Guardar"></div>
							<br>
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
		} ?>
		<?php

		if ($_GET['id'] != "") { // muestra la empleado seleccionada

			$sql_empleado = " SELECT * FROM empleados WHERE empleados.empleado_id = " . $_GET['id']; // NO HACE FALTA OPTIMIZAR XQ FILTRA UN SOLO REGISTRO
			$res_empleado = $conn->query($sql_empleado);
			$row_empleado = $res_empleado->fetch_assoc();
			?>
			<form action="empleados.php?menu=em" method="post" enctype="multipart/form-data" name="form2">
				<input name="id_m" type="hidden" id="id_m" value="<?= $row_empleado['empleado_id']; ?>">

				<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="3">&nbsp;&nbsp;&nbsp;<img src="images/text_ModdeEmp.jpg" width="199" height="18"></td>
					</tr>
					<tr>
						<td width="30"><img src="images/esq_si.jpg" width="30" height="30"></td>
						<td width="720" background="images/borde_s.jpg">&nbsp;</td>
						<td width="30"><img src="images/esq_sd.jpg" width="30" height="30"></td>
					</tr>
					<tr>
						<td background="images/borde_iz.jpg">&nbsp;</td>
						<td bgcolor="#E4E9ED">
							<table width="100%" class="textazul">
								<tr>
									<td width="28%" align="right"><u>CODIGO DE EMPLEADO </u>:</td>
									<td width="20%"><b>
											<input name="codigo" type="text" id="codigo" value="<?= $row_empleado['empleado_id']; ?>" readonly>
										</b></td>
									<td align="right">&nbsp;</td>
									<td width="31%">&nbsp;</td>
								</tr>
								<tr>
									<td align="right">Nombre:</td>
									<td><b>
											<input name="nombre" type="text" id="nombre" value="<?= $row_empleado['nombre_e']; ?>">
										</b></td>
									<td align="right">Apellido:</td>
									<td><input name="apellido" type="text" id="apellido" value="<?= $row_empleado['apellido_e']; ?>"></td>
								</tr>
								<tr>
									<td align="right">DNI:</td>
									<td><input name="dni" type="text" id="dni" value="<?= $row_empleado['dni_e']; ?>"></td>
									<td width="21%" align="right">Grupo:</td>
									<td><b>
											<select name="grupo" id="grupo">
												<option>Seleccionar</option>
												<option value="Administrador" <?php
																											if ($row_empleado['grupo_e'] == 'Administrador') {
																												echo 'selected';
																											} ?>>Administrador</option>
												<option value="Produccion" <?php if ($row_empleado['grupo_e'] == 'Produccion') {
																											echo 'selected';
																										} ?>>Produccion</option>
											</select>
										</b></td>
								</tr>
								<tr>
									<td align="right">&nbsp;</td>
									<td colspan="3">&nbsp;</td>
								</tr>

								<tr>
									<td align="right">Borrar Empleado: </td>
									<td><a href="empleados.php?menu=em&b=1&id_baja=<?= $row_empleado['empleado_id'];
																																	?>&empleado=<?= $row_empleado['nombre_e']; ?> <?= $row_empleado['apellido_e'];
																													?>"><img src="images/b_drop.png" width="16" height="16" border="0"></a></td>
									<td align="right">&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="right">&nbsp;</td>
									<td colspan="3">&nbsp;</td>
								</tr>
								<tr>
									<td align="right" valign="top">Imagen:</td>
									<td colspan="2" valign="top"><input name="file" type="file" id="file"></td>
									<td><?php
											if ($row_empleado['imagen_e'] != '') {
												//// RESIZE_IMAGE
												$image = "images/empleados/" . $row_empleado['imagen_e'];

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
												echo '<img src="images/empleados/thumb_male.jpg" width="80" height="60">';
											} ?>
										<input name="imagen_e" type="hidden" id="imagen_e" value="<?= $row_empleado['imagen_e']; ?>">
									</td>
								</tr>

								<tr>
									<td align="right">C&oacute;digo de Barra: </td>
									<td colspan="3">
										<img src='./barcode/image.php?code=<?= $row_empleado['empleado_id'] ?>&style=452&type=C128B&width=200&height=75&xres=2&font=5'>
									</td>
								</tr>
							</table>
							<br>
							<div align="center"><input name="modificar" type="submit" id="modificar" value="Modificar"></div><br>
						</td>
						<td background="images/borde_der.jpg">&nbsp;</td>
					</tr>
					<tr>
						<td><img src="images/esq_ii.jpg" width="30" height="30"></td>
						<td background="images/borde_i.jpg">&nbsp;</td>
						<td><img src="images/esq_id.jpg" width="30" height="30"></td>
					</tr>
				</table>
			</form>

			<p>
			<?php
		} ?>
			<br>
			<?php
			if ($_GET['b'] != '1' && $_GET['alta'] != 'n' && $_GET['id'] <= '0') {

				$sql  = " SELECT * FROM empleados WHERE publico_e=1";
				// BUSCAR //////////////////////////////////////////////////////////////////
				if ($_POST['buscarempleadoID'] != "") 											// BUSCA POR ID CUENTA
					$sql .= " AND empleados.empleado_id = $_POST[buscarempleadoID] ";				//
				//
				if ($_POST['buscarempleado'] != "") 											// BUSCA POR NOMBRE DE CUENTA
					$sql .= " AND empleados.nombre_e LIKE '%$_POST[buscarempleado]%' ";	//

				$res = $conn->query($sql);
				$num = $res->num_rows;
				// Debug echo $sql.'<br>num_rows:'.$num;
				?>
			</p>
			<table width="770" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#195089">
				<tr>
					<td>
						<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" bordercolor="#FFFFFF" id="empleado">
							<tr>
								<td width="10%" height="25" class="tdBordeCelesteInfBG">C&oacute;digo</td>
								<td width="25%" class="tdBordeCelesteInfBG">Nombre</td>
								<td width="25%" class="tdBordeCelesteInfBG">Apellido</td>
								<td width="20%" class="tdBordeCelesteInfBG">DNI</td>
								<td width="20%" class="tdBordeCelesteInfBG">Grupo</td>
							</tr>
							<?php for ($i = 0; $i < $num; $i++) {

								$row = $res->fetch_assoc();

								if (($i % 2) == 0) {
									$fondo = "#FFFFFF";
								} else {
									$fondo = "#E6E6E6";
								}

							?>
								<tr class="textazul" onMouseOver="mOvr(this,'#CAE4FF');" onMouseOut="mOut(this,'<?= $fondo; ?>');" bgcolor="<?= $fondo; ?>">
									<td height="10" class="textazul">&nbsp;
										<a href="empleados.php?menu=em&id=<?= $row['empleado_id']; ?>" title="Modificar"><?= $row['empleado_id']; ?></a>
									</td>
									<td><?= strtoupper($row['nombre_e']); ?> &nbsp;</td>
									<td><?= strtoupper($row['apellido_e']); ?> &nbsp;</td>
									<td><?= $row['dni_e']; ?> &nbsp;</td>
									<td><?= $row['grupo_e']; ?> &nbsp;</td>
									<?php include('inc_estado.php'); ?>
								</tr>
								<tr>
									<td height="1" colspan="5" style="border-top: 1px solid #CCCCCC;"></td>
								</tr>
							<?php } ?>
						</table>
					</td>
				</tr>
			</table>
			<?php echo '<br><div align="center">' . $res->num_rows . ' Resultados</div>';
			?>
			<!-- aca iba el FOOTER footer.php -->
			<?php
				///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			}
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