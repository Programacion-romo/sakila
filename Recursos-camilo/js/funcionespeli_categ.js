function peli_categ(){

    var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorpeli_categ.php?accion=listar",
            "columns": [
              { "data": "title"} ,
              { "data": "name"} ,
              { "data": "last_update"} ,
              { "data": "title",
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
      $(".box-title").html("Listado de peliculas categorias");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show();  

    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear categoria de peliculas");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/peli_Categ/nuevapeli_categ.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladorpeliculas.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {  
              $("#film_id option").remove()       
            $("#film_id").append("<option selecte value=''>Seleccione una pelicula</option>")                   
                $.each(resultado.data, function (index, value) { 
                  $("#editar #film_id").append("<option value='" + value.film_id + "'>" + value.title + "</option>")
                });
            });
            $.ajax({
              type:"get",
              url:"./Controlador/controladorcategorias.php",
              data: {accion:'listar'},
              dataType:"json"
           }).done(function( resultado ) {            
              $("#category_id option").remove()       
              $("#category_id").append("<option selecte value=''>Seleccione una categoria/option>")
              $.each(resultado.data, function (index, value) { 
                $("#category_id").append("<option value='" + value.category_id + "'>" + value.name + "</option>")
              
              });
        });
      });
        
    })

    $("#editar").on("click","button#grabar",function(){
      var datos=$("#fpeli_categ").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorpeli_categ.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'la categoria de pelicula fue grabada con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de categoria de peliculas");
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
         var datos=$("#fpeli_categ").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorpeli_categ.php",
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
                $(".box-title").html("Listado de categoria de peliculas");
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
                        url: "./Controlador/controladorpeli_categ.php",
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
       var codigo = $(this).data("codigo");
       var peliculas;
       var categorias;
       $(".box-title").html("Actualizar categoria de peliculas")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/peli_Categ/editarpeli_Categ.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorpeli_Categ.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( peli_Categ ) {        
                    if(peliculas.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'peli_categ no existe!'                         
                        })
                    } else {
                        $("#last_update").val(peli_Categ.Actualizacion);
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
                          $("#editar #").append("<option selected value='" + value.film_id + "'>" + value.title + "</option>")
                      }else {
                          $("#editar #film_id").append("<option value='" + value.film_id + "'>" + value.title + "</option>")
                      }
                      });
        
                      $.ajax({
                        type:"get",
                        url:"./Controlador/controladorcategorias.php",
                        data: {accion:'listar'},
                        dataType:"json"
                    }).done(function( resultado ) {                      
                        $.each(resultado.data, function (index, value) { 
                        if(categorias === value.category_id){
                            $("#editar #category_id").append("<option selected value='" + value.category_id + "'>" + value.name + "</option>")
                        }else {
                            $("#editar #category_id").append("<option value='" + value.category_id + "'>" + value.name + "</option>")
                        }
                        });
        
                    });
                  });
                });
        });
        }
        
                
             