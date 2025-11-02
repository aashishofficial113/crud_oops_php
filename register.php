<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'classes/db.php';
require_once 'classes/user.php';

$db = new Database();
$conn = $db->getconnect();
$user = new user($conn);

$currentrole=$_SESSION['role']??null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(strip_tags($_POST['name']));
    $email = trim(strip_tags($_POST['email']));
    $password = trim($_POST['password']);
    $age = (int)$_POST['age'];
    if($currentrole==='admin'){
        $role=(($_POST['role']??'user'==='admin')?'admin':'user');
    }
    else{
        $role=$_POST['role'];
    }
    $pass = password_hash($password, PASSWORD_DEFAULT);

    if ($user->registeruser($name, $email, $age, $pass, $role)) {
        if ($currentrole !== 'admin') {
            header("location:register.php?msg='registered'");
        } else {
            header("location:showallrecords.php?msg='data saved'");
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- ✅ Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            max-width: 450px;
            width: 100%;
        }
    </style>
</head>

<body>
    <nav>
     <?php if ($currentrole === 'admin'): ?>
            <a href="admindashboard.php" class="btn btn-success btn-sm me-2">HOME</a>
        <?php endif; ?>

    </nav>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Create Account</h3>

            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" placeholder="Enter age" required min="1">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>

            <p class="text-center mt-4">
                Already have an account?
                <a href="index.php" class="text-decoration-none">Login here</a>
            </p>
        </div>
    </div>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>