<?php
require_once 'classes/db.php';

require_once 'classes/user.php';
session_start();

$db = new Database();
$conn = $db->getconnect();

$user = new user($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strip_tags($_POST['email']);
    $password = $_POST['password'];

    if ($user->login($email, $password)) {

        if ($_SESSION['role'] == 'admin') {
            header("location:admindashboard.php");
            exit;
        } else {
            header("location:userdashboard.php");
            exit;
        }
    } else {
        echo "invalid credentials";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password">
        <button type="submit">Login</button>
    </form>
    <a href="register.php">Register Here</a>



</body>

</html>