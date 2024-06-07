<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $database_name = DB_NAME;

    private $dbh; // Database Handler
    private $stmt; // Statement

    public function __construct()
    {
        // Data Source Name
        $dsn = "mysql:host=$this->host;dbname=$this->database_name";

        $option = [
            PDO::ATTR_PERSISTENT => true, // untuk optimasi agar database koneksi tetap terjaga
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // untuk menampilkan error message
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function get()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCountAffected()
    {
        return $this->stmt->rowCount();
    }
}
