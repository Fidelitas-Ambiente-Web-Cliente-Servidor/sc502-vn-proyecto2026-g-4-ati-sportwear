<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Categorías</h2>
        <p>Administración de categorías del catálogo.</p>
    </div>

    <button class="btn btn-dark" id="btnNuevaCategoria">
        Nueva Categoría
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

        <tbody id="tablaCategoriasAdmin"></tbody>
    </table>
</div>

<div class="modal fade" id="modalCategoria" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formCategoria">

                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalCategoria">Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="idCategoria">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreCategoria">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionCategoria"></textarea>
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