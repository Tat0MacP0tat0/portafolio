<?php
// session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Catálogo</title>
  <!-- --------------------------------------- intocable --------------------------------------- -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <!--  ---------------------------------------------------------------------------------------- -->
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }

    .navbar {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .product-img {
      height: 180px;
      object-fit: contain;
      padding: 1rem;
    }

    .product-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .product-card:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .badge-top-left {
      position: absolute;
      top: 0.5rem;
      left: 0.5rem;
    }

    .search-bar {
      max-width: 500px;
      width: 100%;
    }
  </style>
</head>

<body>
  
<!-- header -->
  <?php include BASE_PATH . '/Visual/assets/header.php'; ?>

  <!-- 📂 Menú de categorías -->
  <div class="nav justify-content-center flex-wrap gap-2">
    <a class="btn btn-outline-primary btn-sm <?= !$categoria ? 'active' : '' ?>" href="<?= BASE_URL ?>">Todo</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'pollos' ? 'active' : '' ?>" href="<?= BASE_URL ?>/producto?categoria=pollos">Pollo</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Pavo' ? 'active' : '' ?>" href="<?= BASE_URL ?>/producto?categoria=Pavo">Pavo</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Chancho' ? 'active' : '' ?>" href="<?= BASE_URL ?>/producto?categoria=Chancho">Chancho</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Embutidos' ? 'active' : '' ?>" href="<?= BASE_URL ?>/producto?categoria=Embutidos">Embutidos</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Abarrotes' ? 'active' : '' ?>" href="<?= BASE_URL ?>/producto?categoria=Abarrotes">Abarrotes</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Snacks' ? 'active' : '' ?>" href="<?= BASE_URL ?>/producto?categoria=Snacks">Snacks</a>
  </div>

  <!-- 🛒 Productos -->
  <div class="container py-5">
    <div class="row g-4">
      
      <?php foreach ($productos as $producto): ?>

        <div class="col-6 col-md-4 col-lg-3 d-flex">
          <div class="card product-card position-relative h-100 w-100 d-flex flex-column justify-content-between">
            <span class="badge bg-danger badge-top-left">Nuevo</span>
            <img src="<?= htmlspecialchars($producto['imagen_url']) ?>" class="card-img-top product-img" alt="Producto">
            <div class="card-body text-center d-flex flex-column justify-content-between">
              <div>
                <h6 class="card-title fw-semibold"><?= htmlspecialchars($producto['nombre']) ?></h6>
                <p class="text-muted small mb-2">
                  S/ <?= number_format($producto['precio_producto'], 2) ?> x <?= htmlspecialchars($producto['unidad_producto']) ?>
                </p>
              </div>
              <!-- <button class="btn btn-outline-primary btn-sm w-100 mt-2">Agregar 🛒</button> -->
              <a href="<?= BASE_URL ?>/Visual/Product_detail?id=<?= $producto['id_producto'] ?>" class="btn btn-outline-primary btn-sm w-100 mt-2">Ver detalle 🛒</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if (empty($productos)): ?>
        <li>No hay productos disponibles. :C </li>
      <?php endif; ?>
    </div>
  </div>

  <!-- 🌐 Footer profesional -->
  <?php include BASE_PATH . '/Visual/assets/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>