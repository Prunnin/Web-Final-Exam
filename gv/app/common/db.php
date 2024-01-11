<?php

class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;

    public $conn;

    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->host = $host;
            $this->dbname = $dbname;
            $this->username = $username;
            $this->password = $password;

            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function get_connection()
    {
        return $this->conn;
    }
}
