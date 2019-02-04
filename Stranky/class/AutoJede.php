<?php
/**
 * Created by PhpStorm.
 * User: edwardzarecky
 * Date: 02/02/2019
 * Time: 18:05
 */

class AutoJede
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getVolnaAutaNaUdalost($id_udalost) {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM auto LEFT JOIN auto_jede_na_udalost ON auto_id = idauto WHERE udalost_id = :id_udalost");
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getVratPosledniZaznam() {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT MAX(id) FROM auto_jede_na_udalost");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getVratPocetVolnyMist($id, $id_udalost) {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT pocet_mist FROM auto_jede_na_udalost WHERE id = :id AND udalost_id = :id_udalost");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getVratBeruAuto($id_udalost, $id_uzivatel) : bool{
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM auto_jede_na_udalost WHERE auto_id IN 
                                        (SELECT idauto FROM auto WHERE majitel = :id_uzivatel) AND udalost_id = :id_udalost");
        $stmt->bindParam(':id_uzivatel', $id_uzivatel);
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->execute();
        $pocet = $stmt->fetch();
        if($pocet[0] > 0){
            return true;
        }else{
            return false;
        }
    }

    public function vratIDMehoAuta($id_udalost, $id_uzivatel){
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT id FROM auto_jede_na_udalost WHERE auto_id IN (SELECT idauto FROM auto 
                                    WHERE majitel = :id_uzivatel) AND udalost_id = :id_udalost ");
        $stmt->bindParam(':id_uzivatel', $id_uzivatel);
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->execute();
        $pocet = $stmt->fetch();
        return $pocet[0];
    }

    public function vlozAutoJede($udalost_id,$auto_id, $pocet_mist)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("INSERT INTO auto_jede_na_udalost (udalost_id,auto_id,pocet_mist)
                                                VALUES (:udalost_id,:auto_id,:pocet_mist)");
        $stmt->bindParam(':udalost_id', $udalost_id);
        $stmt->bindParam(':auto_id', $auto_id);
        $stmt->bindParam(':pocet_mist', $pocet_mist);
        $stmt->execute();
    }

    public function upravAuto($id, $znacka,$pocet_mist, $typ, $majitel)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("UPDATE auto_jede_na_udalost SET znacka=:znacka,
                                      pocet_mist=:pocet_mist,typ=:typ,
                                      majitel=:majitel where idauto=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':znacka', $znacka);
        $stmt->bindParam(':pocet_mist', $pocet_mist);
        $stmt->bindParam(':typ', $typ);
        $stmt->bindParam(':majitel', $majitel);
        $stmt->execute();
    }

    public function upravAutoPocetMist($id, $pocet_mist)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("UPDATE auto_jede_na_udalost SET pocet_mist=:pocet_mist where id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':pocet_mist', $pocet_mist);
        $stmt->execute();
    }

    public function odeberAuto($id)
    {
        $stmt = $this->conn->prepare("DELETE from auto_jede_na_udalost where id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}