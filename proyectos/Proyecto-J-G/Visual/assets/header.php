
<nav class="navbar navbar-expand-lg bg-body-tertiary position-relative" style="background-color: #f8f9fa;">
  <div class="container-fluid">

    <!-- Logo del pollo -->
    <a class="navbar-brand p-0 m-0" href="<?=BASE_URL?>">
      <img src="http://localhost/Proyecto-J-G/Media/img/Logo_JyG.jpg" alt="Logo" style="height: 120px;">
    </a>

    <!-- Botón menú móvil -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Buscador centrado -->
    <div class="position-absolute top-45 start-50 translate-middle-x" style="z-index: 1000;">
      <form class="d-flex" role="search" action="<?= BASE_URL ?>/search" method="get">
        <input class="form-control me-2" type="search" name="search" placeholder="Buscar producto..." aria-label="Buscar">
        <button class="btn btn-outline-success" type="submit">🔍</button>
      </form>
    </div>

    <!-- Enlaces derecha -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
      <ul class="navbar-nav mb-2 mb-lg-0 text-end">

        <?php if (isset($_SESSION['usuario'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="#">👤 Mi cuenta (<?= $_SESSION['usuario']['nombre_usuario'] ?>)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=BASE_URL?>/Controller/cerrarSesion.php">🚪 Cerrar sesión</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL?>/login">🔐 Iniciar sesión</a>
          </li>
        <?php endif; ?>

        <li class="nav-item">
          <!-- <a class="nav-link" href="Visual/Cart/Carrito.php">🛒 Carrito</a> -->
          <a class="nav-link" href="<?=BASE_URL?>/Visual/Cart/Carrito">🛒 Carrito</a>
        </li>

      </ul>
    </div>


  </div>
</nav>