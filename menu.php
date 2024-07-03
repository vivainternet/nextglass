<?php if (isset($_SESSION['valid_admin'])) { ?>
	<script type="text/JavaScript">
		<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
  if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
	</script>

	<body onLoad="MM_preloadImages('images/vehic_todos_on.jpg','images/vehic_alta_on.jpg','images/vehic_entaller_on.jpg','images/vehic_fuera_on.jpg','images/emp_alta_on.jpg','images/emp_mod_on.jpg','images/oper_on.jpg','images/proc_on.jpg','images/list_on.jpg')">
		<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="341">&nbsp;</td>

				<td width="225">&nbsp;</td>

				<td width="336" height="30" align="right">Usuario:
					<?= $_SESSION['nombrereal'] ?>
					<img src="images/icono_admin.jpg" width="20" height="20" border="0" align="absmiddle" /><!-- | Ayuda -->
					| <a href="logout.php">Salir</a>
				</td>
			</tr>

			<tr>
				<td height="30" colspan="3">
					<img src="images/vehic.jpg" alt="Veh&iacute;culos" width="83" height="27" /><a href="altas.php?menu=va&alta=n"
							onmouseout="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('vehic_alta','','images/vehic_alta_on.jpg',1)"><img <?php
							if ($_GET['menu'] == "va") { ?> src="images/vehic_alta_on.jpg" <?php } else { ?>src="images/vehic_alta.jpg" <?php } ?>
							alt="Alta" name="vehic_alta" width="66" height="27" border="0" id="vehic_alta" /></a><a href="altas.php?menu=et&enTaller=1"
							onmouseout="MM_swapImgRestore()" onMouseOver="MM_swapImage('vehic_entaller','','images/vehic_entaller_on.jpg',1)"><img <?php
							if ($_GET['menu'] == "et") { ?> src="images/vehic_entaller_on.jpg" <?php } else { ?>src="images/vehic_entaller.jpg" <?php } ?>
							alt="Dentro del Taller" name="vehic_entaller" width="74" height="27" border="0" id="vehic_entaller" /></a><a
							href="altas.php?menu=ft&enTaller=0"
							onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('vehic_fuera','','images/vehic_fuera_on.jpg',1)"><img <?php
							if ($_GET['menu'] == "ft") { ?> src="images/vehic_fuera_on.jpg" <?php } else { ?>src="images/vehic_fuera.jpg" <?php } ?>
							alt="Fuera de Taller" name="vehic_fuera" width="101" height="27" border="0" id="vehic_fuera" /></a><img
							src="images/esq_menu_D.jpg" width="1" height="27" border="0" /><img
							src="images/emp.jpg" alt="Empleados" width="83" height="27" /><a href="empleados.php?menu=ea&alta=n"
							onmouseout="MM_swapImgRestore()" onMouseOver="MM_swapImage('emp_alta','','images/emp_alta_on.jpg',1)"><img
							<?php if ($_GET['menu'] == "ea") { ?> src="images/emp_alta_on.jpg" <?php } else { ?>src="images/emp_alta.jpg" <?php } ?>
							alt="Alta" name="emp_alta" width="66" height="27" border="0" id="emp_alta" /></a><a href="empleados.php?menu=em"
							onmouseout="MM_swapImgRestore()" onMouseOver="MM_swapImage('emp_mod','','images/emp_mod_on.jpg',1)"><img
							<?php if ($_GET['menu'] == "em") { ?> src="images/emp_mod_on.jpg" <?php } else { ?>src="images/emp_mod.jpg" <?php } ?>
							alt="Modificar" name="emp_mod" width="74" height="27" border="0" id="emp_mod" /></a><img
							src="images/esq_menu_D.jpg" width="1" height="27" border="0" /><a href="operaciones.php?menu=oper"
							onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('oper','','images/oper_on.jpg',1)"><img
							<?php if ($_GET['menu'] == "oper") { ?> src="images/oper_on.jpg" <?php } else { ?>src="images/oper.jpg" <?php } ?>
							alt="Operaciones" name="oper" width="84" height="27" border="0" id="oper" /></a><a href="procesos.php?menu=proc&filtro=1"
							onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('proc','','images/proc_on.jpg',1)"><img
							<?php if ($_GET['menu'] == "proc") { ?> src="images/proc_on.jpg" <?php } else { ?>src="images/proc.jpg" <?php } ?>
							alt="Procesos" name="proc" width="64" height="27" border="0" id="proc" /></a><a href="filtro.php?menu=list"
							onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('list','','images/list_on.jpg',1)"><img <?php
							if ($_GET['menu'] == "list") { ?> src="images/list_on.jpg" <?php } else { ?>src="images/list.jpg" <?php } ?>
							alt="Listados" name="list" width="64" height="27" border="0" id="list" /></a>
				</td>
			</tr>
		</table>
	<?php } else { // fin valid_admin
	echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
} ?>