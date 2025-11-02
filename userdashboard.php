<?php
session_start();
$currentrole=$_SESSION['role']??null;
if(!$currentrole){
        header("Location: index.php?msg=Please get login first");
        exit;

}


$name = $_SESSION['username'];
$role = $_SESSION['role'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- ✅ Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyApp</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item text-light my-auto me-3">
                        <strong>User:</strong> <?= htmlspecialchars($name); ?> |
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning me-2" href="edit.php?id=<?= $id; ?>">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ Dashboard Content -->
    <div class="container mt-5">
        <h1 class="text-center">Welcome, <?= htmlspecialchars($name); ?> 👋</h1>
        <p class="text-center text-muted">You're logged in as <strong><?= $role; ?></strong>.</p>
    </div>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
