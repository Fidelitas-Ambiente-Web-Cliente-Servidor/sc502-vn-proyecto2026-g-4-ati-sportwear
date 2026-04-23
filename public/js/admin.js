$(function () {
    const urlBase = "index.php";

    const modalPedido = new bootstrap.Modal(document.getElementById("modalPedidoDetalle"));
    const modalUsuario = new bootstrap.Modal(document.getElementById("modalUsuarioEditar"));

    cargarVistaAdmin("admin_dashboard_view");

    $(document).on("click", ".admin-link", function (e) {
        e.preventDefault();
        const option = $(this).data("option");
        cargarVistaAdmin(option);
    });

    function cargarVistaAdmin(option) {
        $("#adminContent").html(`
            <div class="text-center py-5">
                <div class="spinner-border" role="status"></div>
                <p class="mt-3">Cargando información...</p>
            </div>
        `);

        $.post(urlBase, { option: option }, function (html) {
            $("#adminContent").html(html);

            if (option === "admin_dashboard_view") {
                cargarDashboard();
            }

            if (option === "admin_pedidos_view") {
                cargarPedidos();
            }

            if (option === "admin_usuarios_view") {
                cargarUsuarios();
            }
        });
    }

    function cargarDashboard() {
        $.post(urlBase, { option: "dashboard_json" }, function (resp) {
            const data = JSON.parse(resp);

            if (data.response === "00") {
                $("#cardUsuarios").text(data.data.usuarios);
                $("#cardPedidos").text(data.data.pedidos);
                $("#cardProcesando").text(data.data.procesando);
                $("#cardCancelados").text(data.data.cancelados);
            }
        });
    }

    function cargarPedidos() {
        $.post(urlBase, { option: "admin_pedidos_json" }, function (resp) {
            const data = JSON.parse(resp);
            let html = "";

            if (data.response === "00" && data.data.length > 0) {
                data.data.forEach(function (pedido) {
                    html += `
                        <tr>
                            <td>${pedido.id_pedido}</td>
                            <td>${pedido.nombre} ${pedido.apellidos}</td>
                            <td>${pedido.email}</td>
                            <td>${pedido.fecha}</td>
                            <td>₡${parseFloat(pedido.total).toFixed(2)}</td>
                            <td><span class="badge bg-secondary">${pedido.estado}</span></td>
                            <td class="d-flex flex-wrap gap-2">
                                <button class="btn btn-sm btn-primary btn-detalle-pedido" data-id="${pedido.id_pedido}">Ver detalle</button>
                                <button class="btn btn-sm btn-success btn-aceptar-pedido" data-id="${pedido.id_pedido}">Aceptar</button>
                                <button class="btn btn-sm btn-danger btn-rechazar-pedido" data-id="${pedido.id_pedido}">Rechazar</button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = `<tr><td colspan="7" class="text-center">No hay pedidos registrados</td></tr>`;
            }

            $("#tablaPedidos tbody").html(html);
        });
    }

    $(document).on("click", ".btn-detalle-pedido", function () {
        const idPedido = $(this).data("id");

        $.post(urlBase, {
            option: "pedido_detalle_json",
            id_pedido: idPedido
        }, function (resp) {
            const data = JSON.parse(resp);

            if (data.response === "00") {
                const pedido = data.pedido;
                const detalle = data.detalle;
                let html = `
                    <div class="mb-3">
                        <p><strong>Pedido:</strong> #${pedido.id_pedido}</p>
                        <p><strong>Cliente:</strong> ${pedido.nombre} ${pedido.apellidos}</p>
                        <p><strong>Correo:</strong> ${pedido.email}</p>
                        <p><strong>Fecha:</strong> ${pedido.fecha}</p>
                        <p><strong>Estado:</strong> ${pedido.estado}</p>
                        <p><strong>Total:</strong> ₡${parseFloat(pedido.total).toFixed(2)}</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                detalle.forEach(function (item) {
                    html += `
                        <tr>
                            <td>${item.producto}</td>
                            <td>${item.cantidad}</td>
                            <td>₡${parseFloat(item.precio_unitario).toFixed(2)}</td>
                            <td>₡${parseFloat(item.subtotal).toFixed(2)}</td>
                        </tr>
                    `;
                });

                html += `
                            </tbody>
                        </table>
                    </div>
                `;

                $("#pedidoDetalleContenido").html(html);
                modalPedido.show();
            } else {
                alert(data.message);
            }
        });
    });

    $(document).on("click", ".btn-aceptar-pedido", function () {
        const idPedido = $(this).data("id");

        if (!confirm("¿Desea aceptar este pedido?")) {
            return;
        }

        $.post(urlBase, {
            option: "cambiar_estado_pedido",
            id_pedido: idPedido,
            estado: "procesando"
        }, function (resp) {
            const data = JSON.parse(resp);
            alert(data.message);

            if (data.response === "00") {
                cargarPedidos();
            }
        });
    });

    $(document).on("click", ".btn-rechazar-pedido", function () {
        const idPedido = $(this).data("id");

        if (!confirm("¿Desea rechazar este pedido?")) {
            return;
        }

        $.post(urlBase, {
            option: "cambiar_estado_pedido",
            id_pedido: idPedido,
            estado: "cancelado"
        }, function (resp) {
            const data = JSON.parse(resp);
            alert(data.message);

            if (data.response === "00") {
                cargarPedidos();
            }
        });
    });

    function cargarUsuarios() {
        $.post(urlBase, { option: "admin_usuarios_json" }, function (resp) {
            const data = JSON.parse(resp);
            let html = "";

            if (data.response === "00" && data.data.length > 0) {
                data.data.forEach(function (user) {
                    html += `
                        <tr>
                            <td>${user.id_usuario}</td>
                            <td>${user.nombre}</td>
                            <td>${user.apellidos}</td>
                            <td>${user.email}</td>
                            <td>${user.rol}</td>
                            <td>
                                <span class="badge ${user.estado === 'activo' ? 'bg-success' : 'bg-danger'}">
                                    ${user.estado}
                                </span>
                            </td>
                            <td class="d-flex flex-wrap gap-2">
                                <button class="btn btn-sm btn-primary btn-editar-usuario" data-id="${user.id_usuario}">
                                    Editar
                                </button>
                                <button class="btn btn-sm btn-warning btn-rol-usuario" data-id="${user.id_usuario}" data-rol="${user.id_rol}">
                                    Cambiar rol
                                </button>
                                <button class="btn btn-sm btn-secondary btn-estado-usuario" data-id="${user.id_usuario}" data-estado="${user.estado}">
                                    Cambiar estado
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = `<tr><td colspan="7" class="text-center">No hay usuarios registrados</td></tr>`;
            }

            $("#tablaUsuarios tbody").html(html);
        });
    }

    $(document).on("click", ".btn-editar-usuario", function () {
        const idUsuario = $(this).data("id");

        $.post(urlBase, {
            option: "usuario_detalle_json",
            id_usuario: idUsuario
        }, function (resp) {
            const data = JSON.parse(resp);

            if (data.response === "00") {
                $("#edit_id_usuario").val(data.user.id_usuario);
                $("#edit_nombre").val(data.user.nombre);
                $("#edit_apellidos").val(data.user.apellidos);
                $("#edit_email").val(data.user.email);

                modalUsuario.show();
            } else {
                alert(data.message);
            }
        });
    });

    $("#formEditarUsuario").on("submit", function (e) {
        e.preventDefault();

        $.post(urlBase, {
            option: "editar_usuario",
            id_usuario: $("#edit_id_usuario").val(),
            nombre: $("#edit_nombre").val(),
            apellidos: $("#edit_apellidos").val(),
            email: $("#edit_email").val()
        }, function (resp) {
            const data = JSON.parse(resp);
            alert(data.message);

            if (data.response === "00") {
                modalUsuario.hide();
                cargarUsuarios();
            }
        });
    });

    $(document).on("click", ".btn-rol-usuario", function () {
        const idUsuario = $(this).data("id");
        const rolActual = parseInt($(this).data("rol"));
        const nuevoRol = rolActual === 1 ? 2 : 1;

        if (!confirm("¿Desea cambiar el rol de este usuario?")) {
            return;
        }

        $.post(urlBase, {
            option: "cambiar_rol_usuario",
            id_usuario: idUsuario,
            id_rol: nuevoRol
        }, function (resp) {
            const data = JSON.parse(resp);
            alert(data.message);

            if (data.response === "00") {
                cargarUsuarios();
            }
        });
    });

    $(document).on("click", ".btn-estado-usuario", function () {
        const idUsuario = $(this).data("id");
        const estadoActual = $(this).data("estado");
        const nuevoEstado = estadoActual === "activo" ? "inactivo" : "activo";

        if (!confirm("¿Desea cambiar el estado de este usuario?")) {
            return;
        }

        $.post(urlBase, {
            option: "cambiar_estado_usuario",
            id_usuario: idUsuario,
            estado: nuevoEstado
        }, function (resp) {
            const data = JSON.parse(resp);
            alert(data.message);

            if (data.response === "00") {
                cargarUsuarios();
            }
        });
    });
});