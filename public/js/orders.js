$(function () {

    const urlBase = "index.php";
    let contenedor = $("#contenedorMisPedidos");

    function parseData(data) {
        if (typeof data === "string") {
            data = JSON.parse(data);
        }

        return data;
    }

    function cargarMisPedidos() {
        $.get(urlBase,
            {
                option: "mis_pedidos_json"
            },
            function (data, status) {

                data = parseData(data);

                let html = "";

                if (data.response === "00" && data.data.length > 0) {

                    html += `
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Pedido</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                    `;

                    data.data.forEach(function (order) {
                        html += `
                            <tr>
                                <td>#${order.id_pedido}</td>
                                <td>${order.fecha}</td>
                                <td>₡${order.total}</td>
                                <td>${order.estado}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-dark btnVerDetalleMiPedido" data-id="${order.id_pedido}">
                                        Ver detalle
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    html += `
                                </tbody>
                            </table>
                        </div>
                    `;

                } else {
                    html = `<p>No tienes pedidos registrados.</p>`;
                }

                contenedor.html(html);
            }
        );
    }

    $(document).on("click", ".btnVerDetalleMiPedido", function () {
        let id = $(this).data("id");

        $.get(urlBase,
            {
                option: "mi_pedido_detalle_json",
                id_pedido: id
            },
            function (data, status) {

                data = parseData(data);

                let html = "";

                if (data.response === "00" && data.data.length > 0) {

                    data.data.forEach(function (item) {
                        html += `
                            <tr>
                                <td>${item.producto}</td>
                                <td>${item.cantidad}</td>
                                <td>₡${item.precio_unitario}</td>
                                <td>₡${item.subtotal}</td>
                            </tr>
                        `;
                    });

                } else {
                    html = `
                        <tr>
                            <td colspan="4">No hay detalle para este pedido.</td>
                        </tr>
                    `;
                }

                $("#tablaDetalleMiPedido").html(html);

                let modal = new bootstrap.Modal(document.getElementById("modalDetalleMiPedido"));
                modal.show();
            }
        );
    });

    cargarMisPedidos();

});