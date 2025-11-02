<?php
session_start();
if (empty($_SESSION['role'])) {
    header("location:index.php?msg=login first");
    exit;
}

$role = $_SESSION['role'];
$username = $_SESSION['username'] ?? "User";
$id = $_SESSION['id'] ?? "";
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

    <!-- ✅ Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item text-light my-auto me-3">
                        <strong>Role:</strong> <?= htmlspecialchars($role); ?>
                    </li>
                    <li class="nav-item">
                        <a href="showallrecords.php" class="btn btn-primary btn-sm me-2">Show All Records</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="btn btn-success btn-sm me-2">Add User</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ Main Content -->
    <div class="container mt-5">
        <h2>Welcome, <?= htmlspecialchars($username); ?> 👋</h2>
        <p class="text-muted">You are logged in as <strong><?= htmlspecialchars($role); ?></strong>.</p>
    </div>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
