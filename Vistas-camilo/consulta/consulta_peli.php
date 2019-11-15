<?php #include_once ("../../Funciones/sessiones.php"); ?>
      
      <h1>
        consulta de
        <small>  consulta</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">consulta</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de Columnas</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-info btn-sm" id="nuevo"  data-toggle="tooltip" 
                      title="Nueva consulta"><i class="fa fa-plus" aria-hidden="true"></i></button> 
              </div>
              <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </div>
           
        
            <!-- /.box-header -->
            <div class="box-body">
            <div id="editar"></div>
            <div id="listado">
              <table id="tabla" class="table table-striped table-bordered table-hover"  cellspacing="0" width="30%">
                <thead>
                <tr>
                 <th>codigo</th>
                 <th>pelicula</th>
			           <th>categoria</th>
                 <th>tienda</th>    
                 <th>accion</th>      
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                <th>codigo</th>
                <th>pelicula</th>
			          <th>categoria</th>
                <th>tienda</th>
                <th>accion</th>
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

<script src="./Recursos/js/funcionesconsulta.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(consulta);
</script>