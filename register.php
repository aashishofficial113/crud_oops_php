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

<?php
// Make sure session exists if you want the admin HOME button to show
if (session_status() === PHP_SESSION_NONE) session_start();
$currentRole = $_SESSION['role'] ?? null; // 'admin' or null
?>

<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$currentRole = $_SESSION['role'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .card {
            max-width: 450px;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Simple Navbar (only if admin is logged in) -->
    <?php if ($currentRole === 'admin'): ?>
        <nav class="navbar navbar-dark bg-dark w-100 position-absolute top-0">
            <div class="container-fluid">
                <span class="navbar-text text-light">Admin Panel</span>
                <a href="admindashboard.php" class="btn btn-success btn-sm">Home</a>
            </div>
        </nav>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Register</h3>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Show Role selection only if admin is creating a user -->
                <?php if ($currentRole === 'admin'): ?>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                <?php else: ?>
                    <input type="hidden" name="role" value="user">
                <?php endif; ?>
                
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
             <?php if ($currentRole== 'user'??null): ?>

            <p class="text-center mt-3">
                Already have an account? <a href="index.php">Login</a>
            </p>
            <?php endif; ?>
        </div> 
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
