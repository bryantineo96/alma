<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';
if ($_SESSION['almacen']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Movimientos de Botellas <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover compact row-border">
                          <thead>
                            <th>Opciones</th>
                            <th>Num Movimiento</th>
                            <th>Fecha</th>
                            <th>Tipo Movimiento</th>
                            <th>Proveedor</th>
                            <th>Doc Externo</th>
                            <th>Doc Interno</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Num Movimiento</th>
                            <th>Fecha</th>
                            <th>Tipo Movimiento</th>
                            <th>Proveedor</th>
                            <th>Doc Externo</th>
                            <th>Doc Interno</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body"  id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <label>Numero de movimiento:</label>
                            <input type="text" class="form-control" name="idmovimiento" id="idmovimiento" disabled >
                          </div>

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Proveedor(*):</label>
                            <select id="idproveedor" name="idproveedor" class="form-control selectpicker" data-live-search="true" required
                            title="Selecciona proveedor">
                            </select>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="text" class="form-control" name="fecha_hora" id="fecha_hora"  required="">
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Tipo Movimiento(*):</label>
                            <select name="tipo_mov" id="tipo_mov" class="form-control selectpicker" required="" title="Selecciona Movimiento">
                               <option value="INGRESO COMPRA">INGRESO COMPRA</option>
                               <option value="INGRESO TRANSFERENCIA">INGRESO TRANSFERENCIA</option>
                               <option value="INGRESO DEVOLUCION DE PRESTAMO">INGRESO DEVOLUCION DE PRESTAMO</option>
                               <option value="SALIDA DEVOLUCION A PROVEEDOR">SALIDA DEVOLUCION A PROVEEDOR</option>
                               <option value="SALIDA TRANSFERENCIA">SALIDA TRANSFERENCIA</option>
                               <option value="SALIDA PRESTAMO">SALIDA PRESTAMO</option>

                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Documento externo:</label>
                            <input type="text" class="form-control" name="doc_ext" id="doc_ext" maxlength="12" placeholder="Nro Documento">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Documento interno:</label>
                            <input type="text" class="form-control" name="doc_int" id="doc_int" maxlength="12" placeholder="Nro Documento" >
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="">Observacion</label>
                            <textarea class="form-control" id="observacion" name="observacion" rows="3"></textarea>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a data-toggle="modal" href="#myModal">
                              <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Botella</button>
                            </a>
                          </div>

                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="panel-body table-responsive" id="detalleventa">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover compact row-border">
                              <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Botella</th>
                                    <th>Contenido</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/. 0.00</h4><input type="hidden" name="total_compra" id="total_compra"></th>
                                </tfoot>

                                <tbody>

                                </tbody>
                            </table>
                          </div>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione una Botella   <button class="btn btn-info" onclick="listarArticulos()"><i class="fa fa-refresh"></i></button></h4>
        </div>
        <div class="modal-body">
          <div class="panel-body table-responsive" id="listadoarticuloscompramodal">

          <table id="tblarticulos"  style="width:100%" class="table table-striped table-bordered table-condensed table-hover compact row-border">
            <thead>
                <th>Opciones</th>
                <th>Botella</th>
                <th>Contenido</th>
                <th>Propietario</th>
                <th>Estado</th>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Botella</th>
              <th>Contenido</th>
              <th>Propietario</th>
              <th>Estado</th>
            </tfoot>
          </table>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin modal -->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/movimiento.js"></script>
<?php
}
ob_end_flush();
?>
