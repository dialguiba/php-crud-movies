<?php

class Connection {
    private $host = "db";
    private $user = "devuser";
    private $password = "devpass";
    private $db = "test_db";
    private $connect;

    public function __construct() {
        $connectionString = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=utf8";
        try {
            $this->connect = new PDO($connectionString, $this->user, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            $this->connect = 'Error de conexión';
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function connect() {
        return $this->connect;
    }

}

?>