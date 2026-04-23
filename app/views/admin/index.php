<!DOCTYPE html>
<html lang="es">

<?php require_once './app/views/fragments/head.php'; ?>

<body>

    <?php require_once './app/views/fragments/header.php'; ?>

    <section class="container-fluid">
        <div class="row min-vh-100">

            <aside class="col-md-3 col-lg-2 bg-dark text-white p-4">
                <h4 class="mb-4">Panel Admin</h4>

                <ul class="listaPanel">
                    <li><a href="#" class="admin-link" data-option="admin_dashboard_view">Dashboard</a></li>
                    <li><a href="#" class="admin-link" data-option="admin_productos_view">Productos</a></li>
                    <li><a href="#" class="admin-link" data-option="admin_categorias_view">Categorías</a></li>
                    <li><a href="#" class="admin-link" data-option="admin_pedidos_view">Pedidos</a></li>
                    <li><a href="#" class="admin-link" data-option="admin_usuarios_view">Usuarios</a></li>
                    <li><a href="#" class="admin-link" data-option="admin_roles_view">Roles</a></li>
                </ul>
            </aside>

            <main class="col-md-9 col-lg-10 p-4">
                <div id="adminContent">
                    <div class="text-center py-5">
                        <div class="spinner-border" role="status"></div>
                        <p class="mt-3">Cargando panel...</p>
                    </div>
                </div>
            </main>

        </div>
    </section>

    <div class="modal fade" id="modalPedidoDetalle" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle del Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="pedidoDetalleContenido"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUsuarioEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditarUsuario">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="edit_id_usuario" name="id_usuario">

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="edit_apellidos" name="apellidos">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo</label>
                            <input type="email" class="form-control" id="edit_email" name="email">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once './app/views/fragments/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/admin.js"></script>
</body>

</html>