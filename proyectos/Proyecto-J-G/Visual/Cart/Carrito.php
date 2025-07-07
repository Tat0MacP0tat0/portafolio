<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Carrito de compras</title>
  <!----------------------------------------- intocable ----------------------------------------->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <!--  -------------------------------------------------------------------------------------   -->
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
    
    .quantity-control {
      max-width: 150px;
    }
    
    .resumen-compra {
      position: sticky;
      top: 20px;
    }
  </style>
</head>

<body>

  <!-- header -->
  <?php include BASE_PATH . '/Visual/assets/header.php'; ?>


  <!-- 📂 Menú de categorías -->
  <div class="nav justify-content-center flex-wrap gap-2">
    <a class="btn btn-outline-primary btn-sm <?= !$categoria ? 'active' : '' ?>" href="<?= BASE_URL ?>">Todo</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'pollos' ? 'active' : '' ?>"
      href="<?= BASE_URL ?>/producto?categoria=pollos">Pollo</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Pavo' ? 'active' : '' ?>"
      href="<?= BASE_URL ?>/producto?categoria=Pavo">Pavo</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Chancho' ? 'active' : '' ?>"
      href="<?= BASE_URL ?>/producto?categoria=Chancho">Chancho</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Embutidos' ? 'active' : '' ?>"
      href="<?= BASE_URL ?>/producto?categoria=Embutidos">Embutidos</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Abarrotes' ? 'active' : '' ?>"
      href="<?= BASE_URL ?>/producto?categoria=Abarrotes">Abarrotes</a>
    <a class="btn btn-outline-primary btn-sm <?= $categoria === 'Snacks' ? 'active' : '' ?>"
      href="<?= BASE_URL ?>/producto?categoria=Snacks">Snacks</a>
  </div>

  <div class="container mt-4">
    <div class="row">
      <!-- Columna principal (productos) -->
      <div class="col-lg-8">
        <!-- 🛒 Lista de productos agregados al carrito -->
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Productos en el carrito</h5>
          </div>
          <div class="card-body" id="carrito-productos">
            <?php if (!empty($CrtUsr)): ?>
              <?php foreach ($CrtUsr as $cartUser): ?>
                <div class="row align-items-center border-bottom py-3">
                  <!-- Imagen del producto -->
                  <div class="col-3">
                    <img src="<?= htmlspecialchars($cartUser['imagen_url']) ?>"
                      alt="<?= htmlspecialchars($cartUser['nombre']) ?>" 
                      class="img-fluid product-img">
                  </div>

                  <!-- Detalles del producto -->
                  <div class="col-5">
                    <h6 class="mb-1"><?= htmlspecialchars($cartUser['nombre']) ?></h6>
                    <small class="text-muted"><?= htmlspecialchars($cartUser['descripcion']) ?></small>
                    <p class="mt-2">Precio: S/ <?= number_format($cartUser['precio_producto'], 2) ?></p>
                  </div>

                  <!-- Controles de cantidad -->
                  <div class="col-4">
                    <form action="<?= BASE_URL ?>/carrito/actualizar-cantidad" method="post" class="quantity-control">
                      <input type="hidden" name="id_producto" value="<?= $cartUser['id_producto'] ?>">
                      
                      <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary decrease">-</button>
                        <input type="text" name="cantidad" 
                               class="form-control text-center" 
                               value="<?= $cartUser['cantidad'] ?>" 
                               min="1" max="100" rea>
                        <button type="button" class="btn btn-outline-secondary increase">+</button>
                      </div>
                      
                    </form>
                    
                    <!-- Formulario para eliminar -->
                    <form action="<?= BASE_URL ?>/carrito/eliminar-producto" method="post" class="mt-2 form-eliminar">
                      <!-- <form method="post" class="mt-2 form-eliminar"> -->
                      <input type="hidden" name="id_producto" value="<?= $cartUser['id_producto'] ?>">
                      <button type="submit" class="btn btn-danger btn-sm w-100">Eliminar</button>
                    </form>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-muted text-center mb-0">Tu carrito está vacío.</p>
            <?php endif; ?>
          </div>
        </div>

        <!-- 📍 Dirección y mapa (ocupa todo el ancho) -->
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Dirección de entrega</h5>
          </div>
          <div class="card-body">
            <form class="mb-3">
              <div class="row g-2">
                <div class="col-md-10">
                  <input type="text" id="direccion" class="form-control" placeholder="Ingresa tu dirección">
                </div>
                <div class="col-md-2">
                  <button type="button" class="btn btn-outline-primary w-100" onclick="buscarDireccion()">Buscar</button>
                </div>
              </div>
            </form>
            <div id="mapa" style="width: 100%; height: 300px; border: 1px solid #ccc;"></div>
          </div>
        </div>
      </div>

      <!-- Columna lateral (resumen de compra) -->
      <div class="col-lg-4">
        <div class="card shadow-sm resumen-compra">
          <div class="card-header bg-success text-white">
            <h5 class="mb-0">Resumen de compra</h5>
          </div>
          <div class="card-body">
            <?php if (!empty($CrtUsr)): ?>
              <?php
                $subtotal = 0;
                foreach ($CrtUsr as $item) {
                  $subtotal += $item['precio_producto'] * $item['cantidad'];
                }
              ?>
              <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span>S/ <?= number_format($subtotal, 2) ?></span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span>Envío:</span>
                <span>S/ 0.00</span>
              </div>
              <hr>
              <div class="d-flex justify-content-between fw-bold">
                <span>Total:</span>
                <span>S/ <?= number_format($subtotal, 2) ?></span>
              </div>
              <a href="<?= BASE_URL ?>/checkout" class="btn btn-primary w-100 mt-3">Pagar ahora</a>
            <?php else: ?>
              <p class="text-muted text-center">No hay productos en el carrito</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 🌐 Footer profesional -->
  <?php include BASE_PATH . '/Visual/assets/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<!-- 
  <script>
    // Funcionalidad para los botones de cantidad
    document.querySelectorAll('.increase').forEach(button => {
      button.addEventListener('click', function() {
        const input = this.parentNode.querySelector('input[name="cantidad"]');
        input.value = parseInt(input.value) + 1;
        input.dispatchEvent(new Event('change'));
      });
    });

    document.querySelectorAll('.decrease').forEach(button => {
      button.addEventListener('click', function() {
        const input = this.parentNode.querySelector('input[name="cantidad"]');
        if (parseInt(input.value) > 1) {
          input.value = parseInt(input.value) - 1;
          input.dispatchEvent(new Event('change'));
        }
      });
    });

    // Enviar formulario automáticamente al cambiar cantidad
    document.querySelectorAll('input[name="cantidad"]').forEach(input => {
      input.addEventListener('change', function() {
        this.closest('form').submit();
      });
    });

    // Función para el mapa (ejemplo)
    function buscarDireccion() {
      const direccion = document.getElementById('direccion').value;
      alert('Buscando dirección: ' + direccion);
      // Aquí iría la integración con Google Maps API
    }
  </script> -->

  <script>
  document.querySelectorAll('.increase').forEach(button => {
    button.addEventListener('click', function () {
      const input = this.parentNode.querySelector('input[name="cantidad"]');
      let cantidad = parseInt(input.value);
      const id_producto = this.closest('form').querySelector('input[name="id_producto"]').value;

      cantidad++;
      actualizarCantidad(id_producto, cantidad, input);
    });
  });

  document.querySelectorAll('.decrease').forEach(button => {
    button.addEventListener('click', function () {
      const input = this.parentNode.querySelector('input[name="cantidad"]');
      let cantidad = parseInt(input.value);
      const id_producto = this.closest('form').querySelector('input[name="id_producto"]').value;

      if (cantidad > 1) {
        cantidad--;
        actualizarCantidad(id_producto, cantidad, input);
      }
    });
  });

  function actualizarCantidad(id_producto, cantidad, input) {
    fetch('<?= BASE_URL ?>/carrito/actualizar-cantidad', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `id_producto=${id_producto}&cantidad=${cantidad}`
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        input.value = cantidad;
        location.reload(); // Recargar para actualizar resumen total
      } else {
        alert('Error al actualizar cantidad');
      }
    });
  }

  document.querySelectorAll('.form-eliminar').forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const id_producto = this.querySelector('input[name="id_producto"]').value;

      if (!confirm('¿Seguro que deseas eliminar este producto?')) return;

      fetch('<?= BASE_URL ?>/carrito/eliminar-producto', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id_producto=${id_producto}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          location.reload();
        } else {
          alert('Error al eliminar el producto');
        }
      });
    });
  });
</script>

</body>
</html>