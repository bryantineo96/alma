<?php
//incluimos inicialmente la conexion

require '../config/conexion.php';


Class Permiso
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM permiso";
		return ejecutarConsulta($sql);
	}

}

?>
