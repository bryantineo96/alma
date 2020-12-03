<pre>
<?php


$conexion = new mysqli("localhost","root","","base_almacen");

mysqli_query($conexion,"SET NAME UTF-8");


if (mysqli_connect_errno()) {

  printf("Fallo la conexion a la base de datos: ", mysqli_connect_errno());
  exit();
}
else {
  printf("conexion realizada");
  // code...
}

$consulta= "SHOW FULL TABLES FROM base_almacen;";
$consulta.= "SELECT * FROM usuario";


if ($conexion->multi_query($consulta)) {
    do {
        /* almacenar primer juego de resultados */
        if ($result = $conexion->store_result()) {
            while ($row = $result->fetch_all()) {
                //printf("%s\n", $row[0]);
                print_r($row);
            }
            $result->free();
        }
        /* mostrar divisor */
        if ($conexion->more_results()) {
            printf("-----------------\n");
        }
    } while ($conexion->next_result());
}


 ?>
</pre>
