<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Dashboard
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	public function total_botellas()
	{
    $sql="SELECT COUNT(idbotella) as total_botellas FROM botella ";
		return ejecutarConsulta($sql);
	}

  public function pendientes_devolucion()
  {
    $sql="SELECT COUNT(idbotella) as total_botellas FROM botella WHERE estado ='SALIDA PRESTAMO'";
    return ejecutarConsulta($sql);
  }

}

?>
