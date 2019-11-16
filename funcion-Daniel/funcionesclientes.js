function clientes() {

    var dt = $("#tablacliente").DataTable({
        "ajax": "./Controlador/controladorcliente.php?accion=listar",
        "columns": [
            { "data": "customer_id" },
            { "data": "store_id" },
            { "data": "first_name" },
            { "data": "last_name" },
            { "data": "email" },
            { "data": "address_id" },
            { "data": "active" },
            { "data": "create_date" },
            { "data": "last_update" },
            {
                "data": "customer_id",
                render: function (data) {
                    return '<a href="#" data-codigo="' + data +
                        '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                        + '<a href="#" data-codigo="' + data +
                        '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
                }
            }
        ]
    });

    $("#editar").on("click", ".btncerrar", function () {
        $(".box-title").html("Listado de clientes");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');
        $(".box #nuevo").show();
    })

    $(".box").on("click", "#nuevo", function () {
        $(this).hide();
        $(".box-title").html("Crear cliente");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/clientes/nuevocliente.php', function () {
            $.ajax({
                type: "get",
                url: "./Controlador/controladorTiendas.php",
                data: { accion: 'listar' },
                dataType: "json"
            }).done(function (resultado) {
                ;
                $.each(resultado.data, function (index, value) {
                    $("#editar #store_id").append("<option value='" + value.store_id + "'>" + value.store_id + "</option>")
                });
            });
            $.ajax({
                type: "get",
                url: "./Controlador/controladorDirecciones.php",
                data: { accion: 'listar' },
                dataType: "json"
            }).done(function (resultado) {
                //console.log(resultado.data)           
                $("#address_id option").remove()
                $("#address_id").append("<option selecte value=''>Seleccione una direccion</option>")
                $.each(resultado.data, function (index, value) {
                    $("#address_id").append("<option value='" + value.address_id + "'>" + value.address + "</option>")
                });
            });
        })

        $("#editar").on("click", "button#grabar", function () {
            var datos = $("#fcliente").serialize();
            //console.log(datos);
            $.ajax({
                type: "get",
                url: "./Controlador/controladorcliente.php",
                data: datos,
                dataType: "json"
            }).done(function (resultado) {
                if (resultado.respuesta) {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'El cliente fue grabado con éxito',
                        showConfirmButton: false,
                        timer: 1200
                    })
                    $(".box-title").html("Listado de clientes");
                    $(".box #nuevo").show();
                    $("#editar").html('');
                    $("#editar").addClass('hide');
                    $("#editar").removeClass('show');
                    $("#listado").addClass('show');
                    $("#listado").removeClass('hide');
                    dt.page('last').draw('page');
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

        $("#editar").on("click", "button#actualizar", function () {
            var datos = $("#fcliente").serialize();
            console.log(datos);
            $.ajax({
                type: "get",
                url: "./Controlador/controladorcliente.php",
                data: datos,
                dataType: "json"
            }).done(function (resultado) {
                if (resultado.respuesta) {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'Se actualizaron los datos correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $(".box-title").html("Listado de clientes");
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

        $(".box-body").on("click", "a.borrar", function () {
            //Recupera datos del formulario
            var codigo = $(this).data("codigo");

            swal({
                title: '¿Está seguro?',
                text: "¿Realmente desea borrar la cliente con codigo : " + codigo + " ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Borrarlo!'
            }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",
                        url: "./Controlador/controladorcliente.php",
                        data: { codigo: codigo, accion: 'borrar' },
                        dataType: "json"
                    })
                    request.done(function (resultado) {
                        if (resultado.respuesta == 'correcto') {
                            swal({
                                position: 'center',
                                type: 'success',
                                title: 'El cliente con codigo ' + codigo + ' fue borrada',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var info = dt.page.info();
                            if ((info.end - 1) == info.length)
                                dt.page(info.page - 1).draw('page');
                            dt.ajax.reload(null, false);
                        } else {
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            })
                        }
                    });

                    request.fail(function (jqXHR, textStatus) {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!' + textStatus
                        })
                    });
                }
            })

        });

        $(".box-body").on("click", "a.editar", function () {
            //$("#titulo").html("Editar cliente");
            //Recupera datos del fromulario
            var codigo = $(this).data("codigo");
            $(".box-title").html("Actualizar cliente")
            $("#editar").addClass('show');
            $("#editar").removeClass('hide');
            $("#listado").addClass('hide');
            $("#listado").removeClass('show');
            $("#editar").load("./Vistas/clientes/editarclientes.php", function () {
                var direcciones;
                var tiendas;
                $.ajax({
                    type: "get",
                    url: "./Controlador/controladorcliente.php",
                    data: { codigo: codigo, accion: 'consultar' },
                    dataType: "json"
                }).done(function (cliente) {
                    if (cliente.respuesta === "no existe") {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'cliente no existe!'
                        })
                    } else {
                        $("#customer_id").val(cliente.codigo);
                        tiendas = cliente.tiendas;
                        $("#first_name").val(cliente.Nombre);
                        $("#last_name").val(cliente.Apellido);
                        $("#email").val(cliente.Correo);
                        direcciones = cliente.direcciones;
                        $("#active").val(cliente.Activo);
                    }
                });

                $.ajax({
                    type: "get",
                    url: "./Controlador/controladorTiendas.php",
                    data: { accion: 'listar' },
                    dataType: "json"
                }).done(function (resultado) {
                    $.each(resultado.data, function (index, value) {
                        if (tiendas === value.store_id) {
                            $("#editar #store_id").append("<option selected value='" + value.store_id + "'>" + value.store_id + "</option>")
                        } else {
                            $("#editar #store_id").append("<option value='" + value.store_id + "'>" + value.store_id + "</option>")
                        }
                    });
                })

                $.ajax({
                    type: "get",
                    url: "./Controlador/controladorDirecciones.php",
                    data: { accion: 'listar' },
                    dataType: "json"
                }).done(function (resultado) {
                    $.each(resultado.data, function (index, value) {
                        if (direcciones === value.address_id) {
                            $("#editar #address_id").append("<option selected value='" + value.address_id + "'>" + value.address + "</option>")
                        } else {
                            $("#editar #address_id").append("<option value='" + value.address_id + "'>" + value.address + "</option>")
                        }
                    });
                });
            });
        });
    })
}
