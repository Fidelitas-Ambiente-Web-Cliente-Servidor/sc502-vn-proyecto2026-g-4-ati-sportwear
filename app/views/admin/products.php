<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Productos</h2>
        <p>Administración de productos del catálogo.</p>
    </div>

    <button class="btn btn-dark" id="btnNuevoProducto">
        Nuevo Producto
    </button>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody id="tablaProductosAdmin"></tbody>
    </table>
</div>

<div class="modal fade" id="modalProducto" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="formProducto">

                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalProducto">Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="idProducto">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreProducto">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionProducto"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precioProducto">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidadProducto">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="text" class="form-control" id="imagenProducto" placeholder="ejemplo.jpg">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" id="categoriaProducto"></select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" id="estadoProducto">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="agotado">Agotado</option>
                        </select>
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