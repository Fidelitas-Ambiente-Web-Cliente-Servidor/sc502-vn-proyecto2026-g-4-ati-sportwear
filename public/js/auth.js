$(function () {

    const urlBase = "index.php";

    let formLogin = $("#formLogin");
    let formRegister = $("#formRegister");

    formLogin.on("submit", function (event) {
        event.preventDefault();

        let email = $("#email");
        let password = $("#password");

        if (email.val() === "" || password.val() === "") {
            alert("Debe completar todos los campos");
        } else {
            $.post(urlBase,
                {
                    email: email.val(),
                    password: password.val(),
                    option: "login"
                },
                function (data, status) {
                    data = JSON.parse(data);

                    if (data.response === "00") {
                        if (data.rol === "admin") {
                            window.location = "index.php?page=admin";
                        } else {
                            window.location = "index.php?page=home";
                        }
                    } else {
                        alert(data.message);
                    }
                });
        }
    });

    formRegister.on("submit", function (event) {
        event.preventDefault();

        let nombre = $("#nombre");
        let apellidos = $("#apellidos");
        let email = $("#emailRegister");
        let password = $("#passwordRegister");

        if (nombre.val() === "" || apellidos.val() === "" || email.val() === "" || password.val() === "") {
            alert("Debe completar todos los campos");
        } else {
            $.post(urlBase,
                {
                    nombre: nombre.val(),
                    apellidos: apellidos.val(),
                    email: email.val(),
                    password: password.val(),
                    option: "register_user"
                },
                function (data, status) {
                    data = JSON.parse(data);

                    if (data.response === "00") {
                        alert(data.message);
                        window.location = "index.php?page=login";
                    } else {
                        alert(data.message);
                    }
                });
        }
    });

});