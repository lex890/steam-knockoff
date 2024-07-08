<?php
// wala pang link para mapunta sa register page via login page (see line 51 ng login.php)
include_once 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO users (user_name, password, email) VALUES (?,?,?)");
    $stmt->bind_param("sss", $user_name, $password, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: login.php");
        die;
    } else {
        echo "Error: ". $stmt->error;
    }

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
    <body>
<main>
  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="header1">Create Your Account </h1>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form action="login.php" method="post" class="p-4 p-md-5 rounded-3 bg-body-tertiary bg-opacity-25">
          <div class="form-floating mb-4"> 
            <input type="text" class="form-control" id="user_name" placeholder="Username">
            <label for="floatingInput">User Name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" placeholder="E-mail">
            <label for="floatingPassword">E-mail</label>
          </div>
          <div class="checkbox mb-3">
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Click To Sign up</button>
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