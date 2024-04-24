<?php

$usuario = 'root';
$clave = '';
$servidor = 'localhost';
$basededatos = 'id17751976_iot';
        
$conexion = mysqli_connect($servidor,$usuario,$clave) or die('No se pudo conectar al servidor');
mysqli_set_charset($conexion,'utf-8');
$bdd = mysqli_select_db($conexion,$basededatos) or die('No se pudo conectar con la base de datos');

$hoy=date("Y/m/d");
$nombreReporte=$hoy."- DatosIOT_MarianoBordon";
header("Pragma: public");
header("Expires: 0");
header("Content-type: application/x-msdownload; charset=utf-8");
header("Content-Disposition: attachment; filename=".$nombreReporte.".xls");  
header("Pragma: no-cache");  
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

$datosweb = "SELECT DISTINCT * FROM stock ORDER BY id DESC";
$registros= mysqli_query($conexion,$datosweb) or die('Error en la Query');

?>
<table>
    <thead>
        <tr>
            <th>ID</th><th>Fecha</th><th>Hora</th><th>mac</th>
            <th>Dispositivo</th><th>Usuario</th><th>Nivel</th><th>Unidad</th><th>Volumen</th><th>Kilos</th><th>Rango</th>
            <th>Situacion</th><th>Estado</th>
        </tr>
    </thead>
 
    <tbody>
   <?php
      while($query1 = mysqli_fetch_array($registros)){
       echo "<tr>";
        echo "<td>".$query1['id']."</td>";
        echo "<td>".$query1['fecha']."</td>";
        echo "<td>".$query1['hora']."</td>";
        echo "<td>".$query1['mac']."</td>";
        echo "<td>".$query1['dispositivo']."</td>";
        echo "<td>".$query1['usuario']."</td>";
        echo "<td>".$query1['alturaactual']."</td>";
        echo "<td>".$query1['unidad']."</td>";
        echo "<td>".$query1['volumenactual']."</td>";
        echo "<td>".$query1['pesoaprox']."</td>";
        echo "<td>".$query1['rango']."</td>";
        echo "<td>".$query1['situacion']."</td>";
        echo "<td>".$query1['estado']."</td>";
       echo "</tr>";
       }
   ?>
    </tbody>
</table>