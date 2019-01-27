<?php
require_once("conexion.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript">
            setTimeout('document.location.reload()',5000)//especificamos los milisegundos en que la página se recarga
        </script>
		<title>Highcharts Example</title>

		<script type="text/javascript" src="../resources/jquery.js"></script>
		<style type="text/css">
        ${demo.css}
		</style>
		<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            title: {
                text: 'Reporte Temperatura, Humedad, Gas LP y Distancia (cm) con Arduino',
                x: -20 //center
            },
            subtitle: {
                text: 'ITTol Microcontroladores',
                x: -20
            },
            xAxis: {
                categories: [
                <?php
                    $sql = " select fecha_hora from sensores order by id desc limit 10 ";
                    $result = mysqli_query($connection, $sql);
                    while($registros = mysqli_fetch_array($result)){
                        ?>
                            '<?php echo  $registros["fecha_hora"]?>',
                        <?php
                    }
                ?>
                ]
            },
            yAxis: {
                title: {
                    text: 'Valores del Arduino'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' Arduino'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [
            {   name: 'Humedad',
                data: [
                <?php
                    $query = " select humedad from sensores order by id desc limit 10 ";
                    $resultados = mysqli_query($connection, $query);
                    while($rows = mysqli_fetch_array($resultados)){
                        ?>
                            <?php echo $rows["humedad"]?>,
                        <?php
                    }
                ?>]
            },
            {   name: 'Temperatura',
                data: [
                <?php
                    $query = " select temperatura from sensores order by id desc limit 10 ";
                    $resultados = mysqli_query($connection, $query);
                    while($rows = mysqli_fetch_array($resultados)){
                        ?>
                            <?php echo $rows["temperatura"]?>,
                        <?php
                    }
                ?>
                ]
            },
            {   name: 'Gas',
                data: [
                <?php
                    $query = " select gas from sensores order by id desc limit 10 ";
                    $resultados = mysqli_query($connection, $query);
                    while($rows = mysqli_fetch_array($resultados)){
                        ?>
                            <?php echo $rows["gas"]?>,
                        <?php
                    }
                ?>]
            },
            {   name: 'Distancia',
                data: [
                <?php
                    $query = " select distancia from sensores order by id desc limit 10 ";
                    $resultados = mysqli_query($connection, $query);
                    while($rows = mysqli_fetch_array($resultados)){
                        ?>
                            <?php echo $rows["distancia"]?>,
                        <?php
                    }
                ?>]
            },
            {   name: 'Presion',
                data: [
                <?php
                    $query = " select presion from sensores order by id desc limit 10 ";
                    $resultados = mysqli_query($connection, $query);
                    while($rows = mysqli_fetch_array($resultados)){
                        ?>
                            <?php echo $rows["presion"]?>,
                        <?php
                    }
                ?>]
            }
            ]
        });
});
		</script>
	</head>
	<body>
<script src="../resources/highcharts.js"></script>
<script src="../resources/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
</html>

