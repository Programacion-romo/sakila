<!-- quick email widget -->
<div id="seccion-ciudades">
	<div class="box-header">
    	<i class="fa fa-building" aria-hidden="true">Gestión de ciudades</i>
        <!-- tools box -->
        <div class="pull-right box-tools">
        	<button class="btn btn-info btn-sm btncerrar2" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
        </div><!-- /. tools -->
    </div>
    <div class="box-body">

		<div align ="center">
				<div id="actual"> 
				</div>
		</div>


        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">
    
                <form class="form-horizontal" role="form"  id="fciudades">


 					<div class="form-group">
                        <label class="control-label col-sm-2" for="city_id">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="city_id" name="city_id" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="city">Ciudad:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="city" name="city" placeholder="Ingrese Nombre de la ciudad"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="country_id">Pais:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="country_id" name="country_id">
                         
							</select>	
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="last_update">actualizacion:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="last_update" name="last_update" placeholder="Ingrese actualizacion"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">                        					
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar ciudades">Grabar ciudades</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar2" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
</div>