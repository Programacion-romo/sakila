function pagos(){

      var dt = $("#tablaPago").DataTable({
          	"ajax": "./Controlador/controladorpagos.php?accion=listar",
          	"columns": [
                { "data": "payment_id"},
                { "data": "customer_id"},
                { "data": "staff_id"},
                { "data": "rental_id"},
                { "data": "amount"},
                { "data": "payment_date"},
  	            { "data": "last_update"},
                { "data": "payment_id",
                    render: function (data) {
                              return '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                              +      '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
                    }
                }
          	]
      });

    $("#editar").on("click",".btncerrar", function(){
        $(".box-title").html("Listado de pagos");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear pago");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/pagos/nuevopago.php', function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorcliente.php",
                data: {accion:'listar'},
                dataType:"json"
             }).done(function( resultado ) {   
                //console.log(resultado.data)           
                $("#customer_id option").remove()       
                $("#customer_id").append("<option selecte value=''>Seleccione un cliente</option>")
                $.each(resultado.data, function (index, value) { 
                  $("#customer_id").append("<option value='" + value.customer_id + "'>" + value.first_name + "</option>")
                
                });
    
          });
            $.ajax({
                type:"get",
                url:"./Controlador/controladorAlquiler.php",
                data: {accion:'listar'},
                dataType:"json"
             }).done(function( resultado ) {   
                //console.log(resultado.data)           
                $("#rental_id option").remove()       
                $("#rental_id").append("<option selecte value=''>Seleccione una renta</option>")
                $.each(resultado.data, function (index, value) { 
                  $("#rental_id").append("<option value='" + value.rental_id + "'>" + value.rental_id + "</option>")
                
                });
    
          });

             $.ajax({
                type:"get",
                url:"./Controlador/controladorStaff.php",
                data: {accion:'listar'},
                dataType:"json"
             }).done(function( resultado ) {   
                //console.log(resultado.data)           
                $("#staff_id option").remove()       
                $("#staff_id").append("<option selecte value=''>Seleccione un empleado</option>")
                $.each(resultado.data, function (index, value) { 
                  $("#staff_id").append("<option value='" + value.staff_id + "'>" + value.first_name + "</option>")
                
                });
    
          });
            
    
    })

    $("#editar").on("click","button#grabar",function(){
      var datos=$("#fpagos").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorpagos.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'El pago fue grabado con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de pagos");
                    $(".box #nuevo").show();
                    $("#editar").html('');
                    $("#editar").addClass('hide');
                    $("#editar").removeClass('show');
                    $("#listado").addClass('show');
                    $("#listado").removeClass('hide');
                    dt.page( 'last' ).draw( 'page' );
                    dt.ajax.reload(null, false);                   
             } else {
                swal({
                    position: 'center',
                    type: 'error',
                    title: 'Ocurrió un error al grabar',
                    showConfirmButton: false,
                    timer: 1500
                });
               
            }
        });
    });

    $("#editar").on("click","button#actualizar",function(){
         var datos=$("#fpagos").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorpagos.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
   
              if(resultado.respuesta){    
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'Se actaulizaron los datos correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }) 
                $(".box-title").html("Listado de pagos");
                $("#editar").html('');
                $("#editar").addClass('hide');
                $("#editar").removeClass('show');
                $("#listado").addClass('show');
                $("#listado").removeClass('hide');
                dt.ajax.reload(null, false);       
             } else {
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!'                         
                })
            }
        });
    })

    $(".box-body").on("click","a.borrar",function(){
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");
        
        swal({
              title: '¿Está seguro?',
              text: "¿Realmente desea borrar el pago con código : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladorpagos.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'El pago con código ' + codigo + ' fue borrado',
                              showConfirmButton: false,
                              timer: 1500
                            })       
                            var info = dt.page.info();   
                            if((info.end-1) == info.length)
                                dt.page( info.page-1 ).draw( 'page' );
                            dt.ajax.reload(null, false);
                            
                        } else {
                            swal({
                              type: 'error',
                              title: 'Oops...',
                              text: 'Something went wrong!'                         
                            })
                        }
                    });
                     
                    request.fail(function( jqXHR, textStatus ) {
                        swal({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!' + textStatus                          
                        })
                    });
                }
        })

    });
    
    $(".box-body").on("click","a.editar",function(){
       //$("#titulo").html("Editar pagos");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var cliente;
       var Staff;
       var Alquiler;
       $(".box-title").html("Actualizar pago")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/pagos/editarpagos.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorpagos.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( pagos ) {        
                    if(pagos.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'pago no existe!'                         
                        })
                    } else {
                        $("#payment_id").val(pagos.codigo);
                        cliente = pagos.customer_id;
                        Staff = pagos.staff_id;
                        Alquiler = pagos.rental_id;
                        $("#amount").val(pagos.amount);                 
                        $("#payment_date").val(pagos.payment_date);
                        $("#last_update").val(pagos.last_update);
                    }
            });
 
            $.ajax({
                type:"get",
                url:"./Controlador/controladorcliente.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(cliente === value.customer_id){
                    $("#editar #customer_id").append("<option selected value='" + value.customer_id + "'>" + value.first_name + "" + value.last_name + "</option>")
                }else {
                    $("#editar #customer_id").append("<option value='" + value.customer_id + "'>" + value.first_name + "" + value.last_name + "</option>")
                }
                });
            })
            
            $.ajax({
                type:"get",
                url:"./Controlador/controladorStaff.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(Staff === value.staff_id){
                    $("#editar #staff_id").append("<option selected value='" + value.staff_id + "'>" + value.first_name + "" + value.last_name + "</option>")
                }else {
                    $("#editar #staff_id").append("<option value='" + value.staff_id + "'>" + value.first_name + "" + value.last_name + "</option>")
                }
                });
            })
            
            $.ajax({
                type:"get",
                url:"./Controlador/controladorAlquiler.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(Alquiler === value.rental_id){
                    $("#editar #rental_id").append("<option selected value='" + value.rental_id + "'>" + value.rental_id + "</option>")
                }else {
                    $("#editar #rental_id").append("<option value='" + value.rental_id + "'>" + value.rental_id + "</option>")
                }
                });
            });
        });
    });
    })
}
