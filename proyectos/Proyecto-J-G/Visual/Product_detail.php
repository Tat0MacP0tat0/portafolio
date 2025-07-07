<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Detalle del producto</title>
<!-- --------------------------------------- intocable --------------------------------------- -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<!--  -------------------------------------------------------------------------------------   -->
  <style>

    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }

    .navbar {
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
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

    /* body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }
    .product-img {
      max-height: 400px;
      object-fit: contain;
    }
    .quantity-control input {
      width: 60px;
      text-align: center;
    } */

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

<!-- Detalle del producto -->
<div class="container my-5">
<?php
foreach ($detailProducto as $detprod):
?>

  <div class="row align-items-center">
    <div class="col-md-6 text-center mb-4 mb-md-0">
      <img src="<?= htmlspecialchars($detprod['imagen_url']) ?>" class="img-fluid product-img" alt="Producto">
    </div>
    <div class="col-md-6">
      <h3 class="fw-bold"><?= htmlspecialchars($detprod['nombre']) ?></h3>
      <p><?= nl2br(htmlspecialchars($detprod['descripcion'])) ?></p>
      <p class="fs-5 fw-semibold">S/ <?= number_format($detprod['precio_producto'], 2) ?> x <?= htmlspecialchars($detprod['unidad_producto']) ?></p>
      
    
    <form action="<?=BASE_URL?>/Carrito/Agregar" method="POST">
      <div class="d-flex align-items-center mb-3 quantity-control">
        <!-- $_SESSION[id_usuario] -->
          <button type ="button" class="btn btn-outline-secondary" id="decrease">-</button>
            <input type="hidden" name="id_producto" id="id_oculto" value="<?= $detprod['id_producto'] ?>" readonly>
            <input type="text" name="cantidad" id="quantity" class="form-control mx-2" value="1" readonly>
          <button type ="button" class="btn btn-outline-secondary" id="increase">+</button>
        </div>
          <button type="submit" class="btn btn-primary w-100" name="btn_agregar_a_carrito">Agregar al carrito 🛒</button> 
      </div>
    </form> 

    

    <?php endforeach; ?>
      <?php if (empty($detailProducto)): ?>
        <li>No hay productos disponibles. :C </li>
      <?php endif; ?>
  </div>
</div>






<!-- 🌐 Footer profesional -->
  <?php include BASE_PATH . '/Visual/assets/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('increase').addEventListener('click', function() {
  let qty = document.getElementById('quantity');
  qty.value = parseInt(qty.value) + 1;
});

document.getElementById('decrease').addEventListener('click', function() {
  let qty = document.getElementById('quantity');
  if (parseInt(qty.value) > 1) {
    qty.value = parseInt(qty.value) - 1;
  }
});
</script>

</body>
</html> 


