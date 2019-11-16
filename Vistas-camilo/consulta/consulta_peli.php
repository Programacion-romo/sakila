<?php #include_once ("../../Funciones/sessiones.php"); ?>
      
      <h1>
        consulta de
        <small>  peliculas</small>
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
                 <th>direccion</th>
                 <th>ciudad</th>   
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
                <th>direccion</th>
                 <th>ciudad</th> 
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