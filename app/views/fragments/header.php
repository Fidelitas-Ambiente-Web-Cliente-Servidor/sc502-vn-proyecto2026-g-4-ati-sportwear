<header class="border-bottom">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center py-3">

            <div class="logo d-flex align-items-center gap-2">
                <a href="index.php?page=home">
                    <img src="public/img/ati_negro.png" height="40">
                    <strong>ATI SPORTWEAR</strong>
                </a>
            </div>

            <nav class="d-flex align-items-center gap-3">

                <a href="index.php?page=home">Inicio</a>
                <a href="index.php?page=catalogo">Catálogo</a>

                <?php if (isset($_SESSION['user'])): ?>

                    <?php if ($_SESSION['user']['rol'] == 'admin'): ?>
                        <a href="index.php?page=admin">Panel Admin</a>
                    <?php else: ?>
                        <a href="index.php?page=mis_pedidos">
                            <i class="bi bi-bag"></i>
                            Mis pedidos
                        </a>
                    <?php endif; ?>

                    <a href="index.php?page=carrito" class="link-carrito">
                        <i class="bi bi-cart"></i>
                        Carrito
                        <span id="badgeCarrito" class="badge-carrito">0</span>
                    </a>

                    <span class="usuario-navbar">
                        <i class="bi bi-person-circle"></i>
                        <?php echo $_SESSION['user']['nombre']; ?>
                    </span>

                    <a href="index.php?option=logout">Cerrar sesión</a>

                <?php else: ?>

                    <a href="index.php?page=carrito" class="link-carrito">
                        <i class="bi bi-cart"></i>
                        Carrito
                        <span id="badgeCarrito" class="badge-carrito">0</span>
                    </a>

                    <a href="index.php?page=login">
                        <i class="bi bi-person"></i>
                        Login
                    </a>

                <?php endif; ?>

            </nav>

        </div>

    </div>

</header>