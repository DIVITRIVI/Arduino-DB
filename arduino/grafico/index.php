<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Reporte Temperatura y Humedad Con Arduino</title>
	<style>
    #myFrame { width:100%; height:450px; }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
	<iframe src="grafico_temperatura.php" id="myFrame" frameBorder="0"></iframe>
<?php
//include("graficotemperatura.php");
?>
<br />
<br />
<iframe src="grafico_humedad.php" id="myFrame" frameBorder="0"></iframe>
<?php
//include("graficohumedad.php");
?>
<br />
<br />
<iframe src="grafico_presion.php" id="myFrame" frameBorder="0"></iframe>
<?php
//include("graficopresion.php");
?>
<br />
<div class="container" style="padding-top:50px">
	<h2>Genera un reporte PDF desde MySQL usando PHP</h2>
	<form class="form-inline" method="post" action="generate_pdf.php">
		<button type="submit" id="pdf" name="generate_pdf" class="btn btn-primary"><i class="fa fa-pdf"" aria-hidden="true"></i>
		Crea PDF</button>
	</form>
	</fieldset>
</div>
<br />
<br />
<div class="container" style="padding-top:50px">
	<h2>Genera un archivo cvs desde MySQL usando PHP</h2>
	<form class="form-inline" method="post" action="excel.php">
		<button type="submit" id="pdf" name="generate_pdf" class="btn btn-primary"><i class="fa fa-pdf"" aria-hidden="true"></i>
		Crea CVS</button>
	</form>
	</fieldset>
</div>
</body>
</html>