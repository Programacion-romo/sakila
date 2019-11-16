function paises(){

    var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorPaises.php?accion=listar",
            "columns": [
                { "data": "country_id"} ,
                { "data": "country"},
                { "data": "last_update"},
                { "data": "country_id",
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
      $(".box-title").html("Listado de Paises");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show(); 
  })  

  $(".box").on("click","#nuevo", function(){
      $(this).hide();
      $(".box-title").html("Crear Pais");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vistas/Paises/nuevoPais.php', function(){
          $.ajax({
             type:"get",
             url:"./Controlador/controladorPaises.php",
             data: {accion:'listar'},
             dataType:"json"
          }).done(function( resultado ) {                    ;
              $.each(resultado.data, function (index, value) { 
                $("#country_id").append("<option value='" + value.country + "'>" + value.last_update + "</option>")
              });
          });
      });
      
  })

  $("#editar").on("click","button#grabar",function(){
    var datos=$("#fpaises").serialize();
    //console.log(datos);
    $.ajax({
          type:"get",
          url:"./Controlador/controladorPaises.php",
          data: datos,
          dataType:"json"
        }).done(function( resultado ) {
            if(resultado.respuesta){
              swal({
                  position: 'center',
                  type: 'success',
                  title: 'El pais fue grabado con éxito',
                  showConfirmButton: false,
                  timer: 1200
              })     
                  $(".box-title").html("Listado de Paises");
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
       var datos=$("#fpaises").serialize();
       console.log(datos);
       $.ajax({
          type:"get",
          url:"./Controlador/controladorPaises.php",
          data: datos,
          dataType:"json"
        }).done(function( resultado ) {
 
            if(resultado.respuesta){    
              swal({
                  position: 'center',
                  type: 'success',
                  title: 'Se actualizaron los datos correctamente',
                  showConfirmButton: false,
                  timer: 1500
              }) 
              $(".box-title").html("Listado de Paises");
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
            text: "¿Realmente desea borrar el pais con codigo : " + codigo + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "get",                  
                      url: "./Controlador/controladorPaises.php",
                      data: {codigo: codigo, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'El pais con codigo ' + codigo + ' fue borrada',
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
     
     $(".box-title").html("Actualizar Pais")
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vistas/Paises/editarPais.php",function(){
          $.ajax({
              type:"get",
              url:"./Controlador/controladorPaises.php",
              data: {codigo: codigo, accion:'consultar'},
              dataType:"json"
              }).done(function( paises ) {        
                  if(paises.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Pais no existe!'                         
                      })
                  } else {
                      $("#country_id").val(paises.codigo);                   
                      $("#country").val(paises.paises);
                      
                  }
          });

          
      });
  })
}
