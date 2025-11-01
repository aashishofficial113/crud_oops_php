<?php
class user
{
    protected $table = "users";
    protected $conn = "";

    function __construct($db)
    {
        $this->conn = $db;
    }

    public function registeruser($name, $email, $age, $pass, $role)
    {
        $sql = "insert into $this->table (name,email,age,hash_pass,role) values(?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            echo "error";
            return false;
        }

        $stmt->bind_param("ssiss", $name, $email, $age, $pass, $role);
        if ($stmt->execute()) {
            header("location:register.php?msg=datasaved");
        } else {
            header("location:register.php?msg=errorinsavingdata");
        }
        $stmt->close();
    }

    function login($email, $password)
    {
        $sql = "select * from $this->table where email=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $data = $stmt->get_result();
        $stmt->close();

        if ($data->num_rows === 1) {
            $user = $data->fetch_assoc();

            $hash_pass = $user['hash_pass'];
            if (password_verify($password, $hash_pass)) {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                return true;
            }
        }
    }

        function edit($id)
        {
            $sql = "select * from $this->table where id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $data = $stmt->get_result();
            $stmt->close();
            return $data;
        }

        function update($id, $name, $email, $age, $role)
        {
            $sql = "update $this->table set name=?,email=?,age=?,role=? where id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssisi", $name, $email, $age, $role, $id);
            $result = $stmt->execute();
            $stmt->close();
            return (bool)$result;
        }
        function delete($id)
        {
            $sql = "delete from $this->table where id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $result = $stmt->execute();
            $stmt->close();
            return (bool)$result;
        }
    }

