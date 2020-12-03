<pre>
<?php

$conexion =new mysqli('localhost','root','','base_almacen');

mysqli_query($conexion,'SET NAMES utf-8');

//si tenemos un posible error en la $conexion lo mostramos

if (mysqli_connect_errno()) {
  printf("Fallo la conexion a la base de datos: %s\n",mysqli_connect_error());
  exit();
  }
  else {

//    print("Conectado");
  }
$sql = "SELECT * FROM usuario";

$rspta = $conexion -> query($sql);
$data= Array();
$reg=$rspta->FETCH_ALL();
print_r($reg);
/*
while ($reg=$rspta->fetch_object()){

  $data[]=array(
      "id_usuario"=> $reg->idusuario,
      "nombre"=> $reg->nombre,
      "clave"=> $reg->clave,
      "tipo_doc"=> $reg->tipo_documento);
}

print_r($data);
*/
 ?>
</pre>
