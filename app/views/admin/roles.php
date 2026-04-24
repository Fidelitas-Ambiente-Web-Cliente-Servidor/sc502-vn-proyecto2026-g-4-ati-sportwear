<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Roles</h2>
        <p>Administración de roles del sistema.</p>
    </div>

    <button class="btn btn-dark" id="btnNuevoRol">
        Nuevo Rol
    </button>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody id="tablaRolesAdmin"></tbody>
    </table>
</div>

<div class="modal fade" id="modalRol" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formRol">

                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalRol">Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="idRol">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreRol">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionRol"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark">Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>