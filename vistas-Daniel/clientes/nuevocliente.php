<?php #include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fcliente">
 					<div class="form-group">
                        <label class="control-label col-sm-1" for="customer_id">Código:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control " id="customer_id" name="customer_id" placeholder="Ingrese código de cliente"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="store_id">Tienda:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="store_id" name="store_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listaTienda as $fila){ ?>
								<option value="<?php echo trim($fila['store_id']); ?>" >
								<?php echo utf8_encode(trim($fila['store_id'])); ?> </option>
								<?php } ?>
							</select>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="first_name">Nombre:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-city"></i></span>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Ingrese nombre de cliente"
                            value = "">
                        </div>                    
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="last_name">Apellido:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-city"></i></span>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ingrese apellido de cliente"
                            value = "">
                        </div>                    
                    </div>       

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="email">Correo:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-city"></i></span>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese correo de cliente"
                            value = "">
                        </div>                    
                    </div>     

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="address_id">Direccion:</label>
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
                        <label class="control-label col-sm-1" for="active">Activo:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control " id="active" name="active" placeholder="Ingrese id de usuario activo"
                            value = "" data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>  

                    <div class="form-group">
                    <label class="control-label col-sm-1" for="create_date">Creación:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-city"></i></span>
                            <input type="text" class="form-control" id="last_update" name="last_update" placeholder="Ingrese fecha de creación"
                            value = "" readonly="true" data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>        
										
                    <div class="form-group">
                    <label class="control-label col-sm-1" for="last_update">Actualizar:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-city"></i></span>
                            <input type="text" class="form-control" id="last_update" name="last_update" placeholder="Ingrese última actualización"
                            value = "" readonly="true" data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar clientes">Grabar clientes</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
