<?php #include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="ftiendas">
 					<div class="form-group">
                        <label class="control-label col-sm-2" for="store_id">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="store_id" name="store_id" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="staff_id">Empleado:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="staff_id" name="staff_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listaStaff as $fila){ ?>
								<option value="<?php echo trim($fila['staff_id']); ?>" >
								<?php echo utf8_encode(trim($fila['Empleado'])); ?> </option>
                                
								<?php } ?>
							</select>	
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="address_id">Direccion:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="address_id" name="address_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listaDireccion as $fila){ ?>
								<option value="<?php echo trim($fila['address_id']); ?>" >
								<?php echo utf8_encode(trim($fila['address'])); ?> </option>

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
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Tienda">Grabar Tienda</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>