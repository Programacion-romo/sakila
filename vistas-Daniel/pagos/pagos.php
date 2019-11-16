<?php #include_once ("../../Funciones/sessiones.php"); ?>
      
      <h1>
        Gestión de
        <small>  pagos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pagos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de pagos</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-info btn-sm" id="nuevo"  data-toggle="tooltip" 
                      title="Nuevo pago"><i class="fa fa-plus" aria-hidden="true"></i></button> 
              </div>
            </div>
           
        
            <!-- /.box-header -->
            <div class="box-body">
            <div id="editar"></div>
            <div id="listado">
              <table id="tablaPago" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo de pago</th>
                  <th>Codigo de cliente</th>
                  <th>Codigo de persona</th>
                  <th>Codigo de renta</th>
                  <th>Cantidad</th>
                  <th>Fecha de pago</th>
                  <th>Última actualización</th>
                  <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Codigo de pago</th>
                  <th>Codigo de cliente</th>
                  <th>Codigo de persona</th>
                  <th>Codigo de renta</th>
                  <th>Cantidad</th>
                  <th>Fecha de pago</th>
                  <th>Última actualización</th>
                  <th>&nbsp;</th>
                </tr>
                </tfoot>                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

<script src="./Recursos/js/funcionespagos.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(pagos);
</script>


