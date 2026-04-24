$(function () {

    window.actualizarBadgeCarrito = function () {

        $.get("index.php",
            {
                option: "carrito_json"
            },
            function (data, status) {

                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

                let cantidad = 0;

                if (data.response === "00") {
                    cantidad = data.data.length;
                }

                $("#badgeCarrito").text(cantidad);

                if (cantidad > 0) {
                    $("#badgeCarrito").addClass("badge-carrito-activo");
                } else {
                    $("#badgeCarrito").removeClass("badge-carrito-activo");
                }
            }
        );
    };

    actualizarBadgeCarrito();

});