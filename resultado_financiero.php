<?php require_once('db/conexion.php');
session_start();
include('inc_fechas.php');
$suma = 0;
//debug if( isset($_SESSION[filtrocobrador]) )	echo 'IS SET - SESS'.$_SESSION[filtrocobrador]; echo ' - GET'.$_GET[filtrocobrador];

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Resultado Financiero</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
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

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body>
<?php
if ( isset($_SESSION['valid_admin']) ) { ?>
	<?php include('menu.php'); ?>
	<table width="970" border="0" align="center" cellpadding="0" cellspacing="0" id="buscar">
	  <tr>
		<form action="" name="RFAnual" method="post" enctype="application/x-www-form-urlencoded">
		  <td height="50" align="center"><span class="buscarLegend">Por Fecha:</span>
		    <select name="anual" id="anual" class="inputBuscar" onChange="MM_jumpMenu('parent',this,0)">
					<option value="resultado_financiero.php?anual=todo">Todo</option>

			<?php 	// SELLECCIONA EL A�O MAXIMO Y MINIMO
				$sql_filtro_anual  = " SELECT MIN(fecha_pago) AS desde, MAX(fecha_pago) AS hasta FROM ingresos ";
				$res_filtro_anual  = $conn->query($sql_filtro_anual  );
				$row_filtro_anual  = mysql_fetch_array($res_filtro_anual);

				// ARMA LOS <OPTION> POR A�O ORDENADO DE MAYOR A MENOR
				for ( $y = substr($row_filtro_anual[hasta],0,4); 	$y >= substr($row_filtro_anual[desde],0,4);		$y-- ) {
					?>
					<option value="resultado_financiero.php?anual=<?=$y?>" <?php
						if ( $y == $_GET[anual] || ($_GET[anual]=="" && $y == date('Y')) ) echo 'selected';
					?>><?=$y?></option>
			 <?php } ?>
		  </select>
		</td>
		</form>
	  </tr>
	</table>

		<table width="976" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="50%" valign="top">

			<!-- ENCABEZADOS DE TABLA xConcepto -->
				<table width="480" border="1" cellpadding="0" cellspacing="0" bordercolor="#E5E5E5" id="xConcepto">
				  <tr>
					<td width="20" height="25" align="center" class="tdBordeCelesteInf">Id</td>

					<td width="173" class="tdBordeCelesteInf">&nbsp;<strong>Conceptos</strong> </td>
					<td width="80" align="right" class="tdBordeCelesteInf">Ingresos&nbsp;</td>
					<td width="80" align="right" class="tdBordeCelesteInf">Egresos&nbsp;</td>
					<td width="80" align="right" class="tdBordeCelesteInf"><strong>Neto&nbsp;</strong></td>
				  </tr>
			<!-- FIN ENCABEZADOS DE TABLA -->
	<?php
	$sql_concepto = " SELECT * FROM concepto ";
	$res_concepto = $conn->query($sql_concepto);
	//debug echo '<br><br>'.mysql_num_rows($res_concepto).' - '.$sql_concepto;

		for ( $i=1; $i <= mysql_num_rows($res_concepto); $i++ ) {
			$row_concepto = mysql_fetch_array($res_concepto);

			if ( ($i%2)==0 ) { $fondo="#FFFFFF"; } else { $fondo="#F5F5F5"; }
			?>
			<tr onmouseover=mOvr(this,'#CAE4FF'); onmouseout=mOut(this,'<?=$fondo;?>'); bgcolor="<?=$fondo;?>">

				<td align="center"><?=$row_concepto['concepto_id']; ?></td>

				<td>&nbsp;<?=$row_concepto['concepto']; ?></td>

				<td align="right">
			<?php
			// INGRESOS: SELECT Y SUMA POR CONCEPTO. No hace bucle porque sum() solo necesita ejecutarse una vez con mysql_fetch_array
			$sql_ing  = " SELECT SUM(importe) AS importe FROM ingresos
						  WHERE conceptoid = $row_concepto[concepto_id] ";

		// FILTRA POR A�O
		if ( $_GET['anual']=="" ) { 								// GET ANUAL ="" FILTRA A�O ACTUAL (para que no filtre toda la base)
			$sql_ing .= " AND fecha_pago > '".date('Y')."-01-00'";
			$sql_ing .= " AND fecha_pago < '".date('Y')."-12-32'";

		} elseif ( $_GET['anual']!="todo" ) { 						// GET ANUAL DIFERENTE DE 'todo' FILTRA POR A�O SELECCIONADO
			$sql_ing .= " AND fecha_pago > '".$_GET[anual]."-01-00'";
			$sql_ing .= " AND fecha_pago < '".$_GET[anual]."-12-32'";
		}

			$res_ing = $conn->query($sql_ing);
			$row_ing = mysql_fetch_array($res_ing);

			// ACUMULA VARIABLE PARA QUE <TABLE Ingresos Totales>  NO CONSULTE NUEVAMENTE A LA BASE
			$conid = $row_concepto['concepto_id'];
			$concepto_ing[$conid] 		= $row_ing['importe']; 				// ACUMULA POR CONCEPTO. ASIGNA ID A LA MATRIZ.
			$concepto_nombre[$conid] 	= $row_concepto['concepto']; 		// ASIGNA A LA VARIABLE EL NOMBRE DEL CONCEPTO
			$concepto_tipo_ing[$conid] 	= $row_concepto['tipo_ingreso']; 	// ASIGNA TIPO
			$concepto_tipo_egr[$conid] 	= $row_concepto['tipo_ingreso']; 	// ASIGNA TIPO

			$suma_ing = $suma_ing + $row_ing['importe'];	// ACUMULA TOTAL
			?>
				<?=$row_ing['importe']; ?>&nbsp;&nbsp;</td>

				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
				</tr>
	<?php	} // FIN FOR ?>
			<tr class="tdBordeCelesteInf">
				<td height="20" align="center">&nbsp;</td>
				<td align="right">Total:&nbsp;</td>
				<td align="right"><?=$suma_ing?>&nbsp;&nbsp;</td>
				<td align="center">egr</td>
				<td align="center">neto</td>
				</tr>
			</table>			</td>
		    <td width="50%" valign="top">





			<!-- ENCABEZADOS DE TABLA FormaPago-->
				<table width="480" border="1" align="right" cellpadding="0" cellspacing="0" bordercolor="#E5E5E5" id="FormaPago">
				  <tr>
					<td width="20" height="25" align="center" class="tdBordeCelesteInf">Id</td>

					<td width="173" class="tdBordeCelesteInf">&nbsp;<strong>Forma de Pago</strong> </td>
					<td width="80" align="right" class="tdBordeCelesteInf">Ingresos&nbsp;</td>
					<td width="80" align="right" class="tdBordeCelesteInf">Egresos&nbsp;</td>
					<td width="80" align="right" class="tdBordeCelesteInf"><strong>Neto&nbsp;</strong></td>
				  </tr>
			<!-- FIN ENCABEZADOS DE TABLA FormaPago -->
	<?php
	$sql_forma_pago = " SELECT * FROM forma_pago ";
	$res_forma_pago = $conn->query($sql_forma_pago);
	//debug echo '<br><br>'.mysql_num_rows($res_forma_pago).' - '.$sql_forma_pago;

		for ( $j=1; $j <= mysql_num_rows($res_forma_pago); $j++ ) {
			$row_forma_pago = mysql_fetch_array($res_forma_pago);

			if ( ($j%2)==0 ) { $fondo="#FFFFFF"; } else { $fondo="#F5F5F5"; }
			?>
			<tr onmouseover=mOvr(this,'#CAE4FF'); onmouseout=mOut(this,'<?=$fondo;?>'); bgcolor="<?=$fondo;?>">

				<td align="center"><?=$row_forma_pago['formapago_id']; ?></td>

				<td>&nbsp;<?=$row_forma_pago['formapago']; ?></td>

				<td align="right">
			<?php
			// INGRESOS: SELECT Y SUMA POR FORMA PAGO. No hace bucle porque sum() solo necesita ejecutarse una vez con mysql_fetch_array
			$sql_ing_fp = " SELECT SUM(importe) AS importe FROM ingresos
							WHERE formapagoid = $row_forma_pago[formapago_id] ";

		// FILTRA POR A�O
		if ( $_GET['anual']=="" ) { 								// GET ANUAL ="" FILTRA A�O ACTUAL (para que no filtre toda la base)
			$sql_ing_fp .= " AND fecha_pago > '".date('Y')."-01-00'";
			$sql_ing_fp .= " AND fecha_pago < '".date('Y')."-12-32'";

		} elseif ( $_GET['anual']!="todo" ) { 						// GET ANUAL DIFERENTE DE 'todo' FILTRA POR A�O SELECCIONADO
			$sql_ing_fp .= " AND fecha_pago > '".$_GET[anual]."-01-00'";
			$sql_ing_fp .= " AND fecha_pago < '".$_GET[anual]."-12-32'";
		}

			$res_ing_fp = $conn->query($sql_ing_fp);
			$row_ing_fp = mysql_fetch_array($res_ing_fp);

			$suma_ing_fp = $suma_ing_fp + $row_ing_fp['importe'];	// ACUMULA INGRESO TOTAL
			?>
				<?=$row_ing_fp['importe']; ?>&nbsp;&nbsp;</td>

				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
				</tr>
	<?php	} // FIN FOR ?>


<?php		// CREA FILAS VACIAS PARA IGUALAR EL LARGO DEL DISE�O DE LA <TABLE 'xConcepto'>
		for ( $k=1; $k <= ( mysql_num_rows($res_concepto)-mysql_num_rows($res_forma_pago) ); $k++ ) {
			?>
			<tr>
				<td colspan="5" bordercolor="#FFFFFF">&nbsp;</td>
			</tr>
	<?php	} // FIN FOR ?>





			<tr class="tdBordeCelesteInf">
				<td height="20" colspan="2" align="right">Total:&nbsp;</td>
				<td align="right"><?=$suma_ing_fp?>&nbsp;&nbsp;</td>
				<td align="center">egr</td>
				<td align="center">neto</td>
				</tr>
			</table>			</td>
		  </tr>
		  <tr>
		    <td height="40" background="images/sfx_titlebar_bg2.png">&nbsp;</td>
		    <td background="images/sfx_bg2.png">&nbsp;</td>
	      </tr>
		  <tr>
		    <td valign="top">
			<table border="1" cellpadding="0" cellspacing="0" bordercolor="#E5E5E5" id="IngresosTotales">
              <!-- ENCABEZADOS DE TABLA-->
              <tr>
                <td width="20" height="25" align="center" class="tdBordeCelesteInf">Id</td>
                <td width="185" class="tdBordeCelesteInf">&nbsp;<strong>INGRESOS TOTALES</strong> </td>
                <td width="86" align="right" class="tdBordeCelesteInf">Importe&nbsp;&nbsp;</td>
              </tr>
              <!-- FIN ENCABEZADOS DE TABLA-->
              <?php
		for ( $i=1; $i <= mysql_num_rows($res_concepto); $i++ ) {

			if ( ($i%2)==0 ) { $fondo="#FFFFFF"; } else { $fondo="#F5F5F5"; }
			?>
              <tr onmouseover=mOvr(this,'#CAE4FF'); onmouseout=mOut(this,'<?=$fondo;?>'); bgcolor="<?=$fondo;?>">
                <td align="center"><?=$i?></td>
                <td>&nbsp;<?=$concepto_tipo_ing[$i].'-'.$concepto_tipo_egr[$i].'- '.$concepto_nombre[$i];?></td>
                <td align="right"><?=$concepto_ing[$i]?>&nbsp;</td>
              </tr>
	<?php	} // FIN FOR ?>
              <tr class="tdBordeCelesteInf">
                <td height="20" colspan="2" align="right">Total:&nbsp;</td>
                <td align="right"><?=$suma_ing?>&nbsp;&nbsp;</td>
              </tr>
            </table></td>
		    <td valign="top">

              <p>&nbsp;</p>
              <div style="border: 1px solid #CEF2E0; color: #299961; background-color: #F5FFFA; text-align: center; font-size: 150%; padding: 5px; margin-top: 5px;">Neto </div>

<div style="border: 1px solid #E4B39B; color: #FF7256; background-color: #FFE7BA; text-align: center; font-size: 150%; padding: 5px; margin-top: 5px;">Egresos</div>
<div style="margin-top: 5px; padding: 7px; background-color: #FAFAFA; border: 1px solid #E2E2E2;">Fondo Gris </div>
			<p><img src="images/bar_violeta.gif" width="100" height="20"> <img src="images/bar_celeste.gif" width="100" height="20"> <img src="images/bar_naranja.gif" width="100" height="20"> <img src="images/bar_turquesa.gif" width="100" height="20"></p>
			<p><img src="images/bar_verdeclaro.gif" width="100" height="20"> <img src="images/bar_verdeoscuro.gif" width="100" height="20"> <img src="images/bar_amarillo.gif" width="100" height="20">&nbsp;<img src="images/bar_azul.gif" width="100" height="20"></p>			</td>
	      </tr>
		  <tr>
		    <td valign="top">


			  <p>&nbsp;</p>
  <?php
  if ( $_SESSION[valid_admin]=='admin' ) { // EL ADMIN PUEDE VER ////////////////////// ?>
		    <!-- ENCABEZADOS DE TABLA xVendedorProgramador -->
			  <table width="480" border="1" cellpadding="0" cellspacing="0" bordercolor="#E5E5E5" id="xVendedorProgramador">
				  <tr>
					<td width="20" height="25" align="center" class="tdBordeCelesteInf">Id</td>

					<td width="173" class="tdBordeCelesteInf">&nbsp;<strong>VENTAS: DISE&Ntilde;O</strong></td>
					<td width="80" align="right" class="tdBordeCelesteInf">Vendido&nbsp;</td>
					<td width="80" align="right" class="tdBordeCelesteInf">Programado&nbsp;</td>
					<td width="80" align="right" class="tdBordeCelesteInf">Cobrado&nbsp;</td>
				  </tr>
			<!-- FIN ENCABEZADOS DE TABLA -->
	<?php
	$sql_vendprg = " SELECT * FROM login ";
	$res_vendprg = $conn->query($sql_vendprg);
	//debug echo '<br><br>'.mysql_num_rows($res_vendprg).' - '.$sql_vendprg;

	// LISTA VENDEDORES
	for ( $i=1; $i <= mysql_num_rows($res_vendprg); $i++ ) {
			$row_vendprg = mysql_fetch_array($res_vendprg);

			if ( ($i%2)==0 ) { $fondo="#FFFFFF"; } else { $fondo="#F5F5F5"; }
			?>
			<tr onmouseover=mOvr(this,'#CAE4FF'); onmouseout=mOut(this,'<?=$fondo;?>'); bgcolor="<?=$fondo;?>">

				<td align="center"><?=$row_vendprg['userid']; ?></td>

				<td height="20">&nbsp;<?=$row_vendprg['nombrereal']; ?></td>

				<td align="right">
			<?php // VENDEDOR: SELECT Y SUMA POR VENDEDOR. No hace bucle porque sum() solo necesita ejecutarse una vez con mysql_fetch_array
			$sql_ing_vend  = " SELECT SUM(planpago_importe) AS importe FROM plan_pago, cuentas
							   WHERE plan_pago.conceptoid = 1 AND cuentas.cuenta_id = plan_pago.cuenta_id AND cuentas.vendedor_id = $row_vendprg[userid] ";

		// FILTRA POR A�O
		if ( $_GET['anual']=="" ) { 								// GET ANUAL ="" FILTRA A�O ACTUAL (para que no filtre toda la base)
			$sql_ing_vend .= " AND planpago_vto > '".date('Y')."-01-00'";
			$sql_ing_vend .= " AND planpago_vto < '".date('Y')."-12-32'";

		} elseif ( $_GET['anual']!="todo" ) { 						// GET ANUAL DIFERENTE DE 'todo' FILTRA POR A�O SELECCIONADO
			$sql_ing_vend .= " AND planpago_vto > '".$_GET[anual]."-01-00'";
			$sql_ing_vend .= " AND planpago_vto < '".$_GET[anual]."-12-32'";
		}

			$res_ing_vend = $conn->query($sql_ing_vend);
			$row_ing_vend = mysql_fetch_array($res_ing_vend);

			$suma_ing_vend = $suma_ing_vend + $row_ing_vend['importe'];	// ACUMULA TOTAL
			?>
				<?=$row_ing_vend['importe']; ?>&nbsp;&nbsp;

				</td>

				<td align="right">
			<?php	// PROGRAMADOR: SELECT Y SUMA POR PROGRAMADOR. No hace bucle porque sum() solo necesita ejecutarse una vez con mysql_fetch_array
			$sql_ing_prg = " SELECT SUM(planpago_importe) AS importe FROM plan_pago, cuentas
							 WHERE plan_pago.conceptoid = 1 AND cuentas.cuenta_id = plan_pago.cuenta_id AND cuentas.programador_id = $row_vendprg[userid] ";

		// FILTRA POR A�O
		if ( $_GET['anual']=="" ) { 								// GET ANUAL ="" FILTRA A�O ACTUAL (para que no filtre toda la base)
			$sql_ing_prg .= " AND planpago_vto > '".date('Y')."-01-00'";
			$sql_ing_prg .= " AND planpago_vto < '".date('Y')."-12-32'";

		} elseif ( $_GET['anual']!="todo" ) { 						// GET ANUAL DIFERENTE DE 'todo' FILTRA POR A�O SELECCIONADO
			$sql_ing_prg .= " AND planpago_vto > '".$_GET[anual]."-01-00'";
			$sql_ing_prg .= " AND planpago_vto < '".$_GET[anual]."-12-32'";
		}

			$res_ing_prg = $conn->query($sql_ing_prg);
			$row_ing_prg = mysql_fetch_array($res_ing_prg);

			$suma_ing_prg = $suma_ing_prg + $row_ing_prg['importe'];	// ACUMULA TOTAL
			?>
				<?=$row_ing_prg['importe']; ?>&nbsp;&nbsp;
				</td>

				<td align="right">

			<?php	// COBRADO: SELECT Y SUMA LO COBRADO. No hace bucle porque sum() solo necesita ejecutarse una vez con mysql_fetch_array
				// NO SIGNIFICA QUE LO COBR� ESE VENDEDOR, SINO QUE SE COBR� EL TRABAJO.
			$sql_ing_cob = " SELECT SUM(importe) AS importe FROM ingresos, plan_pago, cuentas
							 WHERE plan_pago.conceptoid = 1
							 AND cuentas.cuenta_id = plan_pago.cuenta_id AND cuentas.programador_id = $row_vendprg[userid]
							 AND plan_pago.planpago_id = ingresos.planpago_id";

		// FILTRA POR A�O
		if ( $_GET['anual']=="" ) { 								// GET ANUAL ="" FILTRA A�O ACTUAL (para que no filtre toda la base)
			$sql_ing_cob .= " AND planpago_vto > '".date('Y')."-01-00'";
			$sql_ing_cob .= " AND planpago_vto < '".date('Y')."-12-32'";

		} elseif ( $_GET['anual']!="todo" ) { 						// GET ANUAL DIFERENTE DE 'todo' FILTRA POR A�O SELECCIONADO
			$sql_ing_cob .= " AND planpago_vto > '".$_GET[anual]."-01-00'";
			$sql_ing_cob .= " AND planpago_vto < '".$_GET[anual]."-12-32'";
		}

			$res_ing_cob = $conn->query($sql_ing_cob);
			$row_ing_cob = mysql_fetch_array($res_ing_cob);

			$suma_ing_cob = $suma_ing_cob + $row_ing_cob['importe'];	// ACUMULA TOTAL
			?>
				<?=$row_ing_cob['importe']; ?>&nbsp;&nbsp;

				</td>
				</tr>
	<?php
	} // FIN FOR // LISTA VENDEDORES ?>
			<tr class="tdBordeCelesteInf">
				<td height="20" align="center">&nbsp;</td>
				<td>&nbsp;(No son ingresos)&nbsp;&nbsp; &nbsp;Total Vendido:</td>
				<td align="right"><?=number_format($suma_ing_vend,2) ?>&nbsp;&nbsp;</td>
				<td align="right"><?=number_format($suma_ing_prg,2) ?>&nbsp;&nbsp;</td>
				<td align="right"><?=number_format($suma_ing_cob,2) ?>&nbsp;&nbsp;</td>
				</tr>
			</table>
   <?php
  } ?>


			</td>
		    <td valign="top">&nbsp;</td>
	      </tr>
		</table>
	<?php include('footer.php');?>
  <?php
} else {
	echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
}?>
</body>
</html>
