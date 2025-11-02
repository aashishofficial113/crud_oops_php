<?php
require_once 'classes/db.php';
require_once 'classes/user.php';
session_start();

$db = new Database();
$conn = $db->getconnect();
$user = new user($conn);

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim(strip_tags($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if ($user->login($email, $password)) {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            header('Location: admindashboard.php');
            exit;
        } else {
            header('Location: userdashboard.php');
            exit;
        }
    } else {
        $error = 'Invalid credentials. Please try again.';
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body { min-height: 100vh; display: flex; align-items: center; background: #f8fafc; }
      .auth-card { max-width: 420px; width: 100%; }
      .brand { letter-spacing: .5px; }
    </style>
  </head>
  <body>
    <main class="container py-5 d-flex justify-content-center">
      <div class="auth-card card shadow-sm border-0">
        <div class="card-body p-4 p-md-5">
          <div class="text-center mb-4">
            <div class="display-6 fw-semibold brand">YourApp</div>
            <div class="text-muted">Welcome back—sign in to continue</div>
          </div>

          <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>

          <form action="" method="post" novalidate class="needs-validation">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required autocomplete="email">
              <div class="invalid-feedback">Please enter a valid email.</div>
            </div>

            <div class="mb-2">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1">Show</button>
                <div class="invalid-feedback">Please enter your password.</div>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
              <a href="#" class="small text-decoration-none">Forgot password?</a>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>
          </form>

          <hr class="my-4">

          <p class="mb-0 text-center">New here? <a href="register.php" class="text-decoration-none">Create an account</a></p>
        </div>
      </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
      // Client-side Bootstrap validation
      (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
      })()

      // Toggle password visibility
      document.getElementById('togglePassword').addEventListener('click', function(){
        const pwd = document.getElementById('password');
        const isPassword = pwd.getAttribute('type') === 'password';
        pwd.setAttribute('type', isPassword ? 'text' : 'password');
        this.textContent = isPassword ? 'Hide' : 'Show';
      });
    </script>
  </body>
</html>
