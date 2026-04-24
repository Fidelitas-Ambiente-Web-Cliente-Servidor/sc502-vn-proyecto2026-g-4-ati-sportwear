$(function () {

    const urlBase = "index.php";
    let contenedorProductos = $("#contenedorProductos");
    let contenedorCategorias = $("#contenedorCategorias");
    let inputBuscar = $("#inputBuscar");

    let search = "";
    let category = "";

    function parseData(data) {
        if (typeof data === "string") {
            data = JSON.parse(data);
        }

        return data;
    }

    function cargarCategorias() {

        $.get(urlBase,
            {
                option: "categorias_json"
            },
            function (data, status) {

                data = parseData(data);

                let html = `<button class="btn btn-outline-dark btnCategoria" data-id="">Todas</button>`;

                if (data.length > 0) {
                    data.forEach(function (categoryItem) {
                        html += `
                            <button class="btn btn-outline-dark btnCategoria" data-id="${categoryItem.id_categoria}">
                                ${categoryItem.nombre}
                            </button>
                        `;
                    });
                }

                contenedorCategorias.html(html);
            }
        );
    }

    function cargarProductos() {

        $.get(urlBase,
            {
                option: "productos_json",
                search: search,
                category: category
            },
            function (data, status) {

                data = parseData(data);

                let html = "";

                if (data.length > 0) {

                    data.forEach(function (product) {
                        let agotado = product.estado === "agotado" || parseInt(product.cantidad) <= 0;

                        html += `
                            <div class="col-md-4 col-lg-3">

                                <div class="producto">

                                    <img src="public/img/${product.imagen}" alt="${product.nombre}">

                                    <h5>${product.nombre}</h5>

                                    <p class="precio">₡${product.precio}</p>

                                    <p>
                                        ${agotado ? "Agotado" : "Disponibles: " + product.cantidad}
                                    </p>

                                    <div class="d-grid gap-2">

                                        <button class="btn btn-outline-dark btn-sm btnVerDetalle" data-id="${product.id_producto}">
                                            Ver detalle
                                        </button>

                                        <button class="btn btn-dark btn-sm btnAgregarCarrito" 
                                            data-id="${product.id_producto}" ${agotado ? "disabled" : ""}>
                                            Agregar al carrito
                                        </button>

                                    </div>

                                </div>

                            </div>
                        `;
                    });

                } else {
                    html = `<p>No hay productos disponibles.</p>`;
                }

                contenedorProductos.html(html);
            }
        );
    }

    cargarCategorias();
    cargarProductos();

    inputBuscar.on("keyup", function () {
        search = inputBuscar.val();
        cargarProductos();
    });

    $(document).on("click", ".btnCategoria", function () {
        category = $(this).data("id");
        cargarProductos();
    });

    $(document).on("click", ".btnVerDetalle", function () {
        let id = $(this).data("id");
        window.location = "index.php?page=producto&id=" + id;
    });

    $(document).on("click", ".btnAgregarCarrito", function () {
        let id = $(this).data("id");

        $.post(urlBase,
            {
                option: "agregar_carrito",
                id_producto: id,
                cantidad: 1
            },
            function (data, status) {

                data = parseData(data);

                alert(data.message);

                if (data.response === "00" && typeof actualizarBadgeCarrito === "function") {
                    actualizarBadgeCarrito();
                }
            }
        );
    });

    $(document).on("click", ".btnAgregarCarritoDetalle", function () {
        let id = $(this).data("id");
        let cantidad = $("#cantidadDetalle").val();

        $.post(urlBase,
            {
                option: "agregar_carrito",
                id_producto: id,
                cantidad: cantidad
            },
            function (data, status) {

                data = parseData(data);

                alert(data.message);

                if (data.response === "00" && typeof actualizarBadgeCarrito === "function") {
                    actualizarBadgeCarrito();
                }
            }
        );
    });

});