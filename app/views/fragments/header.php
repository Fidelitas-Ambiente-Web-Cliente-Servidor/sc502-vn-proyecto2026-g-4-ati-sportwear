<header class="border-bottom">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center py-3">

            <div class="logo d-flex align-items-center gap-2">
                <a href="index.php?page=home">
                    <img src="public/img/ati-negro.png" height="40">
                    <strong>ATI SPORTWEAR</strong>
                </a>
            </div>

            <nav class="d-flex gap-3">

                <a href="index.php?page=home">Inicio</a>
                <a href="index.php?page=catalogo">Catálogo</a>
                <a href="index.php?page=carrito">
                    <i class="bi bi-cart"></i>
                    Carrito
                </a>

                <?php if (isset($_SESSION['user'])): ?>

                    <?php if ($_SESSION['user']['rol'] == 'admin'): ?>
                        <a href="index.php?page=admin">Panel Admin</a>
                    <?php endif; ?>

                    <span>
                        <i class="bi bi-person"></i>
                        <?php echo $_SESSION['user']['nombre']; ?>
                    </span>

                    <a href="index.php?option=logout">Cerrar sesión</a>

                <?php else: ?>

                    <a href="index.php?page=login">
                        <i class="bi bi-person"></i>
                        Login
                    </a>

                <?php endif; ?>

            </nav>

        </div>

    </div>

</header>