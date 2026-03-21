<!DOCTYPE html>
<html lang="es">

<?php include "../fragmentos/head.php"; ?>

<body>

    <?php include "../fragmentos/header.php"; ?>

    <section class="container d-flex justify-content-center align-items-center" style="min-height:70vh;">

        <div class="col-md-6">

            <h2 class="text-center mb-4">Crear cuenta</h2>

            <form>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control">
                </div>

                <div class="d-grid mb-3">
                    <button class="btn btn-dark">Registrarse</button>
                </div>

                <p class="text-center">
                    ¿Ya tienes cuenta?
                    <a href="/sc502-vn-proyecto2026-g-4-ati-sportwear/login/login.php">Iniciar sesión</a>
                </p>

            </form>

        </div>

    </section>

    <?php include "../fragmentos/footer.php"; ?>

</body>

</html>