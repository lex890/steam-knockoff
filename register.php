<?php
include_once 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST['email'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // Prepare the SQL statement using a prepared statement
    $stmt = $conn->prepare("INSERT INTO users (user_name, password, email) VALUES (?, ?, ?)");
    
    // Bind parameters to the prepared statement
    $stmt->bind_param("sss", $user_name, $password, $email);
    
    // Execute the prepared statement
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        header("Location: login.php"); // Redirect to login page
        exit;
    } else {
        echo "Error: ". $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
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
    <title>Register</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/heroes/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
  </head>

  <div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mt-1 mb-4 border-top border-bottom"> <!-- Navbar pwede nyo copy to reuse -->
    <div class="col-md-3 mb-2 mt-2 mb-md-2">
      <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
        <svg class="bi" width="55" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap"/>
        </svg>
      </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="#" class="nav-link px-2 link-warning fw-bold fs-5">Home</a></li>  <!-- ket wag na lagyan to ng href links for visual lang -->
      <li><a href="#" class="nav-link px-2 link-light fw-bold fs-5">Features</a></li> 
      <li><a href="#" class="nav-link px-2 link-light fw-bold fs-5">Pricing</a></li>
      <li><a href="#" class="nav-link px-2 link-light fw-bold fs-5">FAQs</a></li>
      <li><a href="#" class="nav-link px-2 link-light fw-bold fs-5">About</a></li>
    </ul>

    <div class="col-md-3 text-end"> <!-- yung linya sa navbar -->
      <button type="button" class="btn btn-light" onclick="window.location.href='login.php'">Login</button>
      <button type="button" class="btn btn-outline-light me-2" onclick="window.location.href='register.php'">Sign-up</button>
    </div>
  </header>
</div>

    <body class="register-page">
<main>
  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="header1"><span class="text-warning">Create</span> Your Account </h1>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
      <form action="register.php" method="post" class="p-4 p-md-5 rounded-3 bg-body-tertiary bg-opacity-25">
          <div class="form-floating mb-4"> 
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username">
            <label for="floatingInput">User Name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
            <label for="floatingPassword">E-mail</label>
          </div>
          <div class="checkbox mb-3">
          </div>
          <button class="w-100 btn btn-lg btn-warning" type="submit">Click To Sign up</button>
          <hr class="my-4">
          <small class="text-body-secondary">Create your very own ComShop Account!.</small>
        </form>
      </div>
    </div>
  </div>
  <div class="b-example-divider mb-0"></div>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>