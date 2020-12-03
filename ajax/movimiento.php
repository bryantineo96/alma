<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Movimiento.php";

$movimiento=new Movimiento();

$idmovimiento=isset($_POST["idmovimiento"])? limpiarCadena($_POST["idmovimiento"]):"";
$idproveedor=isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]):"";
$tipo_mov=isset($_POST["tipo_mov"])? limpiarCadena($_POST["tipo_mov"]):"";
$idusuario=$_SESSION["idusuario"];
$doc_ext=isset($_POST["doc_ext"])? limpiarCadena($_POST["doc_ext"]):"";
$doc_int=isset($_POST["doc_int"])? limpiarCadena($_POST["doc_int"]):"";
$fecha_mov=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$observacion=isset($_POST["observacion"])? limpiarCadena($_POST["observacion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idmovimiento)){
			$rspta=$movimiento->insertar($fecha_mov,$tipo_mov,$idproveedor,$doc_ext,$doc_int,$observacion,$_POST["idbotella"]);
			echo $rspta ? "Movimiento registrado" : "No se pudieron registrar todos los datos del Movimiento";
		}
		else {
		}
	break;

	case 'anular':
		$rspta=$movimiento->anular($idmovimiento);
 		echo $rspta ? "Movimiento anulado" : "Movimiento no se puede anular";
	break;

	case 'mostrar':
		$rspta=$movimiento->mostrar($idmovimiento);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $movimiento->listarDetalle($id);
		$total=0;
		echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Botella</th>
                                    <th>Contiene</th>
                                    <th>Subtotal</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td></td><td>'.$reg->cod_botella.'</td><td>'.$reg->descripcion.'</td></tr>';
					$total=$total+($reg->precio_compra*$reg->cantidad);
				}
		echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/.'.$total.'</h4><input type="hidden" name="total_compra" id="total_compra"></th>
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$movimiento->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado=='Aceptado')?'<button class="btn-sm btn-warning" onclick="mostrar('.$reg->idmovimiento.')"><i class="fa fa-eye"></i></button>'.
 					' <button class="btn-sm btn-danger" onclick="anular('.$reg->idmovimiento.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn-sm btn-warning" onclick="mostrar('.$reg->idmovimiento.')"><i class="fa fa-eye"></i></button>',
          "1"=>$reg->idmovimiento,
 				"2"=>$reg->fecha,
 				"3"=>$reg->tipo_mov,
 				"4"=>$reg->proveedor,
 				"5"=>$reg->doc_ext,
 				"6"=>$reg->doc_int,
 				"7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>'
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

	case 'listarBotellas':
		require_once "../modelos/Botella.php";
		$botella=new Botella();

		$rspta=$botella->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idbotella.',\''.$reg->cod_botella.'\',\''.$reg->descripcion.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->cod_botella,
 				"2"=>$reg->descripcion,
        "3"=>$reg->propietario,
        "4"=>$reg->estado
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
