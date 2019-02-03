<?php

class Udalost
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
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM udalost ORDER BY datum_konani");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOneUdalost($id) {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM udalost WHERE id_udalost LIKE :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByUcast() {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM udalost WHERE ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function vlozUdalost($nazev_udalosti,$datum_konani, $cas_konani, $misto_konani, $popis_udalosti)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("INSERT INTO udalost (nazev_udalosti,datum_konani,cas_konani,misto_konani,popis_udalosti)
                                                VALUES (:nazev_udalosti,:datum_konani,:cas_konani,:misto_konani,:popis_udalosti)");
        $stmt->bindParam(':nazev_udalosti', $nazev_udalosti);
        $stmt->bindParam(':datum_konani', $datum_konani);
        $stmt->bindParam(':cas_konani', $cas_konani);
        $stmt->bindParam(':misto_konani', $misto_konani);
        $stmt->bindParam(':popis_udalosti', $popis_udalosti);
        $stmt->execute();
    }

    public function upravUdalost($id, $nazev_udalosti,$datum_konani, $cas_konani, $misto_konani, $popis_udalosti)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("UPDATE udalost SET nazev_udalosti=:nazev_udalosti,
                                      datum_konani=:datum_konani,cas_konani=:cas_konani,misto_konani=:misto_konani,
                                      popis_udalosti=:popis_udalosti where id_udalost=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nazev_udalosti', $nazev_udalosti);
        $stmt->bindParam(':datum_konani', $datum_konani);
        $stmt->bindParam(':cas_konani', $cas_konani);
        $stmt->bindParam(':misto_konani', $misto_konani);
        $stmt->bindParam(':popis_udalosti', $popis_udalosti);
        $stmt->execute();
    }
    public function odeberUdalost($id)
    {
        $stmt = $this->conn->prepare("DELETE from udalost where id_udalost=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}