<?php require_once './app/views/fragments/head.php'; ?>

<body>

    <?php require_once './app/views/fragments/header.php'; ?>

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card shadow-sm">
                    <div class="card-body p-4">

                        <h2 class="text-center mb-4">Registro de Usuario</h2>

                        <form id="formRegister">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>

                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos">
                            </div>

                            <div class="mb-3">
                                <label for="emailRegister" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="emailRegister" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="passwordRegister" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="passwordRegister" name="password">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Registrarse</button>
                            </div>
                        </form>

                        <p class="text-center mt-3 mb-0">
                            ¿Ya tienes cuenta?
                            <a href="index.php?page=login">Inicia sesión aquí</a>
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php require_once './app/views/fragments/footer.php'; ?>
    <script src="public/js/auth.js"></script>

</body>

</html>