<?php
class Database
{
    protected $conn = 'false';

    private $host = "localhost";
    private $pass = "";
    private $user = "root";
    private $dbname = "phprewise1";

    function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn) {
            echo "connection made";
        } else {
            echo "error in connection";
        }
    }

    public function getconnect()
    {
        return $this->conn;
    }
}
