var dt;

function ciudades(){
    $("#contenido").on("click","button#actualizar",function(){
         var datos=$("#fciudades").serialize();
         $.ajax({
            type:"get",
            url:"./php/ciudades/controladorCiudades.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal(
                    'Actualizado!',
                    'Se actaulizaron los datos correctamente',
                    'success'
                )     
                dt.ajax.reload();
                $("#titulo").html("Listado ciudades");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#ciudades").removeClass("hide");
                $("#ciudades").addClass("show")
             } else {
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!'                         
                })
            }
        });
    })

    $("#contenido").on("click","a.borrar",function(){
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
                        url: "./php/ciudades/controladorCiudades.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })

                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal(
                                'Borrado!',
                                'La ciudad con codigo : ' + codigo + ' fue borrada',
                                'success'
                            )     
                            dt.ajax.reload();                            
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

    $("#contenido").on("click","button.btncerrar2",function(){
        $("#titulo").html("Listado Ciudades");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#ciudades").removeClass("hide");
        $("#ciudades").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

   $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nueva ciudad");
        $("#nuevo-editar" ).load("./php/ciudades/nuevaCiudades.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#ciudades").removeClass("show");
        $("#ciudades").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/paises/controladorPaises.php",
             data: {accion:'listar'},
             dataType:"json"
          }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#country_id option").remove()       
              $("#country_id").append("<option selecte value=''>Seleccione un pais</option>")
              $.each(resultado.data, function (index, value) { 
                $("#country_id").append("<option value='" + value.country_id + "'>" + value.country + "</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
      /*  var country_id = $("#country_id").attr("value");
        var country = $("#country").attr("value");
        var last_update = $("#last_update").attr("value");
        var datos = "country_id="+country_id+"&country="+country+"&last_update="+last_update;*/
      
      var datos=$("#fciudades").serialize();
       $.ajax({
            type:"get",
            url:"./php/ciudades/controladorCiudades.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal(
                    'Grabado!!',
                    'El registro se grabó correctamente',
                    'success'
                )     
                dt.ajax.reload();
                $("#titulo").html("Listado ciudades");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#ciudades").removeClass("hide");
                $("#ciudades").addClass("show")
             } else {
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!'                         
                })
            }
        });
    });


    $("#contenido").on("click","a.editar",function(){
       $("#titulo").html("Editar ciudad");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
      var paises;
        $("#nuevo-editar").load("./php/ciudades/editarCiudades.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#ciudades").removeClass("show");
        $("#ciudades").addClass("hide");
       $.ajax({
           type:"get",
           url:"./php/ciudades/controladorCiudades.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
           }).done(function( ciudades ) {        
                if(ciudades.respuesta === "no existe"){
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'pais no existe!!!!!'                         
                    })
                } else {
                    $("#city_id").val(ciudades.codigo);                   
                    $("#city").val(ciudades.ciudades);
                   paises = ciudades.paises;
                }
           });

          $.ajax({
             type:"get",
             url:"./php/paises/controladorPaises.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {                     
              $("#country_id option").remove();
              $.each(resultado.data, function (index, value) { 
                
                if(paises === value.country_id){
                  $("#country_id").append("<option selected value='" + value.country_id + "'>" + value.country + "</option>")
                }else {
                  $("#country_id").append("<option value='" + value.country_id + "'>" + value.country + "</option>")
                }
              });
           });   
            
       })
}

$(document).ready(() => {
  $("#contenido").off("click", "a.editar");
  $("#contenido").off("click", "button#actualizar");
  $("#contenido").off("click","a.borrar");
  $("#contenido").off("click","button#nuevo");
  $("#contenido").off("click","button#grabar");
  $("#titulo").html("Listado de ciudades");
  dt = $("#tabla").DataTable({
        "ajax": "php/ciudades/controladorCiudades.php?accion=listar",
        "columns": [
            { "data": "city_id"} ,
            { "data": "city"},
            { "data": "country"},
            { "data": "last_update"},
            { "data": "city_id",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' 
                }
            },
            { "data": "city_id",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
  });
  ciudades();
});