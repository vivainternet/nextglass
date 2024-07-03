<?php require_once('db/conexion.php'); session_start(); include('inc_fechas.php'); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Procesos</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<?php 	include('validateform.php');
	if ( $_GET['id']!="" ) // muestra al empleado seleccionada
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
function MostrarElementosForm(numformulario){ // by Mich. numformulario n� de la matriz del formularios por ej. forms[0], forms[1]
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
	siguienteCampo = "filtro"

	//nombre del formlario
	nombreForm = "filtro"

	//funcion que gestiona el evento
	function TeclaPulsada( e ) {
			if ( window.event != null)				//IE4+
				tecla = window.event.keyCode;
			else if ( e != null ) 				//N4+ o W3C compatibles
				tecla = e.which;
			else
				return;

			if (tecla == 13) { 					//se pulso enter
				if ( siguienteCampo == 'fin' ) {	//fin de la secuencia, hace el submit
						alert('Envio del formulario.')	//eliminar este alert para uso normal
						return false					//sustituir por return true para hacer el submit
				} else { 							//da el foco al siguiente campo
						eval('document.' + nombreForm + '.' + siguienteCampo + '.focus()')
						return false
				}
			}
	}

	document.onkeydown = TeclaPulsada;			//asigna el evento pulsacion tecla a la funcion
	if (document.captureEvents)					//netscape es especial: requiere activar la captura del evento
		document.captureEvents(Event.KEYDOWN)
//-->
</script>

<script language="JavaScript" type="text/javascript">
	function envia(){
		if ((document.forms.datos.filtro.checked==true)&&document.forms.datos.filtro.checked==true) alert('debe seleccionar una s&oacute;la casilla')
		else if(document.forms.datos.filtro.checked==true) {
			document.forms.datos.action="procesos.php?menu=proc";
			document.forms.datos.target="der";
			}
		else if (document.forms.datos.filtro.checked==true) document.forms.datos.action="procesos.php?menu=proc"
		//else alert('debe seleccionar un checkbox')
		document.forms.datos.submit()
	}
</script>
</head>

<body>
<?php
if ( isset($_SESSION['valid_admin']) ) { ?>

<?php	include('menu.php'); ?>
<?php
//MODIFICACION //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['modificar'] =='Modificar' ){
		$s = $_POST['id_p'];
		$code=	sprintf("*P%05s*",   $s); // el relleno con ceros funciona con cadenas tambien

		$sql_m = " UPDATE procesos SET empleado='".$_POST['empleado']."', auto='".$_POST['auto']."', operacion='".$_POST['operacion']."',
							dia='".$_POST['dia']."', inicio='".$_POST['inicio']."', fin='".$_POST['fin']."'   WHERE procesos_id = ".$_POST['id_p'];
		$res_m = $conn->query($sql_m);
		//		echo $sql_m;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// BAJA ///////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['si'] =='Si' ){
    $sql_p  =  " UPDATE procesos SET  publico_p= '0' where procesos_id = ".$_POST['id_baja'];
    $res_p = $conn->query($sql_p);
		//echo $sql_p;
}	?>

 <?php // ALTA ////////////////////////////////////////
 if($_POST['save']=='Guardar') {
		$sql_max = " SELECT max(empleado_id) AS m FROM empleados ";
	 	$res_max = $conn->query($sql_max);
		$row_max = $res_max->fetch_assoc();
	 	$id_code = $row_max['m'] +1;
		$s = $id_code;

		$code=	sprintf("*P%05s*",   $s); // el relleno con ceros funciona con cadenas tambien

		$sql  =  " INSERT INTO procesos VALUES (NULL,'".$_POST['empleado']."' ";
		$sql .= ", '".$_POST['auto']."' ";
		$sql .= ", '".$_POST['operacion']."' ";
		$sql .= ", '".$_POST['dia']."' ";
		$sql .= ", '".$_POST['inicio']."' ";
		$sql .= ", '".$_POST['fin']."' ";
		$sql .= ", '".$code."' ";
		$sql .= ", '1' ";
		$sql .= " ) ";
		$res  = $conn->query($sql);
		// echo $sql;

 } ?>
<div align="center"><br>
<fieldset style="width:770px">
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" id="buscar">
  <tr>

    <td width="60" height="50" align="center"><span class="buscarLegend">Filtro:</span></td>

    <form name="datos">
      <td width="496"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="5%"><input name="filtro" type="radio" onClick="envia()" value="hoy" <?php if($_GET['filtro']=='hoy'){ ?>checked<?php } ?>></td>
            <td width="20%">Hoy</td>
            <td width="5%"><input name="filtro" onClick="envia()" type="radio" value="mes" <?php if($_GET['filtro']=='mes'){ ?>checked<?php } ?>></td>
            <td width="36%">Ultimo Mes </td>
            <td width="5%"><input name="filtro" onClick="envia()" type="radio" value="todo" <?php if($_GET['filtro']=='todo'){ ?>checked<?php } ?>></td>
            <td width="29%">Todo</td>
          </tr>
      </table></td>
    </form>

	<td width="214"><?php if ( substr($_GET['mensaje'],0,5)=="ERROR" ) $color_error = "#FF0000"; // pone el mensaje de ERROR en rojo ?>
	  <font color="<?=$color_error;?>">&nbsp;<b><?=$_GET['mensaje'];?>
	  <a href="procesos.php?menu=proc&alta=n">Alta</a></b></font></td>
  </tr>
</table>
</fieldset>
</div>
<?php if($_POST['baja'] =='Baja' ){ ?>
<form action="procesos.php?menu=proc" method="post" name="baja" id="baja">
  <table width="325" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="247" height="46">Confirma la Baja del Veh&iacute;culo:
        <?=$_POST['marca'];?>
          <?=$_POST['modelo'];?>
          <input name="id_baja" type="hidden" id="id_baja" value="<?=$_POST['id_p'];?>"></td>
    </tr>
    <tr>
      <td><table width="65%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" height="30" align="center" valign="middle"><input name="si" type="submit" id="si" value="Si"></td>
          <td width="50%" height="30" align="center" valign="middle"><input name="Submit2" type="submit" id="Submit" value="No"></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
<p>
  <?php } ?>
</p>
<?php if($_GET['alta'] =='n' ){ ?>
<form name="form1" method="post" action="">
<table width="770" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#195089">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" id="procesos">
      <tr>
        <td class="tdBordeCelesteInfBG">Empleado</td>
        <td height="25" class="tdBordeCelesteInfBG">Auto</td>
        <td align="center" class="tdBordeCelesteInfBG">Operaci&oacute;n</td>
        <td align="center" class="tdBordeCelesteInfBG">Dia</td>
        <td align="center" class="tdBordeCelesteInfBG">Inicio</td>
        <td align="center" class="tdBordeCelesteInfBG">Fin</td>
      </tr>
      <tr class="textazul">
        <td align="center" valign="middle" >
					<select name="empleado" id="empleado">
          		<option value="0" selected>Seleccionar</option>
							<?php
							$sql 		= "SELECT * FROM empleados WHERE publico_e = 1 ORDER BY nombre_e ASC ";
							$result = $conn->query($sql);
							$i = 0;
							while( $row = $result->fetch_assoc() )	{	?>
							<option value="<?=$row['empleado_id'] ?>"><?=$row['apellido_e']?></option>
								<?php	$i++;
							} ?>
        	</select>
				</td>
        <td height="10" >
					<select name="auto" id="auto">
          		<option value="0" selected>Seleccionar</option>
           		<?php
							$sql = "SELECT * FROM altas where publico_a=1 order by marca asc";
							$result = $conn->query($sql);
							$i = 0;
							while( $row = $result->fetch_assoc() ){	?>
								<option value="<?= $row['alta_id'] ?>" ><?=$row['marca']?>, <?=$row['modelo']?>, <?=$row['matricula']?></option>
								<?php	$i++;
							} ?>
					</select>
				</td>
        <td align="center" >
				<select name="operacion" id="operacion">
            <option value="0" selected>Seleccionar</option>
            	<?php
							$sql = "SELECT * FROM operaciones where publico_o=1 order by nombre_o asc";
							$result = $conn->query($sql);
							$i = 0;
							while( $row = $result->fetch_assoc() ){	?>
								<option value="<?= $row['operaciones_id'] ?>"><?=$row['nombre_o']?></option>
								<?php	$i++;
							} ?>
        </select>
				</td>
        <td align="center" valign="middle" ><input name="dia" type="text" id="dia" size="15" />
            <button type="reset" id="f_trigger_a">...</button>
          <script type="text/javascript">
    Calendar.setup({
        inputField     :    "dia",     			// id of the input field
        ifFormat       :    "%Y-%m-%d ",    // format of the input field
        button         :    "f_trigger_a",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
      </script></td>
        <td align="center" valign="middle" ><input name="inicio" type="text" id="inicio" size="15" />
            <button type="reset" id="f_trigger_b">...</button>
          <script type="text/javascript">
    Calendar.setup({
        inputField     :    "inicio",     				// id of the input field
        ifFormat       :    "%Y-%m-%d %I:%M:%S",  // format of the input field
        button         :    "f_trigger_b",  			// trigger for the calendar (button ID)
        align          :    "Tl",           			// alignment (defaults to "Bl")
        singleClick    :    true
    });
      </script></td>
        <td align="center" valign="middle" ><input name="fin" type="text" id="fin" size="15" />
            <button type="reset" id="f_trigger_c">...</button>
          <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fin",     						// id of the input field
        ifFormat       :    "%Y-%m-%d %I:%M:%S",  // format of the input field
        button         :    "f_trigger_c",  			// trigger for the calendar (button ID)
        align          :    "Tl",           			// alignment (defaults to "Bl")
        singleClick    :    true
    });
      </script></td>
      </tr>
    </table></td>
  </tr>
</table>
<div align="center">
    <input name="save" type="submit" id="save" value="Guardar">
  </div>
</form><?php } ?>
<?php
  if ( $_GET['id']!="" ) { // muestra la empleado seleccionada

	$sql_proceso = "	SELECT * FROM procesos WHERE procesos_id = ".$_GET['id']; // NO HACE FALTA OPTIMIZAR XQ FILTRA UN SOLO REGISTRO

	$res_proceso = $conn->query($sql_proceso);
	$row_proceso = $res_proceso->fetch_assoc();
	?>
<form action="procesos.php?menu=proc&filtro=1" method="post" name="saveProc" id="saveProc">
  <input name="id_p" type="hidden" id="id_p" value="<?=$_GET['id'];?>">
  <table width="770" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#195089">
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="empleado">
        <tr>
          <td class="tdBordeCelesteInfBG">&nbsp;Empleado</td>
          <td height="25" class="tdBordeCelesteInfBG">&nbsp;Auto</td>
          <td class="tdBordeCelesteInfBG">&nbsp;Operaci&oacute;n</td>
          <td class="tdBordeCelesteInfBG">&nbsp;Dia</td>
          <td class="tdBordeCelesteInfBG">&nbsp;Inicio</td>
          <td class="tdBordeCelesteInfBG">&nbsp;Fin</td>
        </tr>
        <tr class="textazul" >
          <td align="center" valign="middle"><select name="empleado" id="empleado">
              <?php
			$sql = "SELECT * FROM empleados where publico_e=1 order by nombre_e asc";
			$result = $conn->query($sql);
			$i = 0;
			while( $row = $result->fetch_assoc() ){
				?>
              <option value="<?= $row['empleado_id'] ?>" title="<?=$row['apellido_e'].' '.$row['nombre_e'].' ('.$row['empleado_id'].')'; ?>"
			  <?php if($row_proceso['empleado']==$row['empleado_id']){ echo'selected';}?> ><?=substr($row['apellido_e'],0,10);?></option>
              <?php
				$i++;
			} ?>
          </select></td>
          <td height="10" ><select name="auto" class="" id="select2"  >
              <?php
			$sql = "SELECT * FROM altas where publico_a=1 order by marca asc";
			$result = $conn->query($sql);
			$i = 0;
			while( $row = $result->fetch_assoc() ){
				?>
              <option value="<?= $row['alta_id'] ?>" title="<?=$row['marca'].' '.$row['modelo'].' ('.$row['matricula'].')'; ?>"
			  	<?php if($row_proceso['auto']==$row['alta_id']){ echo'selected';}?>><?=substr($row['marca'].' '.$row['modelo'].' '.$row['matricula'],0,20);?></option>
				<?php
				$i++;
			}
			?>
          </select></td>
          <td><select name="operacion" id="select3">
              <?php
			$sql = "SELECT * FROM operaciones where publico_o=1 order by nombre_o asc";
			$result = $conn->query($sql);
			$i = 0;
			while( $row = $result->fetch_assoc() ){ ?>
              <option value="<?= $row['operaciones_id'] ?>"  title="<?=$row['nombre_o']?>"
			  <?php if($row_proceso['operacion']==$row['operaciones_id']){ echo'selected';}?> readly><?=substr($row['nombre_o'],0,10)?></option>
        <?php
			  $i++;
			} ?>
          </select>		  </td>
          <td valign="middle" >
		  <input name="dia" type="text" id="f_date_a" value="<?=($row_proceso['dia']);?>" size="8" />
            <script type="text/javascript">
				Calendar.setup({
					inputField     :    "f_date_a",     // id of the input field
					ifFormat       :    "%Y-%m-%d ",    // format of the input field
					button         :    "f_date_a",  		// trigger for the calendar (button ID)
					align          :    "Tl",           // alignment (defaults to "Bl")
					singleClick    :    true
				});
        	</script>		  </td>
      <td valign="middle" ><input name="inicio" type="text" id="f_date_b" value="<?=$row_proceso['inicio'];?>" size="16" />
      <script type="text/javascript">
				Calendar.setup({
					inputField     :    "f_date_b",     			// id of the input field
					ifFormat       :    "%Y-%m-%d %I:%M:%S",	// format of the input field
					button         :    "f_date_b",  					// trigger for the calendar (button ID)
					align          :    "Tl",           			// alignment (defaults to "Bl")
					singleClick    :    true
				});
        	</script>			</td>
      <td valign="middle" ><input name="fin" type="text" id="f_date_c" value="<?=$row_proceso['fin'];?>" size="16" />
			<script type="text/javascript">
				Calendar.setup({
					inputField     :    "f_date_c",     			// id of the input field
					ifFormat       :    "%Y-%m-%d %I:%M:%S",	// format of the input field
					button         :    "f_date_c",  					// trigger for the calendar (button ID)
					align          :    "Tl",           			// alignment (defaults to "Bl")
					singleClick    :    true
				});
        </script>				</td>
        </tr>
      	</table>
			</td>
    </tr>
  </table>
  <div align="center"><br>
    <input name="modificar" type="submit" id="modificar" value="Modificar">
	&nbsp;&nbsp;&nbsp;
    <input name="baja" type="submit" id="baja" value="Baja">
  </div>
</form>
<?php
 define (__TRACE_ENABLED__, false);
 define (__DEBUG_ENABLED__, false);

 require("barcode/barcode.php");
 require("barcode/i25object.php");
 require("barcode/c39object.php");
 require("barcode/c128aobject.php");
 require("barcode/c128bobject.php");
 require("barcode/c128cobject.php");
$barcode2  = $row_proceso['code_p'];
//echo $barcode2;
/* Default value */
if (!isset($output))  $output   = "png";
if (!isset($barcode)) $barcode  = "1255";
if (!isset($type))    $type     = "C128B";
if (!isset($width))   $width    = "260";
if (!isset($height))  $height   = "80";
if (!isset($xres))    $xres     = "2";
if (!isset($font))    $font     = "5";
if (!isset($stretchtext))    $stretchtext     = "on";
if (!isset($drawtext))    $drawtext     = "on";

/*********************************/

if (isset($barcode) && strlen($barcode2)>0) {
  $style  = BCS_ALIGN_CENTER;
  $style |= ($output  == "png" ) ? BCS_IMAGE_PNG  : 0;
  $style |= ($output  == "jpeg") ? BCS_IMAGE_JPEG : 0;
  $style |= ($border  == "on"  ) ? BCS_BORDER 	  : 0;
  $style |= ($drawtext== "on"  ) ? BCS_DRAW_TEXT  : 0;
  $style |= ($stretchtext== "on" ) ? BCS_STRETCH_TEXT  : 0;
  $style |= ($negative== "on"  ) ? BCS_REVERSE_COLOR  : 0;

  switch ($type)
  {
    case "I25":
			  $obj = new I25Object(250, 120, $style, $barcode2);
		 break;
    case "C39":
			  $obj = new C39Object(50, 120, $style, $barcode2);
			 	  break;
    case "C128A":
			  $obj = new C128AObject(250, 120, $style, $barcode2);
			  break;
    case "C128B":
			  $obj = new C128BObject(250, 120, $style, $barcode2);
			  break;
    case "C128C":
                          $obj = new C128CObject(250, 120, $style, $barcode2);
			  break;
	default:
			$obj = false;
  }
 if ($obj) {
     if ($obj->DrawObject($xres)) {
         echo "<table align='center'><tr><td><img src='./barcode/image.php?code=".$barcode2."&style=".$style."&type=".$type."&width=".$width."&height=".$height."&xres=".$xres."&font=".$font."'></td></tr></table>";
     } else echo "<table align='center'><tr><td><font color='#FF0000'>".($obj->GetError())."</font></td></tr></table>";
 }
}	?>
		<p><?php
	}	?>
  <br>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($_POST['baja']!='Baja' && $_GET['alta']!='n' && $_GET['id']<='0' ){
	$sql  = "SELECT * FROM procesos, empleados, altas, operaciones ";
	// BUSCAR ///////////////////////////////////////////////////////////////
  if( $_GET['filtro']=="1" ) 																		// SIN FILTRO
	$sql .= " WHERE procesos.dia  = '' ";												//

 if( $_GET['filtro']=="todo" ) 																	// BUSCA TODO
	$sql .= " WHERE procesos.dia  >= '0000-00-00' ";						//

  if( $_GET['filtro']=="hoy" ) 																	// BUSCA BUSCA REGISTROS DEL DIA
	$sql .= " WHERE procesos.dia = ".date("'Y-m-d'");

  if( $_GET['filtro']=="mes" ) {
	$sql .= " WHERE procesos.dia > '".date('Y-m')."-01' ";		// BUSCA BUSCA REGISTROS DEL MES
	$sql .= " AND 	procesos.dia < '".date('Y-m')."-32' ";
	}
	$sql .= " AND procesos.operacion = operaciones.operaciones_id AND procesos.auto = altas.alta_id
						AND procesos.empleado = empleados.empleado_id AND procesos.publico_p = '1' ";

	$res = $conn->query($sql);
	//	echo $sql;
	?>
</p>
            <table width="770" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#195089">
              <tr>
                <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" id="empleado">
                  <tr>
                    <td class="tdBordeCelesteInfBG">Empleado</td>
                    <td height="25" class="tdBordeCelesteInfBG">Auto</td>
                    <td class="tdBordeCelesteInfBG">Operaci&oacute;n</td>
                    <td class="tdBordeCelesteInfBG">Dia</td>
                    <td class="tdBordeCelesteInfBG">Inicio</td>
                    <td class="tdBordeCelesteInfBG">Fin</td>
                  </tr>
                  <?php 	for ( $i=0; $i < $res->num_rows; $i++ ) {

			$row = $res->fetch_assoc();

			if ( ($i%2)==0 ) { $fondo="#FFFFFF"; } else { $fondo="#E6E6E6"; }

			?>
                  <tr bgcolor="<?=$fondo;?>" class="textazul" onMouseOver="mOvr(this,'#CAE4FF');" onMouseOut="mOut(this,'<?=$fondo;?>');">
                    <td height="30">
										<b><a href="procesos.php?menu=proc&id=<?=$row['procesos_id']; ?>" title="Ver proceso ID: <?=$row['procesos_id']; ?>">
                      <?=strtoupper($row['apellido_e']).'<br>'.strtoupper($row['nombre_e']); ?></a> </b></td>
                    <td class="tdBordeGrisIzq">

											<span title="<?=($row['orden']?'OB '.$row['orden']:'')?> <?=($row['asistencia_t']?'ATO '.$row['asistencia_t']:'')?>"><b>
                      <?=$row['marca']?>
                      <?=$row['modelo']?>
                      <?=$row['matricula']?>
                    </b></span>

										</td>
                    <td class="tdBordeGrisIzq">
										<b><span title="<?=$row['nombre_o']?>"><?=substr($row['nombre_o'],0,10); ?></span></b></td>
                    <td class="tdBordeGrisIzq"><b><?=$row['dia']; ?></b></td>
                    <td class="tdBordeGrisIzq"><b><?=$row['inicio']; ?></b></td>
                    <td class="tdBordeGrisIzq"><b>
						<a href="procesos.php?menu=proc&id=<?=$row['procesos_id']; ?>"
						title="Ver"><?php if ($row['fin']!=0) echo $row['fin']; else echo 'Finalizar'; ?></a></b>
										</td>
                    <?php include('inc_estado.php'); ?>
                  </tr>
                  <tr bgcolor="#CCCCCC">
                    <td height="1" colspan="6"></td>
                  </tr>
                  <?php } ?>
                </table></td>
              </tr>
            </table>
            <?php  echo '<br><div align="center">'.$res->num_rows.' Resultados</div>';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else { // fin valid_admin
	echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
}  ?>

</body>
</html>
