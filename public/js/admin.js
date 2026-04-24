$(function () {

    const urlBase = "index.php";
    let contenidoAdmin = $("#contenidoAdmin");

    function cargarVista(option) {
        $.get(urlBase,
            {
                option: option
            },
            function (data, status) {
                contenidoAdmin.html(data);

                if (option === "admin_dashboard_view") {
                    cargarDashboardAdmin();
                }

                if (option === "admin_productos_view") {
                    cargarProductosAdmin();
                }

                if (option === "admin_categorias_view") {
                    cargarCategoriasAdmin();
                }

                if (option === "admin_pedidos_view") {
                    cargarPedidosAdmin();
                }

                if (option === "admin_usuarios_view") {
                    cargarUsuariosAdmin();
                }

                if (option === "admin_roles_view") {
                    cargarRolesAdmin();
                }
            }
        );
    }

    function cargarDashboardAdmin() {
        $.get(urlBase,
            {
                option: "dashboard_json"
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                if (data.response === "00") {
                    $("#cardUsuarios").text(data.data.usuarios);
                    $("#cardProductos").text(data.data.productos);
                    $("#cardCategorias").text(data.data.categorias);
                    $("#cardPedidos").text(data.data.pedidos);

                    $("#cardEnviados").text(data.data.enviados);
                    $("#cardProcesando").text(data.data.procesando);
                    $("#cardEntregados").text(data.data.entregados);
                    $("#cardCancelados").text(data.data.cancelados);

                    $("#barraEnviados").css("width", data.data.porcentaje_enviados + "%");
                    $("#barraProcesando").css("width", data.data.porcentaje_procesando + "%");
                    $("#barraEntregados").css("width", data.data.porcentaje_entregados + "%");
                    $("#barraCancelados").css("width", data.data.porcentaje_cancelados + "%");
                }
            }
        );
    }

    function cargarProductosAdmin() {
        $.get(urlBase,
            {
                option: "admin_productos_json"
            },
            function (data, status) {
                data = JSON.parse(data);

                let html = "";

                data.forEach(function (product) {
                    html += `
                        <tr>
                            <td>${product.id_producto}</td>
                            <td><img src="public/img/${product.imagen}" class="imgAdminProducto"></td>
                            <td>${product.nombre}</td>
                            <td>${product.categoria}</td>
                            <td>₡${product.precio}</td>
                            <td>${product.cantidad}</td>
                            <td>${product.estado}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-dark btnEditarProducto" data-id="${product.id_producto}">
                                    Editar
                                </button>

                                <button class="btn btn-sm btn-danger btnEliminarProducto" data-id="${product.id_producto}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });

                $("#tablaProductosAdmin").html(html);
            }
        );
    }

    function cargarCategoriasAdmin() {
        $.get(urlBase,
            {
                option: "admin_categorias_json"
            },
            function (data, status) {
                data = JSON.parse(data);

                let html = "";

                data.forEach(function (category) {
                    html += `
                        <tr>
                            <td>${category.id_categoria}</td>
                            <td>${category.nombre}</td>
                            <td>${category.descripcion ?? ""}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-dark btnEditarCategoria" data-id="${category.id_categoria}">
                                    Editar
                                </button>

                                <button class="btn btn-sm btn-danger btnEliminarCategoria" data-id="${category.id_categoria}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });

                $("#tablaCategoriasAdmin").html(html);
            }
        );
    }

    function cargarPedidosAdmin() {
        $.get(urlBase,
            {
                option: "admin_pedidos_json"
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                let html = "";

                if (data.response === "00") {
                    data.data.forEach(function (order) {
                        html += `
                        <tr>
                            <td>${order.id_pedido}</td>
                            <td>${order.nombre} ${order.apellidos}</td>
                            <td>${order.email}</td>
                            <td>${order.fecha}</td>
                            <td>₡${order.total}</td>
                            <td>
                                <select class="form-select form-select-sm selectEstadoPedido" data-id="${order.id_pedido}">
                                    <option value="enviado" ${order.estado === "enviado" ? "selected" : ""}>Enviado</option>
                                    <option value="procesando" ${order.estado === "procesando" ? "selected" : ""}>Procesando</option>
                                    <option value="entregado" ${order.estado === "entregado" ? "selected" : ""}>Entregado</option>
                                    <option value="cancelado" ${order.estado === "cancelado" ? "selected" : ""}>Cancelado</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-dark btnVerDetallePedido" data-id="${order.id_pedido}">
                                    Ver detalle
                                </button>
                            </td>
                        </tr>
                    `;
                    });
                }

                $("#tablaPedidos tbody").html(html);
            }
        );
    }

    function cargarUsuariosAdmin() {
        $.get(urlBase,
            {
                option: "admin_usuarios_json"
            },
            function (data, status) {
                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                let html = "";

                if (data.response === "00") {
                    data.data.forEach(function (user) {
                        html += `
                        <tr>
                            <td>${user.id_usuario}</td>
                            <td>${user.nombre}</td>
                            <td>${user.apellidos}</td>
                            <td>${user.email}</td>
                            <td>${user.rol}</td>
                            <td>${user.estado}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-dark btnEditarUsuario" data-id="${user.id_usuario}">
                                    Editar
                                </button>
                                <button class="btn btn-sm btn-danger btnEliminarUsuario" data-id="${user.id_usuario}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                    });
                }

                $("#tablaUsuarios tbody").html(html);
            }
        );
    }

    function cargarRolesAdmin() {
        $.get(urlBase,
            {
                option: "admin_roles_json"
            },
            function (data, status) {
                data = JSON.parse(data);

                let html = "";

                data.forEach(function (role) {
                    html += `
                        <tr>
                            <td>${role.id_rol}</td>
                            <td>${role.nombre}</td>
                            <td>${role.descripcion ?? ""}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-dark btnEditarRol" data-id="${role.id_rol}">
                                    Editar
                                </button>

                                <button class="btn btn-sm btn-danger btnEliminarRol" data-id="${role.id_rol}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });

                $("#tablaRolesAdmin").html(html);
            }
        );
    }

    cargarDashboardAdmin();

    function cargarCategoriasSelect() {
        $.get(urlBase,
            {
                option: "admin_categorias_json"
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                let html = "";

                data.forEach(function (category) {
                    html += `
                    <option value="${category.id_categoria}">
                        ${category.nombre}
                    </option>
                `;
                });

                $("#categoriaProducto").html(html);
            }
        );
    }

    $(document).on("click", "#btnNuevoProducto", function () {
        $("#tituloModalProducto").text("Nuevo Producto");
        $("#idProducto").val("");
        $("#nombreProducto").val("");
        $("#descripcionProducto").val("");
        $("#precioProducto").val("");
        $("#cantidadProducto").val("");
        $("#imagenProducto").val("");
        $("#estadoProducto").val("activo");

        cargarCategoriasSelect();

        let modal = new bootstrap.Modal(document.getElementById("modalProducto"));
        modal.show();
    });

    $(document).on("click", ".btnEditarProducto", function () {
        let id = $(this).data("id");

        $.get(urlBase,
            {
                option: "producto_admin_detalle",
                id: id
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                $("#tituloModalProducto").text("Editar Producto");
                $("#idProducto").val(data.id_producto);
                $("#nombreProducto").val(data.nombre);
                $("#descripcionProducto").val(data.descripcion);
                $("#precioProducto").val(data.precio);
                $("#cantidadProducto").val(data.cantidad);
                $("#imagenProducto").val(data.imagen);
                $("#estadoProducto").val(data.estado);

                cargarCategoriasSelect();

                setTimeout(function () {
                    $("#categoriaProducto").val(data.id_categoria);
                }, 200);

                let modal = new bootstrap.Modal(document.getElementById("modalProducto"));
                modal.show();
            }
        );
    });

    $(document).on("submit", "#formProducto", function (event) {
        event.preventDefault();

        let id = $("#idProducto").val();

        let option = id === "" ? "crear_producto" : "editar_producto";

        $.post(urlBase,
            {
                option: option,
                id_producto: id,
                nombre: $("#nombreProducto").val(),
                descripcion: $("#descripcionProducto").val(),
                precio: $("#precioProducto").val(),
                cantidad: $("#cantidadProducto").val(),
                imagen: $("#imagenProducto").val(),
                id_categoria: $("#categoriaProducto").val(),
                estado: $("#estadoProducto").val()
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                alert(data.message);

                if (data.response === "00") {
                    bootstrap.Modal.getInstance(document.getElementById("modalProducto")).hide();
                    cargarProductosAdmin();
                }
            }
        );
    });

    $(document).on("click", ".btnEliminarProducto", function () {
        let id = $(this).data("id");

        if (confirm("¿Desea eliminar este producto?")) {
            $.post(urlBase,
                {
                    option: "eliminar_producto",
                    id_producto: id
                },
                function (data, status) {

                    if (typeof data === "string") {
                        data = JSON.parse(data);
                    }

                    alert(data.message);

                    if (data.response === "00") {
                        cargarProductosAdmin();
                    }
                }
            );
        }
    });

    $(document).on("click", "#btnNuevaCategoria", function () {
        $("#tituloModalCategoria").text("Nueva Categoría");
        $("#idCategoria").val("");
        $("#nombreCategoria").val("");
        $("#descripcionCategoria").val("");

        let modal = new bootstrap.Modal(document.getElementById("modalCategoria"));
        modal.show();
    });

    $(document).on("click", ".btnEditarCategoria", function () {
        let id = $(this).data("id");

        $.get(urlBase,
            {
                option: "categoria_detalle_json",
                id: id
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                $("#tituloModalCategoria").text("Editar Categoría");
                $("#idCategoria").val(data.id_categoria);
                $("#nombreCategoria").val(data.nombre);
                $("#descripcionCategoria").val(data.descripcion);

                let modal = new bootstrap.Modal(document.getElementById("modalCategoria"));
                modal.show();
            }
        );
    });

    $(document).on("submit", "#formCategoria", function (event) {
        event.preventDefault();

        let id = $("#idCategoria").val();
        let option = id === "" ? "crear_categoria" : "editar_categoria";

        $.post(urlBase,
            {
                option: option,
                id_categoria: id,
                nombre: $("#nombreCategoria").val(),
                descripcion: $("#descripcionCategoria").val()
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                alert(data.message);

                if (data.response === "00") {
                    bootstrap.Modal.getInstance(document.getElementById("modalCategoria")).hide();
                    cargarCategoriasAdmin();
                }
            }
        );
    });

    $(document).on("click", ".btnEliminarCategoria", function () {
        let id = $(this).data("id");

        if (confirm("¿Desea eliminar esta categoría?")) {
            $.post(urlBase,
                {
                    option: "eliminar_categoria",
                    id_categoria: id
                },
                function (data, status) {

                    if (typeof data === "string") {
                        data = JSON.parse(data);
                    }

                    alert(data.message);

                    if (data.response === "00") {
                        cargarCategoriasAdmin();
                    }
                }
            );
        }
    });

    $(document).on("click", ".btnVerDetallePedido", function () {
        let id = $(this).data("id");

        $.get(urlBase,
            {
                option: "pedido_detalle_json",
                id_pedido: id
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                let pedido = data.pedido;
                let detalle = data.detalle;

                let info = `
                <p><strong>Pedido:</strong> #${pedido.id_pedido}</p>
                <p><strong>Cliente:</strong> ${pedido.nombre} ${pedido.apellidos}</p>
                <p><strong>Correo:</strong> ${pedido.email}</p>
                <p><strong>Fecha:</strong> ${pedido.fecha}</p>
                <p><strong>Estado:</strong> ${pedido.estado}</p>
                <p><strong>Total:</strong> ₡${pedido.total}</p>
            `;

                let html = "";

                detalle.forEach(function (item) {
                    html += `
                    <tr>
                        <td>${item.producto}</td>
                        <td>${item.cantidad}</td>
                        <td>₡${item.precio_unitario}</td>
                        <td>₡${item.subtotal}</td>
                    </tr>
                `;
                });

                $("#infoPedido").html(info);
                $("#tablaDetallePedido").html(html);

                let modal = new bootstrap.Modal(document.getElementById("modalDetallePedido"));
                modal.show();
            }
        );
    });

    $(document).on("change", ".selectEstadoPedido", function () {
        let id = $(this).data("id");
        let estado = $(this).val();

        $.post(urlBase,
            {
                option: "cambiar_estado_pedido",
                id_pedido: id,
                estado: estado
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                alert(data.message);

                if (data.response === "00") {
                    cargarPedidosAdmin();
                    cargarDashboardAdmin();
                }
            }
        );
    });

    function cargarRolesSelect() {
        $.get(urlBase,
            {
                option: "admin_roles_json"
            },
            function (data, status) {
                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                let html = "";

                data.forEach(function (role) {
                    html += `
                    <option value="${role.id_rol}">
                        ${role.nombre}
                    </option>
                `;
                });

                $("#rolUsuario").html(html);
            }
        );
    }

    $(document).on("click", "#btnNuevoUsuario", function () {
        $("#tituloModalUsuario").text("Nuevo Usuario");
        $("#idUsuario").val("");
        $("#nombreUsuario").val("");
        $("#apellidosUsuario").val("");
        $("#emailUsuario").val("");
        $("#passwordUsuario").val("");
        $("#estadoUsuario").val("activo");
        $("#grupoPasswordUsuario").show();

        cargarRolesSelect();

        let modal = new bootstrap.Modal(document.getElementById("modalUsuario"));
        modal.show();
    });

    $(document).on("click", ".btnEditarUsuario", function () {
        let id = $(this).data("id");

        $.get(urlBase,
            {
                option: "usuario_detalle_json",
                id: id
            },
            function (data, status) {
                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                $("#tituloModalUsuario").text("Editar Usuario");
                $("#idUsuario").val(data.id_usuario);
                $("#nombreUsuario").val(data.nombre);
                $("#apellidosUsuario").val(data.apellidos);
                $("#emailUsuario").val(data.email);
                $("#estadoUsuario").val(data.estado);
                $("#grupoPasswordUsuario").hide();

                cargarRolesSelect();

                setTimeout(function () {
                    $("#rolUsuario").val(data.id_rol);
                }, 200);

                let modal = new bootstrap.Modal(document.getElementById("modalUsuario"));
                modal.show();
            }
        );
    });

    $(document).on("submit", "#formUsuario", function (event) {
        event.preventDefault();

        let id = $("#idUsuario").val();
        let option = id === "" ? "crear_usuario" : "editar_usuario";

        $.post(urlBase,
            {
                option: option,
                id_usuario: id,
                nombre: $("#nombreUsuario").val(),
                apellidos: $("#apellidosUsuario").val(),
                email: $("#emailUsuario").val(),
                password: $("#passwordUsuario").val(),
                id_rol: $("#rolUsuario").val(),
                estado: $("#estadoUsuario").val()
            },
            function (data, status) {
                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                alert(data.message);

                if (data.response === "00") {
                    bootstrap.Modal.getInstance(document.getElementById("modalUsuario")).hide();
                    cargarUsuariosAdmin();
                    cargarDashboardAdmin();
                }
            }
        );
    });

    $(document).on("click", ".btnEliminarUsuario", function () {
        let id = $(this).data("id");

        if (confirm("¿Desea eliminar este usuario?")) {
            $.post(urlBase,
                {
                    option: "eliminar_usuario",
                    id_usuario: id
                },
                function (data, status) {
                    if (typeof data === "string") {
                        data = JSON.parse(data);
                    }

                    alert(data.message);

                    if (data.response === "00") {
                        cargarUsuariosAdmin();
                        cargarDashboardAdmin();
                    }
                }
            );
        }
    });

    $(document).on("click", "#btnNuevoRol", function () {
        $("#tituloModalRol").text("Nuevo Rol");
        $("#idRol").val("");
        $("#nombreRol").val("");
        $("#descripcionRol").val("");

        let modal = new bootstrap.Modal(document.getElementById("modalRol"));
        modal.show();
    });

    $(document).on("click", ".btnEditarRol", function () {
        let id = $(this).data("id");

        $.get(urlBase,
            {
                option: "rol_detalle_json",
                id: id
            },
            function (data, status) {
                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                $("#tituloModalRol").text("Editar Rol");
                $("#idRol").val(data.id_rol);
                $("#nombreRol").val(data.nombre);
                $("#descripcionRol").val(data.descripcion);

                let modal = new bootstrap.Modal(document.getElementById("modalRol"));
                modal.show();
            }
        );
    });

    $(document).on("submit", "#formRol", function (event) {
        event.preventDefault();

        let id = $("#idRol").val();
        let option = id === "" ? "crear_rol" : "editar_rol";

        $.post(urlBase,
            {
                option: option,
                id_rol: id,
                nombre: $("#nombreRol").val(),
                descripcion: $("#descripcionRol").val()
            },
            function (data, status) {
                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                alert(data.message);

                if (data.response === "00") {
                    bootstrap.Modal.getInstance(document.getElementById("modalRol")).hide();
                    cargarRolesAdmin();
                }
            }
        );
    });

    $(document).on("click", ".btnEliminarRol", function () {
        let id = $(this).data("id");

        if (confirm("¿Desea eliminar este rol?")) {
            $.post(urlBase,
                {
                    option: "eliminar_rol",
                    id_rol: id
                },
                function (data, status) {
                    if (typeof data === "string") {
                        data = JSON.parse(data);
                    }

                    alert(data.message);

                    if (data.response === "00") {
                        cargarRolesAdmin();
                    }
                }
            );
        }
    });

    $(".btnAdminMenu").on("click", function (event) {
        event.preventDefault();

        let option = $(this).data("option");
        cargarVista(option);
    });

});