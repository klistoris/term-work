<?php

class UzivatelAdresar
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

    public function getAllUsers() {
        $stmt = $this->conn->prepare("SELECT * FROM osoba");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByEmail(string $mail) {
        $stmt = $this->conn->prepare("SELECT * FROM osoba WHERE email LIKE  concat('%', :email, '%') ");
        $stmt->bindParam(":email", $mail);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByUdalost() {
        $stmt = $this->conn->prepare("SELECT * FROM udalost");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}