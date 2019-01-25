<?php

class UdalostAdresar
{
    private $conn = null;

    /**
     * UserDao constructor.
     * @param PDO $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getByUdalost() {
        $stmt = $this->conn->prepare("SELECT * FROM udalost");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}