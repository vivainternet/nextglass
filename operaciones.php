<?php require_once('db/conexion.php'); session_start(); include('inc_fechas.php'); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Operaciones</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<?php 	include('validateform.php');
if ( $_GET['id']!="" ) // muestra la empleado seleccionada	?>

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
</head>
<body>
<?php
if ( isset($_SESSION['valid_admin']) ) { ?>

<?php	include('menu.php'); ?>
<?php	// Debug echo $_POST['nombre'];
// ALTA ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['nombre']!='' && $_POST['alta']=='Alta' ){
	$sql  = " INSERT INTO operaciones VALUES (NULL,'".strtoupper($_POST['nombre'])."'";
	$sql .= ", '' ";
	$sql .= ", '1' ";
	$sql .= " ) ";
	$res  = $conn->query($sql);
	// Debug echo $sql;
}

// Debug echo $sql_m.'<br>POST id:'.$_POST['name'];

// MODIFICAR //////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['nombre']!='' && $_POST['modificar']=='Modificar' ){
    $sql_m = " UPDATE operaciones SET nombre_o = '".strtoupper($_POST['nombre'])."' WHERE operaciones_id =  ".$_POST['id'];
    $res_m = $conn->query($sql_m);
		// Debug echo $sql_m.'<br>POST id:'.$_POST['id'];
}

// BAJA ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['borrarop'] =='Si' ){
    $sql_p  = "UPDATE operaciones SET publico_o = '0' WHERE operaciones_id =  ".$_POST['id_baja'];
    $res_p = $conn->query($sql_p);
		// Debug echo $sql_p;
}	?>
<?php if($_POST['baja'] !='Baja' ){ ?>
<br><br>
<form action="operaciones.php" method="Post" enctype="multipart/form-data" name="modificarOp" id="modificarOp" onSubmit="">
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#195089">
    <tr>
      <td height="25" class="tdBordeCelesteInfBG">&nbsp;&nbsp;Operaciones</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E6E6E6">
        <tr>
          <td width="50%" align="center"><br>
            <select name="id" size="20" id="id"><?php
									$sql 		= " SELECT * FROM operaciones WHERE publico_o = 1 ORDER BY nombre_o ASC ";
									$result = $conn->query($sql);
									$i = 0;
									while( $row = $result->fetch_assoc() ){ ?>
											<option value="<?= $row['operaciones_id'] ?>" title="<?= $row['operaciones_id'] ?>" selected><?=$row['nombre_o']?></option>
											<?php $i++;
									}	?>
            </select>
            <br><br>
					</td>
          <td width="50%" valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="46" colspan="2"><input name="nombre" type="text" id="nombre"></td>
              </tr>
              <tr>
                <td width="71" height="40">  <input name="alta" id="btnAlta" type="submit" value="Alta"></td>
                <td width="46" align="right"><input name="baja" id="btnBaja" type="submit" value="Baja"></td>
              </tr>
              <tr>
                <td height="45" colspan="2"><input name="modificar" id="modificar" type="submit" value="Modificar"></td>
              </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form><?php } ?>
<?php if( $_POST['baja']=='Baja' ){ ?>
<form action="operaciones.php" method="post" name="bajaOp" id="bajaOp">
  <?php
  $sql = " SELECT * FROM operaciones WHERE operaciones_id = ".$_POST['id'];
  $result = $conn->query($sql);
  $row = $result->fetch_assoc(); ?>
  <table width="313" align="center">
    <tr>
      <td width="305"><BR><fieldset>
        <font color="#FF0000"><b><br>
          &nbsp;&nbsp;<u>Confirma la BAJA de la operaci&oacute;n</u>: <br><br>
          &nbsp;&nbsp;<?=$row['nombre_o'];?>
        </b></font>
        <input name="id_baja" type="hidden" id="id_baja" value="<?=$_POST['id'];?>">
        <br><br>
        <table width="65%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%" height="30" align="center" valign="middle"><input name="Submit" type="submit" id="Submit" value="No"></td>
            <td width="50%" height="30" align="center" valign="middle"><input name="borrarop" type="submit" id="borrarop" value="Si"></td>
          </tr>
        </table>
      </fieldset></td>
    </tr>
  </table>
  </form>
<?php }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else { // fin valid_admin
	echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
}  ?>

</body>
</html>