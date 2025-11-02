<?php
require_once 'classes/db.php';
require_once 'classes/admin.php';
session_start();

if (empty($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}

$currentuserid = (int)$_SESSION['id'];
$currentrole = $_SESSION['role'];
// whom to edit


$requestid = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($currentrole === 'admin' && $requestid) {
    $targetid = $requestid;
} else {
    $targetid = $currentuserid;
}

$id = $targetid;
$db = new Database();
$conn = $db->getconnect();
$user = new user($conn);
$result = $user->edit($id);

if (!$result) {  // if query execution failed
    // exit("Database error while fetching user");
}

$data = $result->fetch_assoc();

if (!$result || $result->num_rows === 0) {
    header("Location: admindashboard.php?error=no_user&id=" . (int)$targetId);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim(strip_tags($_POST['name']));
    $email = trim(strip_tags($_POST['email']));
    $age = (int)$_POST['age'];

    if ($currentrole !== 'admin') {
        $role = $data['role'];
    } else {
        $role = $_POST['role'];
    }

    $ok = $user->update($id, $name, $email, $age, $role);
    if ($ok) {
        if ($currentrole !== 'admin') {
            header("location:userdashboard.php?msf='profile updated'");
        } else {
            header("location:showallrecords.php?msg='profile updated'");
        }
    } else {
        echo "error in updation";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            max-width: 550px;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Edit User Details</h3>

            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name"
                        value="<?= $data['name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email"
                        value="<?= $data['email'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" value="<?= $data['age'] ?>" min="2">
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="user" <?= $data['role'] == 'user' ? 'selected' : '' ?>>User</option>
                        <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
        </div>
    </div>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>