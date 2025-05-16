<nav>
    <?php if (isset($_SESSION["rol"])): ?>
        <?php if ($_SESSION["rol"] == "1"): ?>
            <ul>
                <li><a href="tabcontactos.php" class="menu">CRUD contactos</a></li>
                <li><a href="tabVC.php" class="menu">VER contactos</a></li>
                <li><a href="logout.php" class="menu">Cerrar Sesión</a></li>
            </ul>
        <?php elseif ($_SESSION["rol"] == "2"): ?>
            <ul>
                <li><a href="tabVC.php" class="menu">VER contactos</a></li>
                <li><a href="logout.php" class="menu">Cerrar Sesión</a></li>
            </ul>
        <?php endif; ?>
    <?php else: ?>
        <ul>
            <li><a href="index.php" class="menu">Iniciar Sesión</a></li>
        </ul>
    <?php endif; ?>
</nav>
n