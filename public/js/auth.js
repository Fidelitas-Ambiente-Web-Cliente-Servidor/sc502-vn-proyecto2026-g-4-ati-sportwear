$(function () {

    let formLogin = $("#formLogin");
    const urlBase = "index.php";

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
                }
            );
        }
    });

});