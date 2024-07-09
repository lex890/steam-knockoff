<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once 'db_conn.php';

    $email = $_SESSION['email'];

    $navsql = "SELECT user_name FROM users WHERE email = '$email'";
    $result_nav = $conn->query($navsql);

    if ($result_nav && $result_nav->num_rows > 0) {
        $row = $result_nav->fetch_assoc();
        $user_name = $row['user_name'];
    } else {
        $user_name = "User";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/store.css" type="text/css" rel="stylesheet">
</head>
<body class="store_bg">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
        <a class="navbar-brand ms-5" href="store.php">Shopping Cart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Offcanvas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ACCOUNT
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Change Password</a></li>
                            <li><a class="dropdown-item" href="#">Transactions</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="login.php">Sign Out</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">CART</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="store.php">LIBRARY</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="bg-body-tertiary p-5 rounded">
    <div class="col-sm-8 py-5 mx-auto">
        <h2 class="cart-title">Games in your Cart:</h2>
        <?php
        if (isset($_POST['remove_from_cart']) && !empty($_POST['game_title'])) {

            $gameToRemove = $_POST['game_title'];

            if (($key = array_search($gameToRemove, $_SESSION['cart'])) !== false) {
                unset($_SESSION['cart'][$key]);
            }

            header("Location: cart.php");
            exit;
        }

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $totalCost = 0;

            foreach ($_SESSION['cart'] as $game_title) {
                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("SELECT title, price, game_logo FROM games WHERE title = ?");
                $stmt->bind_param("s", $game_title);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalCost += $row['price'];
                    echo "<div class='row mb-3 cart-item'>";
                    echo "<div class='col-md-3'>";
                    echo "<img src='" . $row['game_logo'] . "' alt='Game Logo' class='img-thumbnail'>";
                    echo "</div>";
                    echo "<div class='col-md-6'>";
                    echo "<h4>" . $row['title'] . "</h4>";
                    echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";
                    echo "</div>";
                    echo "<div class='col-md-3 d-flex align-items-center'>";
                    echo "<form action='cart.php' method='post'>";
                    echo "<input type='hidden' name='game_title' value='" . $row["title"] . "'>";
                    echo "<button type='submit' name='remove_from_cart' class='btn btn-danger'>Remove</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }

                $stmt->close();
            }

            echo "<h4>TOTAL COST: $" . $totalCost . "</h4>";
            echo "<form action='transaction.php' method='post'>";
            echo "<button type='submit' class='btn btn-success'>Confirm?</button>";
            echo "</form>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }

        $conn->close();
        ?>

    </div>
</div>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-5 my-2">
    <p class="col-md-4 mb-2 text-body-secondary">&copy; 2024 Comshop, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
    </a>

    <ul class="nav col-md-8 justify-content-end">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
    </ul>
  </footer>
</div>
</html>
