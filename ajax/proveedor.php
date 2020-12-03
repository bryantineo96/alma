<?php
require_once '../modelos/Proveedor.php';

$proveedor = new Proveedor();

//condicional de una sola linea para validar si existen los parametros enviados por POST
$idproveedor=isset($_POST["idproveedor"])?limpiarCadena($_POST["idproveedor"]):"";
$nombre=isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
$ruc=isset($_POST["ruc"])?limpiarCadena($_POST["ruc"]):"";
$direccion=isset($_POST["direccion"])?limpiarCadena($_POST["direccion"]):"";

switch ($_GET["op"]) {
  case 'guardaryeditar':
    if (empty($idproveedor)) {
      $rspta=$proveedor->insertar($nombre,$ruc,$direccion);
      echo $rspta?"Proveedor registrado":"Proveedor no se pudo registrar";
    }
    else {
      $rspta=$proveedor->editar($idproveedor,$nombre,$ruc,$direccion);
      echo $rspta?"Proveedor actualizado":"Proveedor no se pudo actualiar";
    }
    break;
  case 'eliminar':
      $rspta=$proveedor->eliminar($idproveedor);
      echo $rspta?"Proveedor eliminado":"Proveedor no se pudo eliminar";
    break;
  case 'mostrar':
      $rspta=$proveedor->mostrar($idproveedor);
      //codificar el resultado usando JSON
      echo json_encode($rspta);
      break;


  case 'listar':
     $rspta=$proveedor->listar();
     //declramos un array para los datos a listar
     $data = Array();
     while ($reg=$rspta->fetch_object()) {
       $data[]=array(
     "0"=>'<button class="btn-sm btn-warning" onclick="mostrar('.$reg->idproveedor.')"><i class="fa fa-pencil"></i></button>'.
       ' <button class="btn-sm btn-danger" onclick="eliminar('.$reg->idproveedor.')"><i class="fa fa-trash"></i></button>',
     "1"=>$reg->nombre,
     "2"=>$reg->ruc,
     "3"=>$reg->direccion,
     "4"=>$reg->estado
     );
     }
     $result=array(
       "sEcho"=>1, //informacion para el datatable
       "iTotalRecords"=>count($data),//enviamos el total de resgistros al data table
       "iTotalDisplayRecords"=>count($data),//enviamos el total deregistros a visualizat
       "aaData"=>$data
     );
     echo json_encode($result);
     break;
    }
    ?>
