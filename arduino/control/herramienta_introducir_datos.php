<?php
class Herramienta{
	private $conexion;

	function __construct(){
		require_once("conexion_privada.php");
		$this->conexion = new conexion();
		$this->conexion->conectar();
	}

	public function ingresar_datos($pre_php, $hum_php, $temp_php, $dist_php){
		$sql = " insert into tabla_sensor values (null, ?, ?, ?, ?, now()) ";
		$stmt = $this->conexion->conexion->prepare($sql);

		$stmt->bindValue(1, $pre_php);
		$stmt->bindValue(2, $hum_php);
		$stmt->bindValue(3, $temp_php);
		$stmt->bindValue(4, $dist_php);

		if($stmt->execute()){
			echo "Ingreso Exitoso";
		}else{
			echo "no se pudo registrar datos";
		}
	}
}
?>