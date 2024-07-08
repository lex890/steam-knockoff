<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once 'db_conn.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE EMAIL='$email' AND PASSWORD='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        header("Location: store.php");
        die;
    } else {
        echo "Invalid username or password";
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/heroes/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
  </head>

  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
          <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0"> 
        <li><a href="#" class="nav-link px-2 link-secondary">STORE</a></li>
        <li><a href="#" class="nav-link px-2">ABOUT</a></li>
        <li><a href="#" class="nav-link px-2">SUPPORT</a></li>
        <li><a href="#" class="nav-link px-2">FAQs</a></li>
        <li><a href="#" class="nav-link px-2">HELP</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <button type="button" class="btn btn-outline-primary me-2">Login</button>
        <button type="button" class="btn btn-primary">Sign-up</button>
      </div>
    </header>
  </div>

  <body>
    <main>
      <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
          <div class="col-lg-7 text-center text-lg-start">
            <h1 class="header">COMSHOP</h1>
            <p class="sub-text">A video game digital distribution service and storefront inspired by steam</p>
          </div>
          <div class="col-md-10 mx-auto col-lg-5">
            <form action="login.php" method="post" class="p-4 p-md-5 rounded-3 bg-body-tertiary bg-opacity-25">
              <div class="form-floating mb-4"> 
                <input type="email" class="form-control" id="email" name="email" placeholder="example@hotmail.com">
                <label for="email">Email</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name ="password" placeholder="Password">
                <label for="password">Password</label>
              </div>
              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" value="remember-me"> Remember me
                </label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
          </div>
        </div>
      </div>
      <div class="b-example-divider mb-0"></div>
    </main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
