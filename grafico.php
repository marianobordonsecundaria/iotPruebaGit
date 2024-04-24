<!DOCTYPE html>
<html lang="es">
    
<head>
    <title>Promedios de datos obtenidos</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>      <!--  libreria para el grafico https://www.chartjs.org/docs/latest/  -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Consulta</title>
</head>


<body>
 

<main>
    <div class="container-fluid">
        <h3 style="color: #81B214; font-size: 35px; font-weight: bold; text-align: center; margin: 5px;" >Grafico nivel PORCENTUAL Pomedio</h3>
        <div>
            <a href="consultastock.php" class="btn btn-success btn-lg" role="button" style="margin: 2em">Volver</a>
        </div>

<?php

// parametros para establecer la conexion COMPLETAR CON LOS DATOS DE SUS CUENTAS
$mysql_db_servidor = "localhost";
$mysql_db_usuario = "root";
$mysql_db_password = "";
$mysql_db_database = "id17751976_iot";

$con = mysqli_connect($mysql_db_servidor, $mysql_db_usuario,
       $mysql_db_password,$mysql_db_database ) or die("No puedo conectar al servidor");



$sql00 = "SELECT fecha,avg(100*alturaactual/alturatotal) as promedioStock FROM `stock` WHERE 1 group by fecha";
$resultado00  = mysqli_query($con, $sql00);

$etiquetas="";
$valores="";

while ($res00 = mysqli_fetch_array($resultado00)){



// aca voy llenando variables con los valores para las etiquetas de eje x y los valores
// promedio de cada fecha separados por comas (y las estiquetas entre comillas simples)

$etiquetas=$etiquetas."'". ($res00['fecha'])."',";
$valores=$valores.$res00['promedioStock'].",";
}



?>


</tbody>
</table>
<!--  defino espacio  para el grafico -->
<div>
    <canvas id="myChart" width="800" height="200"></canvas>
</div>


<!--  creo el grafico en Javascript  -->

<!-- reemplazo las etiquetas y los valores con las variables que arme en php y
uso rtrim para scar la ultima coma que agregue de mas
el formato es data:{labels:[ACA PONGO LA VARIABLE CON LAS ETIQUETAS SEPARADAS POR COMA Y ENTRE COMILLAS SIMPLES X QUE ES UN STRING],
              datasets:[{label: 'nombre se la serie de datos',
                         data:[ACA PONGO LA VARIABLE CO LOS DATOS SEPARADOS X COMAS (SIN COMILLAS X QUE ES UN VALOR ESCALAR)],
                         DESPUES VINENEN LAS OPCIONES DE COLOR Y GROSOR DE LA LINEA
                         Y PUEDO REPETIR EL ESQUEMA PARA PONES TODAS LAS SERIES DE DATOS QUE QUIERA...-->


<script>

const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo rtrim($etiquetas,",") ?>],
        datasets: [{
            label: ' Nivel Promedio (Volumen) X DIA',
            data: [<?php echo rtrim($valores,",") ?>],
            backgroundColor: [
                'rgba(255, 159, 64, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 2
        },


       ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</div>
</main>

</body>

</html>

<?php
// funcion que toma la fecha como ansi AAAMMDD y devuelve como DD/MM/AAAA
function myfecha ($mydia) {
$mydia=substr($mydia,6,2)."/".substr($mydia,4,2)."/".substr($mydia,0,4);
return $mydia;
}

?>