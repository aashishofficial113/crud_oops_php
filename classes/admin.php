<?php
require_once 'user.php';

class admin extends user{

function viewall(){
    $sql="select * from $this->table ";
    $stmt=$this->conn->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();
    return $result;

}





}


?>