<?php #include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fpeli_categ">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="film_id">Peliculas:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="film_id" name="film_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listapeliculas2 as $fila){ ?>
								<option value="<?php echo trim($fila['film_id']); ?>" >
								<?php echo utf8_encode(trim($fila['peliculas'])); ?> </option>

								<?php } ?>
							</select>	
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category_id">Categorias:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="category_id" name="category_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listapeliculas2 as $fila){ ?>
								<option value="<?php echo trim($fila['category_id']); ?>" >
								<?php echo utf8_encode(trim($fila['categorias'])); ?> </option>

								<?php } ?>
							</select>	
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
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar categoria de peliculas">Actualizar categoria de peliculas</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>
