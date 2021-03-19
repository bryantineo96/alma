var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var h = ("0" + (now.getHours() )).slice(-2);
	var m = ("0" + (now.getMinutes() )).slice(-2);
	//var s = ("0" + (now.getSeconds() )).slice(-2);

	var today = now.getFullYear()+"/"+(month)+"/"+(day)+" "+h+":"+m;

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})

	$('#fecha_hora').datetimepicker({
		timerpicker: false,
		datepicker: true,
		dateFormat: "dd-mm-yy",
	  timeFormat: "HH:mm:ss",
		value: today,
		theme: 'dark',
		weeks: true
	})

		$("#fecha_hora").inputmask("datetime", {
	        inputFormat: "yyyy/mm/dd HH:MM",
					outputFormat: "yyyy/mm/dd HH:MM",
	        //outputFormat: "dd-mm-yy HH:MM:ss",
	        inputEventOnly: true
	    });

	//Cargamos los items al select proveedor
	$.post("../ajax/movimiento.php?op=selectProveedor", function(r){

							$("#idproveedor").html(r);
						 $('#idproveedor').selectpicker('refresh');
	});

}

//Función limpiar
function limpiar()
{
//	$("#idproveedor").val("");

$('#idmovimiento').val("");
$('#doc_ext').val("");
$('#doc_int').val("");
$('#observacion').val("");
	$(".filas").remove();
	$("#total").html("0");

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var h = ("0" + (now.getHours() )).slice(-2);
	var m = ("0" + (now.getMinutes() )).slice(-2);
	//var s = ("0" + (now.getSeconds() )).slice(-2);

	var today = now.getFullYear()+"/"+(month)+"/"+(day)+" "+h+":"+m;
    $('#fecha_hora').val(today);

    //Marcamos el primer tipo_documento
    $("#tipo_mov").val("");
	$("#tipo_mov").selectpicker('refresh');
	//Marcamos el primer tipo_documento
	$("#idproveedor").val("");
$("#idproveedor").selectpicker('refresh');

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarArt").show();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}

}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [

				{
						extend: 'colvis',
						text: 'Columnas Visibles',
						titleAttr: 'Columnas Visibles',
						className: '',
            messageTop: 'All Logs',
						exportOptions: {
								columns: ':visible'
						}

				},
				{
						extend: 'pageLength',
						text: 'Filas',
						titleAttr: 'paginas',
						className: '',
            messageTop: 'All Logs',
						exportOptions: {
								columns: ':visible'
						}

				},
				{
						extend: 'copy',
						text: '<i class="fa fa-copy"></i>',
						titleAttr: 'Copiar en portapapeles',
						className: '',
            messageTop: 'All Logs',
						exportOptions: {
								columns: ':visible'
						}
				},
				{
						extend: 'excel',
						text: '<i class="fa fa-file-excel-o"></i>',
						titleAttr: 'Exportar a Excel',
						className: '',
            messageTop: 'All Logs',
						exportOptions: {
								columns: ':visible'
						}
				},
				{
						extend: 'pdf',
						text: '<i class="fa fa-file-pdf-o"></i>',
						titleAttr: 'Exportar a PDF',
						className: '',
            messageTop: 'All Logs',
						exportOptions: {
								columns: ':visible'
						}
				},
				{
						extend: 'csv',
						text: '<i class="fa fa-file"></i>',
						titleAttr: 'Exportar a CSV',
						className: '',
            messageTop: 'All Logs',
						exportOptions: {
								columns: ':visible'
						}
				},
				{
						extend: 'print',
						text: '<i class="fa fa-print"></i>',
						titleAttr: 'Imprimir',
						className: 'custom-dt-print',
            messageTop: 'All Logs',
						key: {
                key: 'c',
                altKey: true
            },
						exportOptions: {
							  columns: ':visible'
						}

				},

		        ],
		"ajax":
				{
					url: '../ajax/movimiento.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 2, "desc" ]],
			deferRender:    true,
			scrollY:        500,
			scrollCollapse: true,
			scroller:       true//Ordenar (columna,orden)

	}).DataTable();
}


//Función ListarArticulos
function listarArticulos()
{
	tabla=$('#tblarticulos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [

		        ],
		"ajax":
				{
					url: '../ajax/movimiento.php?op=listarBotellas',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]],
			deferRender:    true,
			scrollY:        500,
			scrollCollapse: true,
			scroller:       true//Ordenar (columna,orden)
	}).DataTable();

	$('#myModal').on('shown.bs.modal', function () {
       var table = $('#tblarticulos').DataTable();
       table.columns.adjust();
   });
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/movimiento.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
	          bootbox.alert(datos);
	          mostrarform(false);
	          listar();
	    }

	});
	limpiar();
}

function mostrar(idmovimiento)
{
	$.post("../ajax/movimiento.php?op=mostrar",{idmovimiento : idmovimiento}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#idproveedor").val(data.idproveedor);
		$('#idproveedor').selectpicker('refresh');
		$("#tipo_mov").val(data.tipo_mov);
		$('#tipo_mov').selectpicker('refresh');
		$("#doc_int").val(data.doc_int);
		$("#doc_ext").val(data.doc_ext);
		$("#fecha_hora").val(data.fecha);
		$("#observacion").val(data.observacion);

		$("#idmovimiento").val(data.idmovimiento);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
 	});

 	$.post("../ajax/movimiento.php?op=listarDetalle&id="+idmovimiento,function(r){
	        $("#detalles").html(r);
	});
}

//Función para anular registros
function anular(idmovimiento)
{
	bootbox.confirm("¿Está Seguro de anular el ingreso?", function(result){
		if(result)
        {
        	$.post("../ajax/movimiento.php?op=anular", {idmovimiento : idmovimiento}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto=18;
var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto()
  {
  	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
  	if (tipo_comprobante=='Factura')
    {
        $("#impuesto").val(impuesto);
    }
    else
    {
        $("#impuesto").val("0");
    }
  }

function agregarDetalle(idbotella,cod_botella,descripcion)
  {
  	var cantidad=1;
    var precio_compra=1;
    var precio_venta=1;

    if (idbotella!="")
    {
    	var subtotal=cantidad*precio_compra;
    	var fila='<tr class="filas" id="fila'+cont+'">'+
    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    	'<td><input type="hidden" name="idbotella[]" value="'+idbotella+'">'+cod_botella+'</td>'+
			'<td><input type="hidden" name="descripcion[]" value="'+descripcion+'">'+descripcion+'</td>'+
    	'<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
    	'<td><button type="button" onclick="modificarSubototales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
    	'</tr>';
    	cont++;
    	detalles=detalles+1;
    	$('#detalles').append(fila);
    	modificarSubototales();
    }
    else
    {
    	alert("Error al ingresar el detalle, revisar los datos del artículo");
    }
  }

  function modificarSubototales()
  {
  	var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_compra[]");
    var sub = document.getElementsByName("subtotal");

    for (var i = 0; i <cant.length; i++) {
    	var inpC=cant[i];
    	var inpP=prec[i];
    	var inpS=sub[i];

    	inpS.value=inpC.value * inpP.value;
    	document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
    }
    calcularTotales();

  }
  function calcularTotales(){
  	var sub = document.getElementsByName("subtotal");
  	var total = 0.0;

  	for (var i = 0; i <sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}
	$("#total").html("S/. " + total);
    $("#total_compra").val(total);
    evaluar();
  }

  function evaluar(){
  	if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide();
      cont=0;
    }
  }

  function eliminarDetalle(indice){
  	$("#fila" + indice).remove();
  	calcularTotales();
  	detalles=detalles-1;
  	evaluar();
  }

init();
