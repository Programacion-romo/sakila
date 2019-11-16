function direcciones(){

    var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorDirecciones.php?accion=listar",
            "columns": [
                { "data": "address_id"} ,
                { "data": "address"},
                { "data": "address2"},
                { "data": "district"},
                { "data": "city"},
                { "data": "postal_code"},
                { "data": "phone"},
                { "data": "last_update"},
                { "data": "address_id",
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
      $(".box-title").html("Listado de Direcciones");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show(); 
  })  

  $(".box").on("click","#nuevo", function(){
      $(this).hide();
      $(".box-title").html("Crear Direcccion");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vistas/Direcciones/nuevaDireccion.php', function(){
          $.ajax({
             type:"get",
             url:"./Controlador/controladorCiudades.php",
             data: {accion:'listar'},
             dataType:"json"
          }).done(function( resultado ) {                    ;
              $.each(resultado.data, function (index, value) { 
                $("#editar #city_id").append("<option value='" + value.city_id + "'>" + value.city + "</option>")
              });
          });
      });
      
  })

  $("#editar").on("click","button#grabar",function(){
    var datos=$("#fdirecciones").serialize();
    //console.log(datos);
    $.ajax({
          type:"get",
          url:"./Controlador/controladorDirecciones.php",
          data: datos,
          dataType:"json"
        }).done(function( resultado ) {
            if(resultado.respuesta){
              swal({
                  position: 'center',
                  type: 'success',
                  title: 'La direccion fue grabada con éxito',
                  showConfirmButton: false,
                  timer: 1200
              })     
                  $(".box-title").html("Listado de Direcciones");
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
       var datos=$("#fdirecciones").serialize();
       console.log(datos);
       $.ajax({
          type:"get",
          url:"./Controlador/controladorDirecciones.php",
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
              $(".box-title").html("Listado de Direcciones");
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
            text: "¿Realmente desea borrar la direccion con codigo : " + codigo + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "get",                  
                      url: "./Controlador/controladorDirecciones.php",
                      data: {codigo: codigo, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'La direccion con codigo ' + codigo + ' fue borrada',
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
     //$("#titulo").html("Editar Comuna");
     //Recupera datos del fromulario
     var codigo = $(this).data("codigo");
     var ciudades;
     $(".box-title").html("Actualizar Direccion")
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vistas/Direcciones/editarDireccion.php",function(){
          $.ajax({
              type:"get",
              url:"./Controlador/controladorDirecciones.php",
              data: {codigo: codigo, accion:'consultar'},
              dataType:"json"
              }).done(function( direcciones ) {        
                  if(direcciones.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Comuna no existe!'                         
                      })
                  } else {
                      $("#address_id").val(direcciones.codigo);                   
                      $("#address").val(direcciones.direcciones);
                      $("#address2").val(direcciones.Nombre2);
                      $("#district").val(direcciones.Distrito);
                      $("#city_id").val(direcciones.Ciudad);
                      $("#postal_code").val(direcciones.CodigoPostal);
                      $("#phone").val(direcciones.Telefono);                      
                      ciudades = direcciones.ciudades;
                  }
          });

          $.ajax({
              type:"get",
              url:"./Controlador/controladorCiudades.php",
              data: {accion:'listar'},
              dataType:"json"
          }).done(function( resultado ) {                      
              $.each(resultado.data, function (index, value) { 
              if(ciudades === value.city_id){
                  $("#editar #city_id").append("<option selected value='" + value.city_id + "'>" + value.city + "</option>")
              }else {
                  $("#editar #city_id").append("<option value='" + value.city_id + "'>" + value.city + "</option>")
              }
              });
          });
      });
  })
}
