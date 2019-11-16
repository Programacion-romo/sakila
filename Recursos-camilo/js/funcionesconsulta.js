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
        $(".box-title").html("Listado de peliculas categorias");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show();  
  
      }) 

}