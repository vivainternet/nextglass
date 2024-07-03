<?php
function resta_fechas($fecha1, $fecha2)
{
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha1))
		list($dia1, $mes1, $anyo1) = preg_split("/", $fecha1);

	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha1))
		list($dia1, $mes1, $anyo1) = preg_split("-", $fecha1);

	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha2))
		list($dia2, $mes2, $anyo2) = preg_split("/", $fecha2);

	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha2))
		list($dia2, $mes2, $anyo2) = preg_split("-", $fecha2);

	$dif 	  = mktime(0, 0, 0, $mes1, $dia1, $anyo1) - mktime(0, 0, 0, $mes2, $dia2, $anyo2);
	$ndias  = floor($dif / (24 * 60 * 60));
	return ($ndias);
}

function resta_fechas_hora($fecha1, $fecha2)
{	// RESTA 2 FECHAS Y LA MUESTRA EN FORMATO HH:MM:SS

	$y1	  = substr($fecha1, 0, 4);
	$mes1 = substr($fecha1, 5, 2);
	$d1   = substr($fecha1, 8, 2);
	$h1	  = substr($fecha1, 11, 2);
	$m1   = substr($fecha1, 14, 2);
	$s1   = substr($fecha1, 17, 2);
	$y2	  = substr($fecha2, 0, 4);
	$mes2 = substr($fecha2, 5, 2);
	$d2   = substr($fecha2, 8, 2);
	$h2	  = substr($fecha2, 11, 2);
	$m2   = substr($fecha2, 14, 2);
	$s2   = substr($fecha2, 17, 2);

	$second1 = mktime($h1, $m1, $s1, $mes1, $d1, $y1);
	$second2 = mktime($h2, $m2, $s2, $mes2, $d2, $y2);		//converting it into seconds

	if ($second1 == $second2 || $second1 < $second2) {
		$resultTime = "00:00:00";
		return $resultTime;
		exit();
	}

	$second3 = $second1 - $second2;
	//print $second3;
	if ($second3 == 0) {
		$h3 = 0;
	} else {
		$h3 = floor($second3 / 3600);
	}		// find total hours

	$remSecond = $second3 - ($h3 * 3600);	// get remaining seconds

	if ($remSecond == 0) {
		$m3 = 0;
	} else {
		$m3 = floor($remSecond / 60);
	}		// for finding remaining  minutes

	$s3 = $remSecond - (60 * $m3);

	if ($h3 == 0)	$h3 = "00";	//formating result.
	if ($m3 == 0)  $m3 = "00";
	if ($s3 == 0)  $s3 = "00";

	$resultTime = sprintf("%02s", $h3) . ":" . sprintf("%02s", $m3) . ":" . sprintf("%02s", $s3); // COMPLETA CON CERO sprintf("%02s", $s3)

	return ($resultTime);
}

function compara_fechas($fecha1, $fecha2)
{

	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha1))
		list($anyo1, $mes1, $dia1) = preg_split("/", $fecha1);

	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha1))
		list($anyo1, $mes1, $dia1) = preg_split("-", $fecha1);

	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha2))
		list($anyo2, $mes2, $dia2) = preg_split("/", $fecha2);

	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha2))
		list($anyo2, $mes2, $dia2) = preg_split("-", $fecha2);

	$dif = mktime(0, 0, 0, $mes1, $dia1, $anyo1) - mktime(0, 0, 0, $mes2, $dia2, $anyo2);
	return ($dif);
}

function suma_fechas($fecha, $ndias)
{

	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha))
		list($anyo, $mes, $dia) = preg_split("/", $fecha);

	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha))
		list($anyo, $mes, $dia) = preg_split("-", $fecha);

	$nueva = mktime(0, 0, 0, $mes, $dia, $anyo) + $ndias * 24 * 60 * 60;
	$nuevafecha = date("Y-m-d", $nueva);

	return ($nuevafecha);
}

function f_datef($date)
{
	# ==========================================================
	# ==== Recibe una fecha con formato aaaa-mm-dd hh:mm:ss ====
	# ==== Devuelve una fecha con formato dd-mm-aa ====
	# ==========================================================

	$year	 = substr($date, 0, 4);
	$month = substr($date, 5, 2);
	$day	 = substr($date, 8, 2);
	$date	 = $day . "-" . $month . "-" . $year;

	return ($date);
}

function f_datef_hour($date)
{
	# ==========================================================
	# ==== Recibe una fecha con formato aaaa-mm-dd hh:mm:ss ====
	# ==== Devuelve una fecha con formato hh:mm:ss dd-mm-aa ====
	# ==========================================================

	$year	  = substr($date, 0, 4);
	$month  = substr($date, 5, 2);
	$day	  = substr($date, 8, 2);

	$hour	  = substr($date, 11, 2);
	$minute = substr($date, 14, 2);
	$second = substr($date, 17, 2);

	$date	 = $hour . ":" . $minute . ":" . $second . "<br>" . $day . "-" . $month . "-" . $year;

	return ($date);
}

function mysql_date($date)
{ // by Mich.
	# ==========================================================
	# ==== Recibe una fecha con formato dd-mm-aaaa ====
	# ==== Devuelve una fecha con formato aaaa-mm-dd ====
	# ==========================================================

	$year  = substr($date, 6, 4); // 01-12-2007
	$month = substr($date, 3, 2); // 0123456789
	$day   = substr($date, 0, 2);
	$date  = $year . "-" . $month . "-" . $day;

	return ($date);
}
