<?php

class Auto
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

    public function getByAuto() {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM auto");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOneAuto($id) {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM auto WHERE idauto LIKE :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function vlozauto($znacka,$pocet_mist, $typ, $majitel)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("INSERT INTO auto (znacka,pocet_mist,typ,majitel)
                                                VALUES (:znacka,:pocet_mist,:typ,:majitel)");
        $stmt->bindParam(':znacka', $znacka);
        $stmt->bindParam(':pocet_mist', $pocet_mist);
        $stmt->bindParam(':typ', $typ);
        $stmt->bindParam(':majitel', $majitel);
        $stmt->execute();
    }

    public function upravAuto($id, $znacka,$pocet_mist, $typ, $majitel)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("UPDATE auto SET znacka=:znacka,
                                      pocet_mist=:pocet_mist,typ=:typ,
                                      majitel=:majitel where idauto=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':znacka', $znacka);
        $stmt->bindParam(':pocet_mist', $pocet_mist);
        $stmt->bindParam(':typ', $typ);
        $stmt->bindParam(':majitel', $majitel);
        $stmt->execute();
    }
    public function odeberAuto($id)
    {
        $stmt = $this->conn->prepare("DELETE from auto where idauto=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}