<?php
require_once 'classes/db.php';
require_once 'classes/admin.php';
  
session_start();
$currentrole=$_SESSION['role']??null;
if(!$currentrole){
   header("location:index.php?msg=loginfirst");
}


$db=new Database();
$conn=$db->getconnect();

$admin=new admin($conn);
$data=$admin->viewall();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Records</title>

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding: 30px;
        }
        .table-container {
            max-width: 900px;
            margin: auto;
        }
    </style>
</head>
<body>

<div class="container table-container">
                        <a href="admindashboard.php" class="btn btn-success btn-sm me-2">HOME</a>
                  
    <h2 class="text-center mb-4">All User Records</h2>

    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['age']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this record?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="register.php" class="btn btn-primary">Add New User</a>
        <a href="index.php" class="btn btn-secondary">Logout</a>
    </div>
</div>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
