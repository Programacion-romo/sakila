function peliculas(){

    var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorpeliculas.php?accion=listar",
            "columns": [
              { "data": "film_id"} ,
              { "data": "title" },
              { "data": "description" },
              { "data": "release_year" },
              { "data": "language_id" },
              { "data": "original_language_id" },
              { "data": "rental_duration" },
              { "data": "rental_rate" },
              { "data": "length" },
              { "data": "replacement_cost" },
              { "data": "rating" },
              { "data": "special_features" },
              { "data": "last_update" },
              { "data": "film_id",
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
      $(".box-title").html("Listado de peliculas");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show(); 
  })  

  $(".box").on("click","#nuevo", function(){
      $(this).hide();
      $(".box-title").html("Crear peliculas");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vistas/peliculas/nuevapelicula.php', function(){
          $.ajax({
             type:"get",
             url:"./Controlador/controladoridiomas.php",
             data: {accion:'listar'},
             dataType:"json"
          }).done(function( resultado ) {                    ;
              $.each(resultado.data, function (index, value) { 
                $("#editar #language_id").append("<option value='" + value.language_id + "'>" + value.name + "</option>")
              });
          });
      });
      
  })

  $("#editar").on("click","button#grabar",function(){
    var datos=$("#fpeliculas").serialize();
    //console.log(datos);
    $.ajax({
          type:"get",
          url:"./Controlador/controladorpeliculas.php",
          data: datos,
          dataType:"json"
        }).done(function( resultado ) {
            if(resultado.respuesta){
              swal({
                  position: 'center',
                  type: 'success',
                  title: 'La pelicula fue grabada con éxito',
                  showConfirmButton: false,
                  timer: 1200
              })     
                  $(".box-title").html("Listado de peliculas");
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
       var datos=$("#fpeliculas").serialize();
       console.log(datos);
       $.ajax({
          type:"get",
          url:"./Controlador/controladorpeliculas.php",
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
              $(".box-title").html("Listado de peliculas");
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
            text: "¿Realmente desea borrar la pelicula con codigo : " + codigo + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "get",                  
                      url: "./Controlador/controladorpeliculas.php",
                      data: {codigo: codigo, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'La pelicula con codigo ' + codigo + ' fue borrada',
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
     var idiomas;
     var peliculas;
     var peliculas;
     $(".box-title").html("Actualizar peliculas")
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vistas/peliculas/editarpeliculas.php",function(){
          $.ajax({
              type:"get",
              url:"./Controlador/controladorpeliculas.php",
              data: {codigo: codigo, accion:'consultar'},
              dataType:"json"
              }).done(function( peliculas ) {        
                  if(peliculas.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'peliculas no existe!'                         
                      })
                  } else {
                  $("#film_id").val(peliculas.codigo);                   
                  $("#title").val(peliculas.peliculas);
                  $("#description").val(peliculas.Descripcion);
                  $("#release_year").val(peliculas.Año_Estreno);
                  $("#language_id").val(peliculas.Ori_codigo_idio);
                  $("#rental_duration").val(peliculas.Duracion_alquiler);
                  $("#rental_rate").val(peliculas.Tasa_alquiler);
                  $("#length").val(peliculas.Longitud);
                  $("#replacement_cost").val(peliculas.Costos_remp);
                  //$("#rating").val(peliculas.Clasificacion);
                 // $("#special_features").val(peliculas.Caract_especiales);
                  $("#last_update").val(peliculas.Actualizacion);
                
                  idiomas = peliculas.idiomas;
                  peliculas = peliculas.rating;
                  peliculas = peliculas.special_features;
                  }
          });

          $.ajax({
            type:"get",
            url:"./Controlador/controladoridiomas.php",
            data: {accion:'listar'},
            dataType:"json"
        }).done(function( resultado ) {                      
            $.each(resultado.data, function (index, value) { 
            if(idiomas === value.language_id){
                $("#editar #language_id").append("<option selected value='" + value.language_id + "'>" + value.name + "</option>")
            }else {
                $("#editar #language_id").append("<option value='" + value.language_id + "'>" + value.name + "</option>")
            }
            });
    

        $.ajax({
          type:"get",
          url:"./Controlador/controladorpeliculas.php",
          data: {accion:'listar'},
          dataType:"json"
      }).done(function( resultado ) {                      
          $.each(resultado.data, function (index, value) { 
          if(peliculas === value.film_id){
              $("#editar #film_id").append("<option selected value='" + value.film_id + "'>" + value.rating + "</option>")
          }else {
              $("#editar #film_id").append("<option value='" + value.film_id + "'>" + value.rating + "</option>")
          }
          });
    

        $.ajax({
          type:"get",
          url:"./Controlador/controladorpeliculas.php",
          data: {accion:'listar'},
          dataType:"json"
      }).done(function( resultado ) {                      
          $.each(resultado.data, function (index, value) { 
          if(peliculas === value.film_id){
              $("#editar #film_id").append("<option selected value='" + value.special_features + "'>" + value.special_features + "</option>")
          }else {
              $("#editar #film_id").append("<option value='" + value.special_features + "'>" + value.special_features + "</option>")
          }
          });
        });
    });
        });
    });
})
}

