<!DOCTYPE html>
<html lang="es">

<?php require_once './app/views/fragments/head.php'; ?>

<body>

    <?php require_once './app/views/fragments/header.php'; ?>

    <section class="container-fluid">
        <div class="row min-vh-100">

            <aside class="col-md-3 col-lg-2 bg-dark text-white p-4">
                <ul class="listaPanel">
                    <li class="mb-3">
                        <a href="index.php?page=admin" class="text-white text-decoration-none">Dashboard</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-white text-decoration-none">Productos</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-white text-decoration-none">Categorías</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-white text-decoration-none">Pedidos</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-white text-decoration-none">Usuarios</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-white text-decoration-none">Roles</a>
                    </li>
                </ul>
            </aside>

            <main class="col-md-9 col-lg-10 p-4">
                <h1>Panel de Administración</h1>
                <p>Aquí se mostrará el contenido del módulo seleccionado.</p>
            </main>

        </div>
    </section>

    <?php require_once './app/views/fragments/footer.php'; ?>

</body>

</html>