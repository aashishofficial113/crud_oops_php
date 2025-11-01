<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <nav>
        <?php
        session_start();
        if (empty($_SESSION['role'])) {
            header("location:index.php?msg=login first");
        } else {
            echo  $name = $_SESSION['role'];
        }
        ?>
        <button onclick="location.href='showallrecords.php'">Show all records</button>

        <button onclick="window.location.href='logout.php'">Logout</button>
        <button onclick="window.location.href='register.php'">add user</button>
        <button onclick="window.location.href='logout.php'">Logout</button>
    </nav>
</body>

</html>