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
        <title>Store Page</title>
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/store.css" type="text/css" rel="stylesheet">
        <style>
            .added-to-cart-box {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                display: <?php echo isset($_POST['add_to_cart']) ? 'block' : 'none'; ?>; /* Show only if added to cart */
                z-index: 9999;
        }
    </style>
</head>
<body class="store_bg">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
        <a class="navbar-brand ms-5" href="store.php">Welcome back, <span class="text-success"><?php echo $user_name ?></span></a>

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
                        <a class="nav-link" href="cart.php">CART</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">LIBRARY</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="bg-body-tertiary p-5 rounded">
    <div class="col-sm-8 py-5 mx-auto">
        <?php
        $sql = "SELECT title, description, price, date, publisher, game_logo FROM games";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='row'>";
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card h-100'>";
                echo "<img src='" . $row["game_logo"] . "' alt='Game Logo' class='card-img-top'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row["title"] . "</h5>";
                echo "<p class='card-text'>" . $row["description"] . "</p>";
                echo "<p class='card-text'><strong>Price:</strong> $" . $row["price"] . "</p>";
                echo "<p class='card-text'><strong>Release Date:</strong> " . $row["date"] . "</p>";
                echo "<p class='card-text'><strong>Publisher:</strong> " . $row["publisher"] . "</p>";
                echo "<form action='store.php' method='post' name='addToCartForm'>";
                echo "<input type='hidden' name='game_title' value='" . $row["title"] . "'>";
                echo "<button type='submit' name='add_to_cart' class='btn btn-success'>Add to Cart</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No results found";
        }

        if (isset($_POST['add_to_cart']) && !empty($_POST['game_title'])) {
            // Handle adding to cart here
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            // Add the game title to cart
            $_SESSION['cart'][] = $_POST['game_title'];
        }
        ?>
    </div>
</div>

<div class="added-to-cart-box" style="display: <?php echo isset($_POST['add_to_cart']) ? 'block' : 'none'; ?>;">
    <?php
    if (isset($_POST['add_to_cart']) && !empty($_POST['game_title'])) {
        echo "<p>Added " . $_POST['game_title'] . " to cart.</p>";
        echo "<button class='btn btn-primary' id='keepPurchasing'>Keep Purchasing</button>";
        echo "<a href='cart.php' class='btn btn-primary'>Go to Cart</a>";
    }
    ?>
</div>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
