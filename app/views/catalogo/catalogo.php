<!DOCTYPE html>
<html lang="es">

<?php include "../fragmentos/head.php"; ?>

<body>

    <!--header-->
    <?php include "../fragmentos/header.php"; ?>

    <!-- BUSCADOR Y FILTROS -->
    <section class="container my-4">

        <div class="row g-3">

            <div class="col-md-6">

                <input type="text" class="form-control" placeholder="Buscar producto">

            </div>

            <div class="col-md-6 d-flex gap-2 flex-wrap">

                <button class="btn btn-outline-dark">Todas</button>
                <button class="btn btn-outline-dark">Camisetas</button>
                <button class="btn btn-outline-dark">Pantalones</button>
                <button class="btn btn-outline-dark">Shorts</button>
                <button class="btn btn-outline-dark">Accesorios</button>

            </div>

        </div>

    </section>


    <!-- CATALOGO -->
    <section class="container">

        <div class="row g-4">

            <!-- PRODUCTOS -->

            <div class="col-md-4 col-lg-3">

                <div class="producto">

                    <img src="../img/camisa_deportiva1.jpeg" alt="Camiseta deportiva">

                    <h5>Camiseta deportiva</h5>

                    <p class="precio">₡12 000</p>

                    <div class="d-grid gap-2">

                        <button class="btn btn-outline-dark btn-sm">Ver detalle</button>
                        <button class="btn btn-dark btn-sm">Agregar al carrito</button>

                    </div>

                </div>

            </div>


            <div class="col-md-4 col-lg-3">

                <div class="producto">

                    <img src="../img/camisa_deportiva2.jpg" alt="Camiseta deportiva">

                    <h5>Camiseta deportiva</h5>

                    <p class="precio">₡12 000</p>

                    <div class="d-grid gap-2">

                        <button class="btn btn-outline-dark btn-sm">Ver detalle</button>
                        <button class="btn btn-dark btn-sm">Agregar al carrito</button>

                    </div>

                </div>

            </div>


            <!-- PRODUCTO 2 -->
            <div class="col-md-4 col-lg-3">

                <div class="producto">

                    <img src="../img/pantaloneta_deportiva.jpeg" alt="pantaloneta deportivo">

                    <h5>pantaloneta deportivo</h5>

                    <p class="precio">₡10 000</p>

                    <div class="d-grid gap-2">

                        <button class="btn btn-outline-dark btn-sm">Ver detalle</button>
                        <button class="btn btn-dark btn-sm">Agregar al carrito</button>

                    </div>

                </div>

            </div>


            <!-- PRODUCTO 3 -->
            <div class="col-md-4 col-lg-3">

                <div class="producto">

                    <img src="../img/gorra1.jpeg" alt="Gorra ">

                    <h5>Gorra </h5>

                    <p class="precio">₡8 000</p>

                    <div class="d-grid gap-2">

                        <button class="btn btn-outline-dark btn-sm">Ver detalle</button>
                        <button class="btn btn-dark btn-sm">Agregar al carrito</button>

                    </div>

                </div>

            </div>


             <div class="col-md-4 col-lg-3">

                <div class="producto">

                    <img src="../img/gorra2.jpeg" alt="Gorra ">

                    <h5>Gorra </h5>

                    <p class="precio">₡8 000</p>

                    <div class="d-grid gap-2">

                        <button class="btn btn-outline-dark btn-sm">Ver detalle</button>
                        <button class="btn btn-dark btn-sm">Agregar al carrito</button>

                    </div>

                </div>

            </div>


            <!-- PRODUCTO 4 -->
            <div class="col-md-4 col-lg-3">

                <div class="producto">

                    <img src="../img/camisa_training1.jpeg" alt="Camiseta">

                    <h5>Camiseta training</h5>

                    <p class="precio">₡14 000</p>

                    <div class="d-grid gap-2">

                        <button class="btn btn-outline-dark btn-sm">Ver detalle</button>
                        <button class="btn btn-dark btn-sm">Agregar al carrito</button>

                    </div>

                </div>

            </div>

            <div class="col-md-4 col-lg-3">

                <div class="producto">

                    <img src="../img/camisa_training2.jpeg" alt="Camiseta training">

                    <h5>Camiseta training</h5>

                    <p class="precio">₡15 000</p>

                    <div class="d-grid gap-2">

                        <button class="btn btn-outline-dark btn-sm">Ver detalle</button>
                        <button class="btn btn-dark btn-sm">Agregar al carrito</button>

                    </div>

                </div>

            </div>


            <div class="col-md-4 col-lg-3">

                <div class="producto">

                    <img src="../img/camisa_training3.jpeg" alt="Camiseta training">

                    <h5>Camiseta training</h5>

                    <p class="precio">₡15 000</p>

                    <div class="d-grid gap-2">

                        <button class="btn btn-outline-dark btn-sm">Ver detalle</button>
                        <button class="btn btn-dark btn-sm">Agregar al carrito</button>

                    </div>

                </div>

            </div>


        </div>

    </section>


    <!-- FOOTER -->
    <?php include "../fragmentos/footer.php"; ?>


</body>

</html>