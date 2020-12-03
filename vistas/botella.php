<?php

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
                          <h1 class="box-title">Botellas <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover compact row-border">
                          <thead>
                            <th>Opciones</th>
                            <th>Codigo</th>
                            <th>Propietario</th>
                            <th>Descripcion</th>
                            <th>Unidad</th>
                            <th>Medida</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Codigo</th>
                            <th>Propietario</th>
                            <th>Descripcion</th>
                            <th>Unidad</th>
                            <th>Medida</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body"  id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Codigo Botella:</label>
                            <input type="hidden" name="idbotella" id="idbotella">
                            <input type="text" class="form-control" name="cod_botella" id="cod_botella" maxlength="100" placeholder="Nombre" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Propietario(*):</label>
                            <select id="idproveedor" name="idproveedor" class="form-control selectpicker" data-live-search="true" required title="Selecciona Propietario"></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripcion</label>

                            <select name="descripcion" id="descripcion" class="form-control selectpicker" required="" title="Selecciona Contenido">
                               <option value="OXIGENO">OXIGENO</option>
                               <option value="NITROGENO">NITROGENO</option>
                                <option value="ARGON">ARGON</option>
                                <option value="ACETILENO">ACETILENO</option>
                                <option value="AGASOL (GAS PROPANO)">AGASOL (GAS PROPANO)</option>
                                  <option value="AMONIACO">AMONIACO</option>
                                    <option value="OXIGENO MEDICINAL">OXIGENO MEDICINAL</option>
                            </select>

                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Unidad:</label>
                            <select id="unidad" name="unidad" class="form-control selectpicker" data-live-search="true" required title="Selecciona Unidad">
                              <option value="M3">M3</option>
                              <option value="KG">KG</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Medida:</label>
                            <input type="text" class="form-control" name="medida" id="medida" maxlength="256" placeholder="Descripción">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
  <div class="modal fade" id="tabla_detalle_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Historial de movimiento de botella</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body table-responsive" id="listadoarticuloscompramodal">
          <div class="container-fluid">
          <table id="tbl_detalle_movimientos"  class="table table-striped table-bordered table-condensed table-hover compact row-border">
            <thead>
                <th>Codigo Botella</th>
                <th>Tipo Movimiento</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Doc Externo</th>
                <th>Doc Interno</th>
                <th>Observacion</th>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <th>Codigo Botella</th>
              <th>Tipo Movimiento</th>
              <th>Fecha</th>
              <th>Proveedor</th>
              <th>Doc Externo</th>
              <th>Doc Interno</th>
              <th>Observacion</th>
            </tfoot>
          </table>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  else {
    require 'noacceso.php';
  }
  require 'footer.php';
  ?>
<!--jquery print area -->
<script src="../public/js/jquery.PrintArea.js"></script>
<!--barcode -->
    <script src="../public/js/JsBarcode.all.min.js"></script>
    <!--qr CODE -->
    <script src="../public/js/qrcode.js"></script>
      <script src="../public/js/jquery.qrcode.min.js"></script>
<script type="text/javascript" src="scripts/botella.js"></script>
<?php

}
ob_end_flush();
?>
