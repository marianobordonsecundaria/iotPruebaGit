<?php
// obtengo los parametros que paso el dispositivo
error_reporting(E_ALL);
$mac=$_GET["mac"];
$valor=$_GET["valor"];
$dispositivo=$_GET["dispositivo"];
$unidad=$_GET["unidad"];
$estado=$_GET["estado"];
$usuario=$_GET["usuario"];
$alturatotal=$_GET["alturatotal"];
$diametromedio=$_GET["diametro"];
$densidad=$_GET["densidad"];

if ($valor>$alturatotal) {
	$valor=$alturatotal;
}

$alturaactual=round($alturatotal-$valor, 2);
$volumenactual=round(3.1415*$diametromedio*$diametromedio*$alturaactual/4000, 2);
$pesoaprox=round($volumenactual*$densidad, 2);


//Definición del rango y situación
if ($alturaactual>$alturatotal*0.6) {
	$rango='60%-100%';
	$situacion='Ok';
} elseif ($alturaactual<=$alturatotal*0.6 && $alturaactual>$alturatotal*0.4) {
	$rango='40%-60%';
	$situacion='Aceptable';
} elseif ($alturaactual<=$alturatotal*0.4 && $alturaactual>$alturatotal*0.2) {
	$rango='20%-40%';
	$situacion='Atencion';
} elseif ($alturaactual<=$alturatotal*0.2 && $alturaactual>$alturatotal*0.05) {
	$rango='05%-20%';
	$situacion='Urgente';
} else{
	$rango='00%-05%';
	$situacion='CRITICO';
}


date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha=date("Y-m-d");
$hora=date("H:i:s");

// parametros para establecer la conexion
$mysql_db_servidor = "localhost";
$mysql_db_usuario = "id17751976_admin";
$mysql_db_password = "Mariano2021++";
$mysql_db_database = "id17751976_iot";
// conexion con el servidor
$con = mysqli_connect($mysql_db_servidor, $mysql_db_usuario,$mysql_db_password,$mysql_db_database) or die("No puedo conectar al servidor");
// preparo el SQL para grabar la informacion
$SQL = "INSERT INTO stock (id, fecha, hora, mac, dispositivo, usuario, distancia, unidad, alturatotal, alturaactual, volumenactual, diametromedio, densidad, pesoaprox, rango, situacion, estado) VALUES (NULL, '$fecha', '$hora', '$mac', '$dispositivo', '$usuario', '$valor', '$unidad', '$alturatotal', '$alturaactual', '$volumenactual', '$diametromedio', '$densidad', '$pesoaprox', '$rango', '$situacion', '$estado')";
$guardado=mysqli_query($con,$SQL) or die($SQL);
if ($guardado) {
	echo "OK  ' $fecha  $hora  ",date('r');
}
?>