<?php #include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fidiomas">
 					<div class="form-group">
                     <label class="control-label col-sm-2" for="language_id">Codigo:</label>
                        <div class="col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control" id="language_id" name="language_id" placeholder="Ingrese Idioma"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Nombre:</label>
                        <div class="col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese Nombre del idioma"
                            value = "">
                        </div>                    
                    </div>
					
					 <div class="form-group">        
                     <label class="control-label col-sm-2" for="last_update">Actulizacion:</label>
                        <div class="col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="last_update" name="last_update" placeholder="fecha de actulizacion"
                            value = "" readonly="true">
                        </div>                    
                    </div>

                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Comuna">Grabar idioma</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
