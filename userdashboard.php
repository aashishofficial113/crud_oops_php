<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <?php
        session_start();
        if (empty($_SESSION['id'])) {
            header("Location: index.php?msg=login first");
            exit;
        } else {
            echo  $name = $_SESSION['username'];
            echo $role=$_SESSION['role'];
        }

        ?>
        <a href="edit.php">Edit details</a>
    </nav>

    <h1>Hii user dashboard</h1>





</body>

</html>