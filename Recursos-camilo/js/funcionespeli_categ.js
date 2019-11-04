function peli_categ(){

    var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorpeli_categ.php?accion=listar",
            "columns": [
              { "data": "title"} ,
              { "data": "name"} ,
              { "data": "last_update"} ,
              
            ]
    });

  $("#editar").on("click",".btncerrar", function(){
      $(".box-title").html("Listado de peliculas categorias");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show();  

  });

}
