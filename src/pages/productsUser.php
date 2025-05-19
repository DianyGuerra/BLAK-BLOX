<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../backend/models/auth.php';
requireLogin();
checkUserType('user');

include('../../backend/models/Products.php');
$products = Product::listAllProducts();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $found = false;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['productId'] == $productId) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        foreach ($products as $p) {
            if ($p['productId'] == $productId) {
                $_SESSION['cart'][] = [
                    'productId' => $p['productId'],
                    'name' => $p['name'],
                    'price' => $p['price'],
                    'quantity' => 1
                ];
                break;
            }
        }
    }

    header("Location: productsUser.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BLAK BOX | Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../styles/styleUser.css"/>
</head>
<body class="bg-purple-darker text-white">

  <nav class="navbar navbar-dark bg-dark d-lg-none">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../../Images/Logoblanco-removebg-preview.png" alt="Blak Box Logo" style="height: 40px; filter: invert(1) brightness(2);">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasMenu">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Menu</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link text-white" href="productsUser.php">Products</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="cartUser.php">Cart</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="../../backend/models/logOut.php">Log out</a></li>
      </ul>
    </div>
  </div>

  <div class="d-flex flex-column flex-lg-row min-vh-100">
    
    <aside class="bg-dark text-white p-3 d-none d-lg-block" style="min-width: 220px;">
      <div class="text-center mb-4">
        <img src="../../Images/Logoblanco-removebg-preview.png" alt="Blak Box Logo" class="img-fluid" style="max-height: 150px; filter: invert(1) brightness(2);">
      </div>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link text-white" href="productsUser.php">Products</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="cartUser.php">Cart</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="../../backend/models/logOut.php">Log out</a></li>
      </ul>
    </aside>

    <div class="container py-5">
      <h1 class="text-center text-accent mb-4">Our Products</h1>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

        <?php foreach ($products as $p): ?>
          <div class="col">
            <div class="card bg-purple text-white h-100">
              <div class="card-body d-flex flex-column justify-content-between">
                <div>
                  <h5 class="card-title text-accent"><?= htmlspecialchars($p['name']) ?></h5>
                  <p class="card-text"><?= htmlspecialchars($p['description']) ?></p>
                  <p><strong>$<?= number_format($p['price'], 2) ?></strong></p>
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                  <a href="detail_products.php?id=<?= $p['productId'] ?>" class="btn btn-outline-light btn-sm">View</a>
                  <form method="POST" action="productsUser.php" style="display: inline;">
                    <input type="hidden" name="productId" value="<?= $p['productId'] ?>">
                    <button type="submit" class="btn btn-accent btn-sm">Add</button>
                  </form>
                  <button class="btn btn-sm text-accent" onclick="toggleFavorite(<?= $p['productId'] ?>)">⭐</button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>

  <script>
    function toggleFavorite(id) {
      alert(`Product ${id} added to favorites (mock)`);
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
