<?php
require_once "../modelos/Dashboard.php";

$dashboard=new Dashboard();



switch ($_GET["op"]){

	// case 'comprasHoy':
	// 	$rspta=$escritorio->totalcomprahoy();
  //   $regc=$rspta->fetch_object();
  //   $totalc=$regc->total_compra;
  //   echo $totalc;
	// break;
  //
  // case 'ventasHoy':
	// 	$rspta=$escritorio->totalventahoy();
  //   $regc=$rspta->fetch_object();
  //   $totalc=$regc->total_venta;
  //   echo $totalc;
	// break;

  case 'total_botellas':
		$rspta=$dashboard->total_botellas();
    $regc=$rspta->fetch_object();
    $total=$regc->total_botellas;
    echo $total;
	break;

  case 'pendientes_devolucion':
    $rspta=$dashboard->pendientes_devolucion();
    $regc=$rspta->fetch_object();
    $total=$regc->total_botellas;
    echo $total;
  break;


}
?>
