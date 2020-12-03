var tabla;
//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})

	//Cargamos los items al select categoria
	$.post("../ajax/botella.php?op=selectProveedor", function(r){
	            $("#idproveedor").html(r);
	            $('#idproveedor').selectpicker('refresh');

	});
}


//Función limpiar
function limpiar()
{
	$("#idbotella").val("");
	$("#cod_botella").val("");
	$("#idproveedor").val("");
  $("#idproveedor").selectpicker('refresh');
	$("#descripcion").val("");
	  $("#descripcion").selectpicker('refresh');
	$("#unidad").val("");
$("#unidad").selectpicker('refresh');
	$("#medida").val("");

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
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
					url: '../ajax/botella.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,

	"order": [[ 0, "desc" ]],//Ordenar (columna,orden),
				deferRender:    true,
        scrollY:        500,
        scrollCollapse: true,
        scroller:       true		
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/botella.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
	          bootbox.alert(datos);
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idbotella)
{
	$.post("../ajax/botella.php?op=mostrar",{idbotella : idbotella}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);


		$("#cod_botella").val(data.cod_botella);
		$("#idproveedor").val(data.idproveedor);
		$('#idproveedor').selectpicker('refresh');
		$("#descripcion").val(data.descripcion);
		$('#descripcion').selectpicker('refresh');
		$("#unidad").val(data.unidad);
			$('#unidad').selectpicker('refresh');
		$("#medida").val(data.medida);
 		$("#idbotella").val(data.idbotella);




 	})
}

//Función para desactivar registros
function desactivar(idarticulo)
{
	bootbox.confirm("¿Está Seguro de desactivar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/articulo.php?op=desactivar", {idarticulo : idarticulo}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(idarticulo)
{
	bootbox.confirm("¿Está Seguro de activar el Artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/articulo.php?op=activar", {idarticulo : idarticulo}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

function mostrar_detalle(id)
{

	tabla=$('#tbl_detalle_movimientos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/botella.php?op=listarMovimientos',
					data:{id: id},
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 2, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


init();
