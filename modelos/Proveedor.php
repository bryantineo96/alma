<?php
//incluimos inicialmente la conexion

require '../config/conexion.php';


class Proveedor
{
  //implementamos un constructor vacio para poder instanciar
  public function __construct()
  {
    // code...
  }

  //implementamos un metodo para insertar registros
  public function insertar($nombre,$ruc,$direccion)
  {

    $sql="INSERT INTO proveedor(nombre,ruc,direccion,estado)
    VALUES('$nombre','$ruc','$direccion','1')";
    return ejecutarConsulta($sql);
  }

  //implementamos un metodo para actualizar registros
  public function editar($idproveedor,$nombre,$ruc,$direccion)
  {
    $sql="UPDATE proveedor SET nombre='$nombre', ruc='$ruc', direccion=' $direccion'where idproveedor='$idproveedor'";
    return ejecutarConsulta($sql);
  }

  //implementamos un metodo para desactivar registros
  public function eliminar($idproveedor)
  {
    $sql="DELETE FROM proveedor WHERE idproveedor='$idproveedor'";
    return ejecutarConsulta($sql);
  }

//implementamos un metodo para mostrar los datos de un registro a modificar
  public function mostrar($idproveedor)
  	{
  		$sql="SELECT * FROM proveedor WHERE idproveedor='$idproveedor'";
  		return ejecutarConsultaSimpleFila($sql);

  	}

  //implementamos un metodo para listar los registros
  public function listar()
  {
    $sql="SELECT * FROM proveedor";
    return ejecutarConsulta($sql);
  }

  public function select()
{
  $sql="SELECT * FROM proveedor ";
  return ejecutarConsulta($sql);
}

}
 ?>
