<?php
require_once 'classes/db.php';
require_once 'classes/admin.php';

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
    <title>Document</title>
</head>
<body>
<table>
<thead>
    <tr>
    <th>id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Age</th>
    <th>Edit</th>
    <th>Delete</th>
    </tr>
</thead>
<?php while($row=$data->fetch_assoc())
    { ?>
<tbody>
    <tr>
    <td><?=$row['id']; ?></td>
    <td><?=$row['name']?></td>
    <td><?=$row['email'];?></td>
    <td><?=$row['age'] ?></td>
    <td><a href="edit.php?id=<?=$row['id'];?>">edit</a></td>
    <td><a href="delete.php?id=<?=$row['id'];?>">Delete</a></td>
    </tr>
</tbody>
<?php }?>
</table>
    
</body>
</html>