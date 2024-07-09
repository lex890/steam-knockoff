<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navbar Template · Bootstrap v5.3</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/store.css" type="text/css" rel="stylesheet">
  </head>
  <body class="store_bg">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
      <div class="container-fluid">
      <?php
        session_start();
        if (!isset($_SESSION['email'])) {
            header("Location: login.php");
            exit;
        }

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
      <a class="navbar-brand ms-5" href="store.php">Welcome back, <span class="text-success"><?php echo $user_name?></span></a>

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
                <a class="nav-link active" aria-current="page" href="library.php">LIBRARY</a>
              </li>
    
            </ul>
          </div>
        </div>
      </div>
    </nav>

<div class="bg-body-tertiary p-5 rounded">
    <div class="col-sm-8 py-5 mx-auto">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

            include_once 'db_conn.php';

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
                                echo "<button type='button' class='btn btn-success'>Add to Cart</button>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "No results found";
            }
            $conn->close();
        ?>
    </div>
</div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
