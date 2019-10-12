var dt;

function paises(){
    $("#contenido").on("click","button#actualizar",function(){
         var datos=$("#fpaises").serialize();
         $.ajax({
            type:"get",
            url:"./php/paises/controladorPaises.php",
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
                $("#titulo").html("Listado paises");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#paises").removeClass("hide");
                $("#paises").addClass("show")
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
                        url: "./php/paises/controladorPaises.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })

                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal(
                                'Borrado!',
                                'La idiomas con codigo : ' + codigo + ' fue borrada',
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
        $("#titulo").html("Listado paises");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#paises").removeClass("hide");
        $("#paises").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

   $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nuevo pais");
        $("#nuevo-editar" ).load("./php/paises/nuevoPais.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#paises").removeClass("show");
        $("#paises").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/paises/controladorPaises.php",
             data: {accion:'listar'},
             dataType:"json"
          }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#country_id option").remove()       
              $("#country_id").append("<option selecte value=''>Seleccione un municipio</option>")
              $.each(resultado.data, function (index, value) { 
                $("#country_id").append("<option value='" + value.country + "'>" + value.last_update + "</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
        var country_id = $("#country_id").attr("value");
        var country = $("#country").attr("value");
        var last_update = $("#last_update").attr("value");
        var datos = "country_id="+country_id+"&country="+country+"&last_update="+last_update;
      
      var datos=$("#fpaises").serialize();
       $.ajax({
            type:"get",
            url:"./php/paises/controladorPaises.php",
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
                $("#titulo").html("Listado paises");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#paises").removeClass("hide");
                $("#grabar").addClass("show")
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
       $("#titulo").html("Editar paises");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
      // var municipio;
        $("#nuevo-editar").load("./php/paises/editarPaises.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#paises").removeClass("show");
        $("#paises").addClass("hide");
       $.ajax({
           type:"get",
           url:"./php/paises/controladorPaises.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
           }).done(function( paises ) {        
                if(paises.respuesta === "no existe"){
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'pais no existe!!!!!'                         
                    })
                } else {
                    $("#country_id").val(paises.codigo);                   
                    $("#country").val(paises.paises);
                  //  municipio = idiomas.municipio;
                }
           });

         /*  $.ajax({
             type:"get",
             url:"./php/municipio/controladorMunicipio.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {                     
              $("#muni_codi option").remove();
              $.each(resultado.data, function (index, value) { 
                
                if(municipio === value.muni_codi){
                  $("#muni_codi").append("<option selected value='" + value.muni_codi + "'>" + value.last_update + "</option>")
                }else {
                  $("#muni_codi").append("<option value='" + value.muni_codi + "'>" + value.last_update + "</option>")
                }
              });
           });   */ 
            
       })
}

$(document).ready(() => {
  $("#contenido").off("click", "a.editar");
  $("#contenido").off("click", "button#actualizar");
  $("#contenido").off("click","a.borrar");
  $("#contenido").off("click","button#nuevo");
  $("#contenido").off("click","button#grabar");
  $("#titulo").html("Listado de paises");
  dt = $("#tabla").DataTable({
        "ajax": "php/paises/controladorPaises.php?accion=listar",
        "columns": [
            { "data": "country_id"} ,
            { "data": "country"},
            { "data": "last_update"},
            { "data": "country_id",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' 
                }
            },
            { "data": "country_id",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
  });
  paises();
});