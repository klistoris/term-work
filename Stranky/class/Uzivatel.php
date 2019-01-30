<?php

class Uzivatel
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
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM osoba");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByEmail(string $mail) {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM osoba WHERE email LIKE concat('%', :email, '%') ");
        $stmt->bindParam(":email", $mail);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByUdalost() {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM udalost");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOneUser($id) {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM osoba WHERE idOsoba LIKE :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function vlozUzivatele($jmeno, $prijmeni, $telefon, $vek, $email, $heslo, $role)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("INSERT INTO osoba (jmeno,prijmeni,vek,telefon,email,heslo,role)
        VALUES (:jmeno,:prijmeni,:vek,:telefon,:email,:heslo,:role)");
        $stmt->bindParam(':jmeno', $jmeno);
        $stmt->bindParam(':prijmeni', $prijmeni);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':vek', $vek);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':heslo', $heslo);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }

    public function upravUzivatele($id, $jmeno, $prijmeni, $email, $vek, $telefon, $heslo, $role)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("UPDATE osoba SET jmeno=:jmeno,prijmeni=:prijmeni,email=:email,
                                      vek=:vek,telefon=:telefon,heslo=:heslo,role=:role where idOsoba=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':jmeno', $jmeno);
        $stmt->bindParam(':prijmeni', $prijmeni);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':vek', $vek);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':heslo', $heslo);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }
    public function odeberUzivatele($id)
    {
        $stmt = $this->conn->prepare("DELETE from osoba where idOsoba=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}