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

    public function getByEmail($mail) {
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

    public function ucastnimSeUdalosti($id_udalost) : bool{
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $id_osoba = $_SESSION['identity']['idOsoba'];
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM osoba_jede_poskytnutym_vozem 
                            WHERE vuz_na_udalost_id = (SELECT id FROM auto_jede_na_udalost WHERE udalost_id = :id_udalost) AND 
                            osoba_id = :id_osoba");
        $stmt->bindParam(":id_udalost", $id_udalost);
        $stmt->bindParam(":id_osoba", $id_osoba);
        $stmt->execute();
        $pocet = $stmt->fetch();
        if($pocet[0] > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getOneUzivatelID($id) {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM osoba WHERE idOsoba LIKE :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function zmenHeslo($id, $heslo)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("UPDATE osoba SET heslo=:heslo where idOsoba=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':heslo', $heslo);
        $stmt->execute();
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