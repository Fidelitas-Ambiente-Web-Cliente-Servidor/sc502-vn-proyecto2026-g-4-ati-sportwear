<!DOCTYPE html>
<html lang="es">

<?php include "../fragmentos/head.php"; ?>

<body>

    <?php include "../fragmentos/header.php"; ?>

    <section class="container d-flex justify-content-center align-items-center" style="min-height:70vh;">

        <div class="col-md-6">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">Editar perfil</h2>

                <form>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="Ricardo">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" value="correo@ejemplo.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" placeholder="Opcional">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="d-grid gap-2">

                        <button class="btn btn-dark">
                            Guardar cambios
                        </button>

                        <a class="btn btn-outline-dark" href="/sc502-vn-proyecto2026-g-4-ati-sportwear/index.php">
                            Cancelar
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </section>

    <?php include "../fragmentos/footer.php"; ?>

</body>

</html>