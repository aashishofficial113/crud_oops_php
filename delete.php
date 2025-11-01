<?php
require_once 'classes/user.php';
require_once 'classes/db.php';


if(isset($_GET['id'])){
$id=(int)$_GET['id'];

$db=new Database();
$conn=$db->getconnect();

$user=new user($conn);
if($user->delete($id)){
    header("location:showallrecords.php?msg=record deleted");
}
else{
        header("location:showallrecords.php?msg=record not deleted");

}

}


?>