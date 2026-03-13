<!DOCTYPE html>
<html lang="es">

<?php include "../fragmentos/head.php"; ?>

<body>

    <?php include "../fragmentos/header.php"; ?>

    <section class="container d-flex justify-content-center align-items-center" style="min-height:70vh;">

        <div class="col-md-5">

            <h2 class="text-center mb-4">Iniciar sesión</h2>

            <form>

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" placeholder="correo@ejemplo.com">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control">
                </div>

                <div class="d-grid mb-3">
                    <a class="btn btn-dark" href="/sc502-vn-proyecto2026-g-4-ati-sportwear/admin/index.php">
                        Ingresar (Demo)
                    </a>
                </div>

                <p class="text-center">
                    ¿No tienes cuenta?
                    <a href="/sc502-vn-proyecto2026-g-4-ati-sportwear/login/registro.php">Registrarse</a>
                </p>

            </form>

        </div>

    </section>

    <?php include "../fragmentos/footer.php"; ?>

</body>

</html>