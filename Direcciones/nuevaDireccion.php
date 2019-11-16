<?php #include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
            <form class="form-horizontal" role="form"  id="fdirecciones">
 					<div class="form-group">
                        <label class="control-label col-sm-2" for="address_id">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address_id" name="address_id" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="address">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Ingrese la Direccion"
                            value = "">
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="address2">Nombre 2:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="Ingrese la Direccion 2"
                            value = "">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="district">Distrito:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="district" name="district" placeholder="Ingrese Nombre del Distrito"
                            value = "">
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="city_id">Ciudad:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="city_id" name="city_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listaCiudad as $fila){ ?>
								<option value="<?php echo trim($fila['city_id']); ?>" >
								<?php echo utf8_encode(trim($fila['city'])); ?> </option>

								<?php } ?>
							</select>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="postal_code">Codigo Postal:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Ingrese el Codigo Postal"
                            value = "">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="phone">Telefono:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingrese el Numero de Telefono"
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
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Direccion">Grabar Direccion</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>