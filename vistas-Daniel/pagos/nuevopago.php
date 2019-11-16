<?php #include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fpagos">
 					<div class="form-group">
                        <label class="control-label col-sm-1" for="payment_id">Código de pago:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control " id="payment_id" name="payment_id" placeholder="Ingrese código de pago"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="customer_id">Cliente:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <select class="form-control" id="customer_id" name="customer_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listaclientes as $fila){ ?>
								<option value="<?php echo trim($fila['customer_id']); ?>" >
								<?php echo utf8_encode(trim($fila['first_name'])); ?> </option>

								<?php } ?>
							</select>	
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="staff_id">Empleado que atendio:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <select class="form-control" id="staff_id" name="staff_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listastaffDaniel as $fila){ ?>
								<option value="<?php echo trim($fila['staff_id']); ?>" >
								<?php echo utf8_encode(trim($fila['first_name'])); ?> </option>

								<?php } ?>
							</select>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="rental_id">Tienda:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="rental_id" name="rental_id">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listarental as $fila){ ?>
								<option value="<?php echo trim($fila['rental_id']); ?>" >
								<?php echo utf8_encode(trim($fila['rental_id'])); ?> </option>
								<?php } ?>
							</select>	
                        </div>
                    </div>


                    
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="amount">Cantidad:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Ingrese cantidad"
                            value = "">
                        </div>                    
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="payment_date">Fecha de pago:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="payment_date" name="payment_date" placeholder="Ingrese fecha de pago"
                            value = "">
                        </div>                    
                    </div>
										
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="last_update">Última actualización:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <input type="text" class="form-control" id="last_update" name="last_update" placeholder="Ingrese última actualización"	
                            value = "">
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar pago">Grabar pago</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
