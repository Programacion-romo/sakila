<?php #include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fciudades">
 					<div class="form-group">
                        <label class="control-label col-sm-1" for="city_id">Codigo:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control " id="city_id" name="city_id" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="city">Nombre:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Ingrese Nombre de la Ciudad"
                            value = "">
                        </div>                    
                    </div>
					
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="country_id">Pais:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="country_id" name="country_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listaPais as $fila){ ?>
								<option value="<?php echo trim($fila['country_id']); ?>" >
								<?php echo utf8_encode(trim($fila['country'])); ?> </option>

								<?php } ?>
							</select>	
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
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Ciudad">Grabar Ciudad</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
