<?php
require_once 'classes/db.php';
require_once 'classes/admin.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new Database();
    $conn = $db->getconnect();

    $user = new user($conn);
    $result = $user->edit($id);
    $data = $result->fetch_assoc();
} else {
    // header("location:showallrecords.php");
    echo "error";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $conn = $db->getconnect();
    $user = new user($conn);

     $id=(int)$_POST['id'];
    $name = trim(strip_tags($_POST['name']));
    $email = trim(strip_tags($_POST['email']));
    $age = (int)$_POST['age'];
    $role = $_POST['role'];
    $id = $_GET['id'];

    $user->update($id,$name,$email,$age,$role);
    if($user){
        echo " ..record updated";
    }
    else{
        echo "error in updation";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?=$data['id']; ?>" >
        <input type="text" name="name" placeholder="Name" value="<?= $data['name'] ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?= $data['email'] ?>" required>
        <input type="number" name="age" placeholder="Age" value="<?= $data['age'] ?>" min="2">

        <!-- ✅ Role Input -->
        <select name="role" required>
            <option value="user" selected>User</option>
            <option value="admin">Admin</option>

        </select>

        <button type="submit">Update</button>
    </form>
</body>

</html>