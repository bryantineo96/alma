var tabla;

//funcion que se ejecutara al inicio
function init()
{
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e)
    {
      guardaryeditar(e);
    })
}

//funcion para limpiar cajas de texto
function limpiar()
{

  $("#nombre").val("");
  $("#ruc").val("");
  $("#direccion").val("");
  $("#idproveedor").val("");

}

//funcion mostrar formulario
function mostrarform(flag)
{
  limpiar();
  if (flag) {
    $("#listadoregistros").hide();
    $("#formularioregistros").show();
    $("#btnGuardar").prop("disable", false)
    $("#btnagregar").hide();
  }
  else {
    $("#listadoregistros").show();
    $("#formularioregistros").hide();
    $("#btnagregar").show();
  }
}

// funcion cancelar un formulario
function cancelarform()
{
  limpiar();
  mostrarform(false);
}

//funcion litar
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
					url: '../ajax/proveedor.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "asc" ]],//Ordenar (columna,orden)
      deferRender:    true,
            scrollY:        500,
            scrollCollapse: true,
            scroller:       true
	}).DataTable();
}
//funcion para guardaryeditar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",false);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/proveedor.php?op=guardaryeditar",
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

//funcion para mostrar registros en las cjas de texto del formulario
function mostrar(idproveedor)
{
	$.post("../ajax/proveedor.php?op=mostrar",{idproveedor : idproveedor}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);


    $("#nombre").val(data.nombre);
    $("#ruc").val(data.ruc);
    $("#direccion").val(data.direccion);
    $("#idproveedor").val(data.idproveedor);


 	})
}

//funcion para desactivar una categoria

//Función para desactivar registros
function eliminar(idproveedor)
{
	bootbox.confirm("¿Está Seguro de eliminar el Proveedor?", function(result){
		if(result)
        {
        	$.post("../ajax/proveedor.php?op=eliminar", {idproveedor : idproveedor}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}





init();
