var dt;

function categorias(){
    $("#contenido").on("click","button#actualizar",function(){
         var datos=$("#fcategorias").serialize();
         $.ajax({
            type:"get",
            url:"./php/categorias/controladorcategoria.php",
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
                $("#titulo").html("Listado categorias");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#categorias").removeClass("hide");
                $("#categorias").addClass("show")
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
              text: "¿Realmente desea borrar el categorias con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {

                    var request = $.ajax({
                        method: "get",
                        url: "./php/categorias/controladorcategoria.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })

                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal(
                                'Borrado!',
                                'la categoria con codigo : ' + codigo + ' fue borrada',
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
        $("#titulo").html("Listado categorias");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#categorias").removeClass("hide");
        $("#categorias").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

    $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nueva categorias");
        $("#nuevo-editar" ).load("./php/categorias/nuevacategoria.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#categorias").removeClass("show");
        $("#categorias").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/categorias/controladorcategoria.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#category_id option").remove()       
              $("#category_id").append("<option selecte value=''>Seleccione una fecha</option>")
              $.each(resultado.data, function (index1, value) { 
                $("#category_id").append("<option value='" + value.category_id + "'>" + value.last_update + "</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
        var category_id = $("#category_id").attr("value");
        var name = $("#name").attr("value");
        var muni_codi = $("#last_update").attr("value");
        var datos = "category_id="+category_id+"&name="+name+"&last_update="+last_update;
      
      var datos=$("#fcategorias").serialize();
       $.ajax({
            type:"get",
            url:"./php/categorias/controladorcategoria.php",
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
                $("#titulo").html("Listado categorias");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#categorias").removeClass("hide");
                $("#categorias").addClass("show")
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
       $("#titulo").html("Editar categorias");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
      // var municipio;
        $("#nuevo-editar").load("./php/categorias/editarcategoria.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#categorias").removeClass("show");
        $("#categorias").addClass("hide");
       $.ajax({
           type:"get",
           url:"./php/categorias/controladorcategoria.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
           }).done(function( categorias ) {        
                if(categorias.respuesta === "no existe"){
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'categorias no existe!!!!!'                         
                    })
                } else {
                    $("#category_id").val(categorias.codigo);                   
                    $("#name").val(categorias.categorias);
                  //  municipio = categorias.municipio;
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
  $("#titulo").html("Listado de categoriass");
  dt = $("#tabla").DataTable({
        "ajax": "php/categorias/controladorcategoria.php?accion=listar",
        "columns": [
            { "data": "category_id"} ,
            { "data": "name" },
            { "data": "last_update" },
            { "data": "category_id",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' 
                }
            },
            { "data": "category_id",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
  });
  categorias();
});