<?php #include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fpeliculas">
 					<div class="form-group">
                     <label class="control-label col-sm-2" for="film_id">Codigo:</label>
                        <div class="col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control" id="film_id" name="film_id" placeholder="Ingrese codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-sm-2" for="title">Nombre:</label>
                        <div class="col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Ingrese pelicula"
                            value = "">
                        </div>                    
                    </div>
					
					 <div class="form-group">        
                     <label class="control-label col-sm-2" for="description">Descripcion:</label>
                        <div class="col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="description" name="description" placeholder="ingrese description"
                            value = "">
                        </div>                    
                    </div>

                    <div class="form-group">
                    <label class="control-label col-sm-2" for="release_year">Año_Estreno:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="release_year" name="release_year" placeholder="ingrese año de estreno"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="language_id">idioma:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <select class="form-control" id="language_id" name="language_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listapeliculas as $fila){ ?>
								<option value="<?php echo trim($fila['language_id']); ?>" >
								<?php echo utf8_encode(trim($fila['name'])); ?> </option>

								<?php } ?>
							</select>	
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-sm-2" for="original_language_id">Ori_codigo_idio:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="original_language_id" name="original_language_id" placeholder="ingrese año de estreno"
                            value = "" readonly="true" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="rental_duration">Duracion_alquiler:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="rental_duration" name="rental_duration" placeholder="Ingrese Duracion_alquiler"
                            value = "" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="rental_rate">Tasa_alquiler:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="rental_rate" name="rental_rate" placeholder="Ingrese Tasa_alquiler"
                            value = ""  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="length">Longitud:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="length" name="length" placeholder="Ingrese Longitud"
                            value = "" data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="replacement_cost">Costos_remp:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="replacement_cost" name="replacement_cost" placeholder="Ingrese Costos_remp"
                            value = ""  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="rating">Clasificacion:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="rating" name="rating" placeholder="Ingrese Clasificacion"
                            value = "" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="special_features">Caract_especiales:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="special_features" name="special_features" placeholder="Ingrese Caract_especiales"
                            value = "" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="last_update">Actualizacion:</label>
                        <div class="col-sm-10">
                        <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="last_update" name="last_update" placeholder="Ingrese Actualizacion"
                            value = "" readonly="true" >
                        </div>
                    </div>

                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar pelicula">Grabar Pelicula</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
