var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})
	$("#imagenmuestra").hide();
	//mostramos permisos
	$.post("../ajax/usuario.php?op=permisos&id=",function(r){
					$("#permisos").html(r);
	});

}

//Función limpiar
function limpiar()
{
$("#nombre").val("");
$("#num_documento").val("");
$("#direccion").val("");
$("#telefono").val("");
$("#email").val("");
$("#cargo").val("");
$("#login").val("");
$("#clave").val("");
$("#imagenmuestra").attr("src","");
$("#imagenactual").val("");
$("#idusuario").val("");
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
					url: '../ajax/usuario.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
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

function mostrar(idusuario)
{
	$.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

    $("#nombre").val(data.nombre);
		$("#tipo_documento").val(data.tipo_documento);
		$("#tipo_documento").selectpicker('refresh');
		$("#num_documento").val(data.num_documento);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#email").val(data.email);
		$("#cargo").val(data.cargo);
		$("#login").val(data.login);

		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
		$("#imagenactual").val(data.imagen);
		$("#idusuario").val(data.idusuario);
 	});
	$.post("../ajax/usuario.php?op=permisos&id="+idusuario,function(r){
					$("#permisos").html(r);
	});
}

//Función para desactivar registros
function desactivar(idusuario)
{
	bootbox.confirm("¿Está Seguro de desactivar el usuario?", function(result){
		if(result)
        {
        	$.post("../ajax/usuario.php?op=desactivar", {idusuario : idusuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(idusuario)
{
	bootbox.confirm("¿Está Seguro de activar el usuario?", function(result){
		if(result)
        {
        	$.post("../ajax/usuario.php?op=activar", {idusuario : idusuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

init();
