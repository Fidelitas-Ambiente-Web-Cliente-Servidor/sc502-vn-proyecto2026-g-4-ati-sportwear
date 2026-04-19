<?php require_once './app/views/fragments/head.php'; ?>

<body>

    <?php require_once './app/views/fragments/header.php'; ?>

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card shadow-sm">
                    <div class="card-body p-4">

                        <h2 class="text-center mb-4">Iniciar Sesión</h2>

                        <form id="formLogin">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Ingresar</button>
                            </div>
                        </form>

                        <p class="text-center mt-3 mb-0">
                            ¿No tienes cuenta?
                            <a href="index.php?page=register">Regístrate aquí</a>
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