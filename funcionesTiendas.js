function tiendas(){

    var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorTiendas.php?accion=listar",
            "columns": [
                { "data": "store_id"},
                { "data": "Empleado"},
                { "data": "address"},    
                { "data": "city"},         
                { "data": "last_update"},
                { "data": "store_id",
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
      $(".box-title").html("Listado de Tiendas");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show(); 
  })  

  $(".box").on("click","#nuevo", function(){
      $(this).hide();
      $(".box-title").html("Crear Tienda");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vistas/Tiendas/nuevaTienda.php', function(){
          $.ajax({
             type:"get",
             url:"./Controlador/controladorStaff.php",
             data: {accion:'listar'},
             dataType:"json"
          }).done(function( resultado ) {                    ;
              $.each(resultado.data, function (index, value) { 
                $("#editar #staff_id").append("<option value='" + value.staff_id + "'>" + value.first_name + "'>" + value.last_name + "</option>")
              });
          });
          $.ajax({
            type:"get",
            url:"./Controlador/controladorDirecciones.php",
            data: {accion:'listar'},
            dataType:"json"
         }).done(function( resultado ) {   
            //console.log(resultado.data)           
            $("#address_id option").remove()       
            $("#address_id").append("<option selecte value=''>Seleccione una direccion</option>")
            $.each(resultado.data, function (index, value) { 
              $("#address_id").append("<option value='" + value.address_id + "'>" + value.address + "</option>")
            
            });

      });
         
    })

  $("#editar").on("click","button#grabar",function(){
    var datos=$("#ftiendas").serialize();
    //console.log(datos);
    $.ajax({
          type:"get",
          url:"./Controlador/controladorTiendas.php",
          data: datos,
          dataType:"json"
        }).done(function( resultado ) {
            if(resultado.respuesta){
              swal({
                  position: 'center',
                  type: 'success',
                  title: 'La tienda fue grabada con éxito',
                  showConfirmButton: false,
                  timer: 1200
              })     
                  $(".box-title").html("Listado de Tiendas");
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
                  title: 'Ocurrió un erro al grabar',
                  showConfirmButton: false,
                  timer: 1500
              });
             
          }
      });
  });

  $("#editar").on("click","button#actualizar",function(){
       var datos=$("#ftiendas").serialize();
       console.log(datos);
       $.ajax({
          type:"get",
          url:"./Controlador/controladorTiendas.php",
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
              $(".box-title").html("Listado de Tiendas");
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
            text: "¿Realmente desea borrar la tienda con codigo : " + codigo + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "get",                  
                      url: "./Controlador/controladorTiendas.php",
                      data: {codigo: codigo, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'La tienda con codigo ' + codigo + ' fue borrada',
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
     //Recupera datos del fromulario
     var codigo = $(this).data("codigo");
     var empleados;
     var direcciones;
     var ciudades;
     $(".box-title").html("Actualizar Tienda")
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vistas/Tiendas/editarTienda.php",function(){
          $.ajax({
              type:"get",
              url:"./Controlador/controladorTiendas.php",
              data: {codigo: codigo, accion:'consultar'},
              dataType:"json"
              }).done(function( tiendas ) {        
                  if(tiendas.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Comuna no existe!'                         
                      })
                  } else {
                      $("#store_id").val(tiendas.codigo);                   
                      //$("#manager_staff_id").val(tiendas.tiendas);
                     // $("#address_id").val(tiendas.Direccion);
                      //$("#city_id").val(tiendas.Ciudad);
                      empleados = tiendas.empleados;
                      direcciones = tiendas.direcciones;                                         
                      ciudades = tiendas.ciudades;
                  }
          });

          $.ajax({
              type:"get",
              url:"./Controlador/controladorStaff.php",
              data: {accion:'listar'},
              dataType:"json"
          }).done(function( resultado ) {                      
              $.each(resultado.data, function (index, value) { 
              if(empleados === value.staff_id){
                  $("#editar #staff_id").append("<option selected value='" + value.staff_id + "'>" + value.first_name + "'>" + value.last_name + "</option>")
              }else {
                  $("#editar #staff_id").append("<option value='" + value.staff_id + "'>" + + value.first_name + "'>" + value.last_name + "</option>")
              }
              });

              $.ajax({
                type:"get",
                url:"./Controlador/controladorDirecciones.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(direcciones === value.address_id){
                    $("#editar #address_id").append("<option selected value='" + value.address_id + "'>" + value.address + "</option>")
                }else {
                    $("#editar #address_id").append("<option value='" + value.address_id + "'>" + value.address + "</option>")
                }
                });

            });
          });
        });
    
    });
});
}

        
     