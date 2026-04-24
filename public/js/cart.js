$(function () {

    const urlBase = "index.php";
    let contenedor = $("#contenidoCarrito");

    function parseData(data) {
        if (typeof data === "string") {
            data = JSON.parse(data);
        }

        return data;
    }

    $(document).on("click", "#btnFinalizarCompra", function () {

        if (confirm("¿Desea finalizar la compra?")) {

            $.post(urlBase,
                {
                    option: "finalizar_compra"
                },
                function (data, status) {

                    data = parseData(data);

                    alert(data.message);

                    if (data.response === "00") {
                        cargarCarrito();

                        if (typeof actualizarBadgeCarrito === "function") {
                            actualizarBadgeCarrito();
                        }

                        window.location = "index.php?page=mis_pedidos";
                    }
                }
            );
        }
    });

    function cargarCarrito() {

        $.get(urlBase,
            {
                option: "carrito_json"
            },
            function (data, status) {

                data = parseData(data);

                let html = "";
                let total = 0;

                if (data.data.length > 0) {

                    html += `
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                    `;

                    data.data.forEach(function (item) {

                        total += parseFloat(item.subtotal);

                        html += `
                            <tr>
                                <td class="d-flex align-items-center gap-3">
                                    <img src="public/img/${item.imagen}" class="imgAdminProducto">
                                    ${item.nombre}
                                </td>

                                <td>₡${item.precio}</td>

                                <td>
                                    <input 
                                        type="number" 
                                        class="form-control inputCantidadCarrito" 
                                        data-id="${item.id_producto}" 
                                        value="${item.cantidad}" 
                                        min="1">
                                </td>

                                <td>₡${item.subtotal}</td>

                                <td>
                                    <button class="btn btn-sm btn-danger btnEliminarCarrito" data-id="${item.id_producto}">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    html += `
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end mt-3">
                            <h4>Total: ₡${total}</h4>

                            <button class="btn btn-danger mt-2" id="btnVaciarCarrito">
                                Vaciar carrito
                            </button>

                            <button class="btn btn-dark mt-2" id="btnFinalizarCompra">
                                Finalizar compra
                            </button>
                        </div>
                    `;

                } else {
                    html = `<p>No hay productos en el carrito.</p>`;
                }

                contenedor.html(html);
            }
        );
    }

    $(document).on("change", ".inputCantidadCarrito", function () {
        let id = $(this).data("id");
        let cantidad = $(this).val();

        $.post(urlBase,
            {
                option: "actualizar_carrito",
                id_producto: id,
                cantidad: cantidad
            },
            function (data, status) {

                data = parseData(data);

                alert(data.message);
                cargarCarrito();

                if (typeof actualizarBadgeCarrito === "function") {
                    actualizarBadgeCarrito();
                }
            }
        );
    });

    $(document).on("click", ".btnEliminarCarrito", function () {
        let id = $(this).data("id");

        if (confirm("¿Desea eliminar este producto del carrito?")) {
            $.post(urlBase,
                {
                    option: "eliminar_producto_carrito",
                    id_producto: id
                },
                function (data, status) {

                    data = parseData(data);

                    alert(data.message);
                    cargarCarrito();

                    if (typeof actualizarBadgeCarrito === "function") {
                        actualizarBadgeCarrito();
                    }
                }
            );
        }
    });

    $(document).on("click", "#btnVaciarCarrito", function () {

        if (confirm("¿Desea vaciar el carrito?")) {

            $.post(urlBase,
                {
                    option: "vaciar_carrito"
                },
                function (data, status) {

                    data = parseData(data);

                    alert(data.message);
                    cargarCarrito();

                    if (typeof actualizarBadgeCarrito === "function") {
                        actualizarBadgeCarrito();
                    }
                }
            );
        }
    });

    cargarCarrito();

});