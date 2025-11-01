<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'classes/db.php';
require_once 'classes/user.php';

$db = new Database();
$conn = $db->getconnect();
$user = new user($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(strip_tags($_POST['name']));
    $email = trim(strip_tags($_POST['email']));
    $password = trim($_POST['password']);
    $age = (int)$_POST['age'];
    $role=$_POST['role'];
    $pass = password_hash($password, PASSWORD_DEFAULT);

    $user->registeruser($name,$email,$age,$pass,$role);
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="number" name="age" placeholder="Age" required min="1">
        <input type="password" name="password" placeholder="Password" required>

        <!-- ✅ Role Input -->
        <select name="role" required>
            <option value="user" selected>User</option>
            <option value="admin">Admin</option>
            
        </select>

        <button type="submit">Add User</button>
    </form>
        <a href="index.php">Login Here</a>


</body>

</html>