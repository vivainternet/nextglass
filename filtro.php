<?php require_once('db/conexion.php'); session_start(); include('inc_fechas.php'); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Listados</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<?php include('validateform.php');	?>

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

<script language="JavaScript" type="text/javascript">
	function bloquea()	{
		document.forms.form1.desde.disabled=true;
		document.forms.form1.hasta.disabled=true;
	}
	function desbloquea()	{
		document.forms.form1.desde.disabled=false;
		document.forms.form1.hasta.disabled=false;
	}
</script>
</head>

<body>
<?php
if ( isset($_SESSION['valid_admin']) ) { ?>

<?php	include('menu.php'); ?>
	<br>
  <table width="600" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#195089">
    <tr>
      <td height="25" class="tdBordeCelesteInfBG">&nbsp;&nbsp;Formulario De Impresi&oacute;n</td>
    </tr>
    <tr>
      <td><table width="600" align="center" cellpadding="0" cellspacing="4">
        <tr>
          <td width="249" align="center" valign="top"><br>


					<form action="listado.php" method="Post" enctype="multipart/form-data" name="tipo" target="_blank" id="tipo">
              <table width="85%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#195089">
                <tr>
                  <td height="129"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="textazul">
                      <tr>
                        <td height="35" colspan="2"><u>Seleccion de Tipo de Listado</u>: </td>
                      </tr>
                      <tr>
                        <td width="16%" height="22"><input name="tipo" type="radio" value="empleados"></td>
                        <td width="84%" height="22">Empleados</td>
                      </tr>
                      <tr>
                        <td height="22"><input name="tipo" type="radio" value="autos"></td>
                        <td height="22">Autos</td>
                      </tr>
                      <tr>
                        <td height="22"><input name="tipo" type="radio" value="operaciones"></td>
                        <td height="22">Operaciones</td>
                      </tr>
                      <tr>
                        <td height="22"><input name="tipo" type="radio" value="acciones"></td>
                        <td height="22">Acciones</td>
                      </tr>
                      <tr>
                        <td height="40" colspan="2" align="center">
												<input name="generarTipo" type="submit" id="generarTipo" value="Generar"></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
					</form>
							</td>


          <td width="337" align="center" valign="top"><br>
					<form action="listado_procesos.php" method="Post" enctype="multipart/form-data" name="proc_emp" target="_blank" id="proc_emp">
            <table width="311" border="1" cellpadding="0" cellspacing="0" bordercolor="#195089">
              <tr>
                <td width="307"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="textazul">
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                    <tr>
                      <td colspan="2"><u>Listado de Procesos</u>: </td>
                    </tr>
                    <tr>
                      <td height="30" colspan="2">
											<select name="ord_b" id="ord_b">
                        <option value="0">Todas</option>
                        <?php
	                        $sql = "SELECT * FROM altas ORDER BY orden ASC, asistencia_t ASC ";
	                        $result = $conn->query($sql);

												while( $row = mysqli_fetch_array($result) ){ ?>
													<option value="<?= $row['alta_id'] ?>" >
														<?=($row['orden']?'OB '.$row['orden']:'')?> <?=($row['asistencia_t']?'ATO '.$row['asistencia_t']:'')?>
													</option><?php
												} ?>
                      </select>
                        &nbsp;Orden de Blindaje</td>
                      </tr>
                    <tr>
                      <td width="26%">&nbsp;</td>
                      <td width="74%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2"><u>Listado de Empleados</u>: </td>
                    </tr>
                    <tr>
                      <td height="30" colspan="2">
											  <select name="empleado" class="" id="empleado"  >
											    <option value="0" selected>Todos</option>
											    <?php
	                        // TIPO DE PROPIEDAD
	                        $sql 		= " SELECT * FROM empleados ORDER BY apellido_e ASC, nombre_e ASC ";
	                        $result = $conn->query($sql);
	                        while( $row = mysqli_fetch_array($result) ){ ?>
											    	<option value="<?=$row['empleado_id'] ?>" ><?=strtoupper($row['apellido_e'])?>
														<?=strtoupper($row['nombre_e']);?></option>
											    	<?php
													} ?>
										      </select>												</td>
                      </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="34" colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="45%" class="textazul"><u>Desde</u>:</td>
                          <td colspan="2"  class="textazul"><u>Hasta</u>:</td>
                        </tr>
                        <tr>
                          <td height="30">
														<input name="desde" type="text" id="desde" size="10" readonly />
														<button type="reset" id="f_trigger_a">...</button>

														<script type="text/javascript">
															Calendar.setup({
																	inputField     :    "desde",     		// id of the input field
																	ifFormat       :    "%Y-%m-%d",    	// format of the input field
																	button         :    "f_trigger_a",  // trigger for the calendar (button ID)
																	align          :    "Tl",           // alignment (defaults to "Bl")
																	singleClick    :    true
															});
														</script>
													</td>

                          <td width="43%" valign="middle">
														<input name="hasta" type="text" id="hasta" size="10" readonly />
														<button type="reset" id="f_trigger_b">...</button>

                            <script type="text/javascript">
															Calendar.setup({
																	inputField     :    "hasta",     // id of the input field
																	ifFormat       :    "%Y-%m-%d",    // format of the input field
																	button         :    "f_trigger_b",  // trigger for the calendar (button ID)
																	align          :    "Tl",           // alignment (defaults to "Bl")
																	singleClick    :    true
															});
														</script></td>
                          <td width="12%" valign="middle">
															<img src="images/button_cancel.jpg" alt="Borrar fechas" width="16" height="16" style="cursor:hand"
															onClick="document.proc_emp.desde.value=''; document.proc_emp.hasta.value=''">
													</td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" colspan="2" align="center">
												<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="textazul">
                          <tr>
                            <td height="25" colspan="2"><u>Ordenado por</u>:</td>
                          </tr>
                          <tr>
                            <td width="9%" height="22"><input name="ordenar_por" type="radio" value="ob"></td>
                            <td width="91%" height="22">OB y Operaci&oacute;n</td>
                          </tr>
                          <tr>
                            <td height="22"><input name="ordenar_por" type="radio" value="empleado"></td>
                            <td height="22">Empleados</td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                        </table>
                          <input name="generar" type="submit" id="generar" value="Generar">
                          <br><br></td>
                    </tr>
                </table></td>
              </tr>
            </table>
					</form>



            <br></td>
        </tr>
        <tr>
          <td height="18" colspan="2" align="center">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
  <p>&nbsp;</p>
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else { // fin valid_admin
	echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
}  ?>

</body>
</html>
