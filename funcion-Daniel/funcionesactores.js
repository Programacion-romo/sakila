function actores(){

  var dt = $("#tablaactor").DataTable({
        "ajax": "./Controlador/controladoractor.php?accion=listar",
        "columns": [
            { "data": "actor_id"},
            { "data": "first_name"},
            { "data": "last_name"},
            { "data": "last_update"},
            { "data": "actor_id",
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
    $(".box-title").html("Listado de actores");
    $("#editar").addClass('hide');
    $("#editar").removeClass('show');
    $("#listado").addClass('show');
    $("#listado").removeClass('hide');  
    $(".box #nuevo").show(); 
})  

$(".box").on("click","#nuevo", function(){
    $(this).hide();
    $(".box-title").html("Crear actor");
    $("#editar").addClass('show');
    $("#editar").removeClass('hide');
    $("#listado").addClass('hide');
    $("#listado").removeClass('show');
    $("#editar").load('./Vistas/actores/nuevoactor.php', function(){
        $.ajax({
           type:"get",
           url:"./Controlador/controladoractor.php",
           data: {accion:'listar'},
           dataType:"json"
        }).done(function( resultado ) {                    ;
            $.each(resultado.data, function (index, value) { 
              $("#editar #actor_id").append("<option value='" + value.actor_id + "'>" + value.first_name + "" + value.last_name + ""+ value.last_update +"</option>")
            });
        });
    });
    
})

$("#editar").on("click","button#grabar",function(){
  var datos=$("#factor").serialize();
  //console.log(datos);
  $.ajax({
        type:"get",
        url:"./Controlador/controladoractor.php",
        data: datos,
        dataType:"json"
      }).done(function( resultado ) {
          if(resultado.respuesta){
            swal({
                position: 'center',
                type: 'success',
                title: 'El actor fue grabado con éxito',
                showConfirmButton: false,
                timer: 1200
            })     
                $(".box-title").html("Listado de actores");
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
     var datos=$("#factor").serialize();
     console.log(datos);
     $.ajax({
        type:"get",
        url:"./Controlador/controladoractor.php",
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
            $(".box-title").html("Listado de actores");
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
          text: "¿Realmente desea borrar la actor con codigo : " + codigo + " ?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Borrarlo!'
    }).then((decision) => {
            if (decision.value) {
                var request = $.ajax({
                    method: "get",                  
                    url: "./Controlador/controladoractor.php",
                    data: {codigo: codigo, accion:'borrar'},
                    dataType: "json"
                })
                request.done(function( resultado ) {
                    if(resultado.respuesta == 'correcto'){
                        swal({
                          position: 'center',
                          type: 'success',
                          title: 'El actor con codigo ' + codigo + ' fue borrada',
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
   //$("#titulo").html("Editar actor");
   //Recupera datos del fromulario
   var codigo = $(this).data("codigo");
   var municipio;
   $(".box-title").html("Actualizar actor")
   $("#editar").addClass('show');
   $("#editar").removeClass('hide');
   $("#listado").addClass('hide');
   $("#listado").removeClass('show');
   $("#editar").load("./Vistas/actores/editaractores.php",function(){
        $.ajax({
            type:"get",
            url:"./Controlador/controladoractor.php",
            data: {codigo: codigo, accion:'consultar'},
            dataType:"json"
            }).done(function( actor ) {        
                if(actor.respuesta === "no existe"){
                    swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'actor no existe!'                         
                    })
                } else {
                    $("#actor_id").val(actor.codigo);                   
                    $("#first_name").val(actor.first_name);                   
                    $("#last_name").val(actor.last_name);                   
                    $("#last_update").val(actor.last_update);
                }
        });
    });
})
}
