<!--Para esta vista se utilizó apoyo de IA -->

<div class="mb-4">
    <h2>Dashboard</h2>
    <p>Resumen general del sistema.</p>
</div>

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5>Usuarios</h5>
                <h2 id="cardUsuarios">0</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5>Productos</h5>
                <h2 id="cardProductos">0</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5>Categorías</h5>
                <h2 id="cardCategorias">0</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5>Pedidos</h5>
                <h2 id="cardPedidos">0</h2>
            </div>
        </div>
    </div>

</div>

<div class="row g-4">

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Pedidos por estado</h5>

                <p class="mb-1">Enviados: <strong id="cardEnviados">0</strong></p>
                <div class="progress mb-3">
                    <div id="barraEnviados" class="progress-bar bg-dark" style="width: 0%"></div>
                </div>

                <p class="mb-1">Procesando: <strong id="cardProcesando">0</strong></p>
                <div class="progress mb-3">
                    <div id="barraProcesando" class="progress-bar bg-secondary" style="width: 0%"></div>
                </div>

                <p class="mb-1">Entregados: <strong id="cardEntregados">0</strong></p>
                <div class="progress mb-3">
                    <div id="barraEntregados" class="progress-bar bg-success" style="width: 0%"></div>
                </div>

                <p class="mb-1">Cancelados: <strong id="cardCancelados">0</strong></p>
                <div class="progress">
                    <div id="barraCancelados" class="progress-bar bg-danger" style="width: 0%"></div>
                </div>

            </div>
        </div>
    </div>

</div>