function idiomas(){

      var dt = $("#tabla").DataTable({
          	"ajax": "./Controlador/controladoridiomas.php?accion=listar",
          	"columns": [
                { "data": "language_id"} ,
                { "data": "name" },
                { "data": "last_update" },
                { "data": "language_id",
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
        $(".box-title").html("Listado de idiomas");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear idiomas");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/idiomas/nuevaidioma.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladoridiomas.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #language_id").append("<option value='" + value.language_id + "'>" + value.last_update + "</option>")
                });
            });
        });
        
    })

    $("#editar").on("click","button#grabar",function(){
      var datos=$("#fidiomas").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladoridiomas.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'El idioma fue grabada con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de idiomas");
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
         var datos=$("#fidiomas").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladoridiomas.php",
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
                $(".box-title").html("Listado de idiomas");
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
              text: "¿Realmente desea borrar el idioma con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladoridiomas.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'El idioma con codigo ' + codigo + ' fue borrada',
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
       $(".box-title").html("Actualizar idiomas")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/idiomas/editaridiomas.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladoridiomas.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( idiomas ) {        
                    if(idiomas.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'idiomas no existe!'                         
                        })
                    } else {
                        $("#language_id").val(idiomas.codigo);                   
                        $("#name").val(idiomas.idiomas);
                        $("#last_update").val(idiomas.Actualizacion);
                    }
            });
 
                });
            
    
    })
}
