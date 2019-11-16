<?php #include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fpaises">
 					<div class="form-group">
                        <label class="control-label col-sm-2" for="country_id">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="country_id" name="country_id" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="country">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="country" name="country" placeholder="Ingrese Nombre del Pais"
                            value = "">
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="last_update">Actualizar:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="last_update" name="last_update" placeholder="Ingrese actualizacion"
                            value = ""readonly="true" >
                        </div>
                    </div>


					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Pais">Actualizar Pais</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>
