<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Movimiento
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($fecha_mov,$tipo_mov,$idproveedor,$doc_ext,$doc_int,$observacion,$idbotella)
	{
		$sql="INSERT INTO movimiento (fecha_mov,tipo_mov,idproveedor,doc_ext,doc_int,observacion,estado)
		VALUES ('$fecha_mov','$tipo_mov','$idproveedor','$doc_ext','$doc_int','$observacion','Aceptado')";
		//return ejecutarConsulta($sql);
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idbotella))
		{
			$sql_detalle = "INSERT INTO mov_detalle(idmovimiento, idbotella, fecha_detalle, estado) VALUES ('$idingresonew', '$idbotella[$num_elementos]','$fecha_mov','Aceptado')";
			ejecutarConsulta($sql_detalle) or $sw = false;


		//		$sql_update_status_botella = "UPDATE botella SET estado='$tipo_mov' WHERE idbotella = '$idbotella[$num_elementos]' ";

			//		ejecutarConsulta($sql_update_status_botella) or $sw = false;

					$sql_update_status_botella = "UPDATE botella SET estado=(SELECT m.tipo_mov from mov_detalle de INNER JOIN movimiento m ON de.idmovimiento = m.idmovimiento WHERE de.idbotella = '$idbotella[$num_elementos]' ORDER by m.fecha_mov DESC LIMIT 1) WHERE idbotella = '$idbotella[$num_elementos]'";
							ejecutarConsulta($sql_update_status_botella) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}


	//Implementamos un método para anular categorías
	public function anular($idmovimiento)
	{
		$sql="UPDATE movimiento SET estado='Anulado' WHERE idmovimiento='$idmovimiento'";
		ejecutarConsulta($sql);
		$sql2 ="SELECT d.idmov_detalle, m.tipo_mov, d.idbotella FROM mov_detalle d INNER JOIN movimiento m ON d.idmovimiento = m.idmovimiento WHERE d.idmovimiento = '$idmovimiento'";
		$rspta=ejecutarConsulta($sql2);
		//$fetch=$rspta->fetch_object();

		$sw=true;
		while ($fetch=$rspta->fetch_object())
		{
				$sql_anula_detalle ="UPDATE mov_detalle SET estado = 'Anulado' WHERE idmovimiento = $idmovimiento and idmov_detalle = $fetch->idmov_detalle ";
				ejecutarConsulta($sql_anula_detalle) or $sw = false;

				$sql_update_status_botella = "UPDATE botella SET estado=(SELECT m.tipo_mov from mov_detalle de INNER JOIN movimiento m ON de.idmovimiento = m.idmovimiento WHERE de.idbotella = $fetch->idbotella and de.estado ='Aceptado' ORDER by m.fecha_mov DESC LIMIT 1) WHERE idbotella = $fetch->idbotella";
						ejecutarConsulta($sql_update_status_botella) or $sw = false;

		}
	return $sw;
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmovimiento)
	{
		$sql="SELECT i.idmovimiento,DATE(i.fecha_mov) as fecha,i.tipo_mov,i.idproveedor,p.nombre as proveedor, i.doc_ext,i.doc_int, i.observacion,i.estado FROM movimiento i INNER JOIN proveedor p ON i.idproveedor=p.idproveedor WHERE i.idmovimiento='$idmovimiento'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idmovimiento)
	{
		$sql="SELECT di.idmovimiento,di.idbotella,a.descripcion,a.cod_botella,di.fecha_detalle,di.estado FROM mov_detalle di inner join botella a on di.idbotella=a.idbotella where di.idmovimiento='$idmovimiento'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT i.idmovimiento,i.fecha_mov as fecha,i.tipo_mov,i.idproveedor,p.nombre as proveedor, i.doc_ext,i.doc_int,i.estado FROM movimiento i INNER JOIN proveedor p ON i.idproveedor=p.idproveedor ORDER BY i.idmovimiento desc";
		return ejecutarConsulta($sql);
	}

}

?>
