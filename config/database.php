<?php

class Database
{
    private $host = "localhost";
    private $db_name = "psp_portal";
    private $username = "root";
    private $password = "";

    public function getConnection()
    {
        try {

            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $conn->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

            return $conn;

        } catch (PDOException $e) {

            die("Database Connection Error: " . $e->getMessage());
        }
    }
}
?>