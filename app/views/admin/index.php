<!DOCTYPE html>
<html lang="es">

<?php require_once './app/views/fragments/head.php'; ?>

<body>

    <?php require_once './app/views/fragments/header.php'; ?>

    <section class="container-fluid">
        <div class="row min-vh-100">

            <aside class="col-md-3 col-lg-2 bg-dark text-white p-4">
                <ul class="listaPanel">
                    <li>
                        <a href="#" class="btnAdminMenu" data-option="admin_dashboard_view">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="btnAdminMenu" data-option="admin_productos_view">Productos</a>
                    </li>
                    <li>
                        <a href="#" class="btnAdminMenu" data-option="admin_categorias_view">Categorías</a>
                    </li>
                    <li>
                        <a href="#" class="btnAdminMenu" data-option="admin_pedidos_view">Pedidos</a>
                    </li>
                    <li>
                        <a href="#" class="btnAdminMenu" data-option="admin_usuarios_view">Usuarios</a>
                    </li>
                    <li>
                        <a href="#" class="btnAdminMenu" data-option="admin_roles_view">Roles</a>
                    </li>
                </ul>
            </aside>

            <main class="col-md-9 col-lg-10 p-4" id="contenidoAdmin">
                <?php require_once './app/views/admin/dashboard.php'; ?>
            </main>

        </div>
    </section>

    <?php require_once './app/views/fragments/footer.php'; ?>
    <script src="public/js/admin.js"></script>
    

</body>

</html>