<?php
        $usuario = 'root';
        $clave = '';
        $servidor = 'localhost';
        $basededatos = 'id17751976_iot';
        $fechaini=date("Ymd");
		$fechafin= date("Ymd");

        $conexion = mysqli_connect($servidor,$usuario,$clave) or die('No se pudo conectar al servidor');
        mysqli_set_charset($conexion,'utf-8');

        $bdd = mysqli_select_db($conexion,$basededatos) or die('No se pudo conectar con la base de datos');
?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<title>Consulta</title>
</head>

<body>
 

<main>
	<div class="container-fluid">
		
	<h3 style="color: #81B214; font-size: 35px; font-weight: bold; text-align: center; margin: 5px;" >Registros IoT - Mariano Bordón</h3>
		<div>
	
	<div>
	<a href="excel_datos.php" class="btn btn-success btn-lg" role="button" style="margin: 2em">Descargar EXCEL</a>
	<a href="grafico.php" class="btn btn-warning btn-lg" role="button" style="margin: 2em">Gráfico</a>
	</div>
		<div class="container-fluid">
	        <div class='row'>
	            <div class='table-responsive'>
	                <table class="table table-bordered table-sm table-hover">
	                    <thead>
	                        <tr style="background-color:#9e1354; color: white; margin:1em; border-radius: 12px;">
	                            <td># ID</td><td>Fecha</td><td>Hora</td><td>Dispositivo</td><td>Nivel</td><td>Unidad</td><td>Volumen</td><td>Kilos</td><td>Rango</td><td>Situacion</td><td>Estado</td>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	
	                        	$dato = "SELECT DISTINCT * FROM stock ORDER BY id DESC";
								$resultado = mysqli_query($conexion,$dato) or die('Error en la Query');
	                            while($query1 = mysqli_fetch_array($resultado)){
	                                echo "<tr>";
	                                    echo "<td>".$query1['id']."</td>";
	                                    echo "<td>".$query1['fecha']."</td>";
	                                    echo "<td>".$query1['hora']."</td>";
	                                    echo "<td>".$query1['dispositivo']."</td>";
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
	            </div>
	        </div>
	       </div>
	    </div>
	</div>    
</main>
</body>


<footer>

</footer>
</html>
