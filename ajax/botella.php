<?php
require_once "../modelos/Botella.php";

$botella=new Botella();

$idbotella=isset($_POST["idbotella"])? limpiarCadena($_POST["idbotella"]):"";
$cod_botella=isset($_POST["cod_botella"])? limpiarCadena($_POST["cod_botella"]):"";
$idproveedor=isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$unidad=isset($_POST["unidad"])? limpiarCadena($_POST["unidad"]):"";
$medida=isset($_POST["medida"])? limpiarCadena($_POST["medida"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idbotella)){
			$rspta=$botella->insertar($cod_botella,$idproveedor,$descripcion,$unidad,$medida);
			echo $rspta ? "Botella registrada" : "Botella no se pudo registrar";
		}
		else {
			$rspta=$botella->editar($idbotella,$cod_botella,$idproveedor,$descripcion,$unidad,$medida);
			echo $rspta ? "Botella actualizada" : "Botella no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$botella->desactivar($idbotella);
 		echo $rspta ? "Botella Desactivada" : "Botella no se puede desactivar";
	break;

	case 'activar':
		$rspta=$botella->activar($idbotella);
 		echo $rspta ? "Botella activada" : "Botella no se puede activar";
	break;

	case 'mostrar':
		$rspta=$botella->mostrar($idbotella);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$botella->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn-sm btn-warning" onclick="mostrar('.$reg->idbotella.')"><i class="fa fa-pencil"></i></button>'.
	        ' <button class="btn-sm btn-danger" onclick="eliminar('.$reg->idbotella.')"><i class="fa fa-trash"></i></button>'.
					' <a data-toggle="modal" href="#tabla_detalle_modal"><button class="btn-sm btn-info" onclick="mostrar_detalle('.$reg->idbotella.')"><i class="fa fa-table"></i></button></a>',
        "1"=>$reg->cod_botella,
 				"2"=>$reg->propietario,
 				"3"=>$reg->descripcion,
 				"4"=>$reg->unidad,
 				"5"=>$reg->medida,
 				"6"=>$reg->estado
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectProveedor":
		require_once "../modelos/Proveedor.php";
		$proveedor = new Proveedor();

		$rspta = $proveedor->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idproveedor . '>' . $reg->nombre . '</option>';
				}
	break;

	case 'listarMovimientos':

		$id=$_REQUEST["id"];

		$rspta=$botella->listarMovimientos($id);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>$reg->cod_botella,
				"1"=>$reg->tipo_mov,
				"2"=>$reg->fecha_mov,
				"3"=>$reg->proveedor,
				"4"=>$reg->doc_ext,
				"5"=>$reg->doc_int,
				"6"=>$reg->observacion,

				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);

	break;
}
?>
