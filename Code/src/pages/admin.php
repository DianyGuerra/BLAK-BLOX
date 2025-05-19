<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../backend/models/auth.php';
requireAdmin();
checkUserType('admin');

require_once '../../backend/models/ConnectionDB.php';

$db = new connectionDB();
$conn = $db->connection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin - Blak Box</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../src/styles/styleAdmin.css" />
</head>
<body>
  
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
      <h5 class="offcanvas-title">Menú</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link text-white" href="#">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../../src/pages/productsAdmin.php">Products</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../../src/pages/ordersAdmin.php">Orders</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#">Users</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="../../backend/models/logOut.php">Logout</a></li>
      </ul>
    </div>
  </div>

  <div class="d-flex flex-column flex-lg-row min-vh-100">
    
    
    <aside class="bg-dark text-white p-3 sidebar d-none d-lg-block">
      <div class="text-center mb-4">
        <img src="../../Images/Logoblanco-removebg-preview.png" alt="Blak Box Logo" class="img-fluid" style="max-height: 150px; filter: invert(1) brightness(2);">
      </div>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link text-white" href="#">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../../src/pages/productsAdmin.php">Products</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../../src/pages/ordersAdmin.php">Orders</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#">Users</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="../../backend/models/logOut.php">Logout</a></li>
      </ul>
    </aside>

    
    <main class="flex-fill bg-purple-darker p-4">
      <div class="container-fluid">
        <div class="mb-4 bg-purple-mid text-white p-3 rounded shadow-sm">
          <h2 class="m-0">Admin Dashboard</h2>
        </div>

        <div class="row g-4">
          <div class="col-md-4">
            <div class="card bg-purple text-white h-100">
              <div class="card-body">
                <h5 class="card-title text-accent">Add Product</h5>
                <p class="card-text">Quickly add new tech items to your store.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-purple text-white h-100">
              <div class="card-body">
                <h5 class="card-title text-accent">Manage Orders</h5>
                <p class="card-text">View and update customer orders.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-purple text-white h-100">
              <div class="card-body">
                <h5 class="card-title text-accent">User Access</h5>
                <p class="card-text">Control admin and client permissions.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>