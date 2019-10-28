<?php #include_once ("../../Funciones/sessiones.php"); ?>
      
      <h1>
        Gestión de
        <small>  peliculas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">peliculas</li>
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
                      title="Nueva peliculas"><i class="fa fa-plus" aria-hidden="true"></i></button> 
              </div>
            </div>
           
        
            <!-- /.box-header -->
            <div class="box-body">
            <div id="editar"></div>
            <div id="listado">
              <table id="tabla" class="table table-striped table-bordered table-hover"  cellspacing="0" width="30%">
                <thead>
                <tr>
                 <th>Codigo</th>
			        	 <th>Nombre</th>
                 <th>Descripcion</th>
                 <th>Año_Estreno</th>
                 <th>Codigo_idioma</th>
                 <th>Ori_codigo_idio</th>
                 <th>Duracion_alquiler</th> 
                 <th>Tasa_alquiler</th>
                 <th>Longitud</th>
                 <th>Costos_remp</th>
                 <th>Clasificacion</th>
                 <th>Caract_especiales</th>
                 <th>Actualizacion</th>
                 <th>Acciones</th>
                 
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                <th>Codigo</th>
			        	 <th>Nombre</th>
                 <th>Descripcion</th>
                 <th>Año_Estreno</th>
                 <th>Codigo_idioma</th>
                 <th>Ori_codigo_idio</th>
                 <th>Duracion_alquiler</th> 
                 <th>Tasa_alquiler</th>
                 <th>Longitud</th>
                 <th>Costos_remp</th>
                 <th>Clasificacion</th>
                 <th>Caract_especiales</th>
                 <th>Actualizacion</th>
                 <th>Acciones</th>
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

<script src="./Recursos/js/funcionespeliculas.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(peliculas);
</script>


