<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Botella
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($cod_botella,$idproveedor,$descripcion,$unidad,$medida)
	{
		$sql="INSERT INTO botella (cod_botella,idproveedor,descripcion,unidad,medida,estado)
		VALUES ('$cod_botella','$idproveedor','$descripcion','$unidad','$medida','')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idbotella,$cod_botella,$idproveedor,$descripcion,$unidad,$medida)
	{
		$sql="UPDATE botella SET cod_botella='$cod_botella',idproveedor='$idproveedor',descripcion='$descripcion',unidad='$unidad',medida='$medida' WHERE idbotella='$idbotella'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idbotella)
	{
		$sql="UPDATE botella SET estado='0' WHERE idbotella='$idbotella'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql="UPDATE botella SET estado='1' WHERE idbotella='$idbotella'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idbotella)
	{
		$sql="SELECT * FROM botella WHERE idbotella='$idbotella'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT b.idbotella,b.idproveedor,b.cod_botella,p.nombre as propietario, b.descripcion,b.unidad,b.medida,b.estado from botella b INNER JOIN proveedor p on b.idproveedor = p.idproveedor";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}



	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosVenta()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

	public function listarMovimientos($idbotella)
	{
		$sql="SELECT b.cod_botella, m.tipo_mov,m.doc_ext,m.doc_int,m.observacion, m.fecha_mov,p.nombre as 'proveedor' FROM mov_detalle de INNER JOIN movimiento m on de.idmovimiento = m.idmovimiento INNER JOIN proveedor p on p.idproveedor = m.idproveedor INNER JOIN botella b on b.idbotella = de.idbotella where de.idbotella  ='$idbotella' and de.estado='Aceptado' ";
		return ejecutarConsulta($sql);
	}


}

?>
