<?php require_once('db/conexion.php');
session_start();

if (isset($_POST['usuario']) && isset($_POST['password'])) {

	$usuario 	= $_POST['usuario'];
	$password	= crypt($_POST['password'], 'NextGlass375');

	// Debug crypt $password	= crypt('clave_cualquiera', 'NextGlass375'); echo $password; exit;

	$sql = " SELECT * FROM login WHERE username = '$usuario' AND password = '$password' ";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	$num = $res->num_rows;
	// Debug echo $sql . '<br><br>num: ' . $num . '<br>$row[password]: ' . $row['password'];

	if ($num > 0) {
		$_SESSION['valid_admin'] = $row['username'];
		$_SESSION['nombrereal'] = $row['nombrereal'];
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Administraci&oacute;n del Sistema. Usuario: <?= $_SESSION['nombrereal'] ?></title>
	<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php // valid_admin
	if (isset($_SESSION['valid_admin'])) {
		include('menu.php');
	?>

		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<table width="300" height="120" border="1" align="center" bordercolor="#FFFFFF">
			<tr>
				<td align="center" bordercolor="#CEDFF2" bgcolor="#F5FAFF">
					<H4>
						<font color="#295F99" face="Verdana, Arial, Helvetica, sans-serif"><strong><?= $_SESSION['nombrereal'] ?></strong></font>
					</h4>
				</td>
			</tr>
		</table>

		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	<?php // endof valid_admin
	} else { // Login
		if (isset($_POST['usuario']) && isset($_POST['password'])) {
			$mensaje = '<div align="center"><font color="#FF0000"><b>Usuario o contrase&ntilde;a incorecta.</b></font></div>';
		}	?>
		<p><?= $mensaje; ?></p>
		<table width="400" border="2" align="center" bordercolor="#FFFFFF" style="margin-top: 40px;">
			<tr>
				<td>
					<form action="admin.php" method="POST">
						<br>
						<table width="100%" border="0" cellpadding="0" cellspacing="5" class="textazul">
							<tr>
								<td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<img src="images/admin.png" width="128" height="128">
								</td>
							</tr>
							<tr>
								<td width="40%" align="right">Usuario:</td>
								<td width="60%"><input name="usuario" type="text" id="usuario" size="20"></td>
							</tr>
							<tr>
								<td align="right">Contrase&ntilde;a:</td>
								<td><input name="password" type="password" id="password" size="20"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><br>
									<input name="Submit" type="image" id="Login" src="images/btn_ingresar.jpg">
								</td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
		</table>
	<?php
	} // endof Login
	?>
</body>

</html>