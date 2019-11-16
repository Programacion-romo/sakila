function consulta(){

    var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorconsulta.php?accion=listar",
            "columns": [
              { "data": "film_id"} ,
              { "data": "title"} ,
              { "data": "name"} ,
              { "data": "store_id"},
              { "data": "address"},
              { "data": "city"},
              { "data": "film_id"} ,
                            
              
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

}