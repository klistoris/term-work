<?php
/**
 * Created by PhpStorm.
 * User: edwardzarecky
 * Date: 02/02/2019
 * Time: 18:05
 */

class OsobaJede
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function existujeRidic($id, $role) : bool
    {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM osoba_jede_poskytnutym_vozem WHERE vuz_na_udalost_id = :id AND role = :role");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $pocet = $stmt->fetch();
        if($pocet[0] == 0){
            return true;
        }else{
            return false;
        }
    }

    public function vratOsobyUdalosti($id_udalost)
    {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT o.jmeno,o.prijmeni,o.email, vo.role, a.typ, a.majitel 
                                      FROM auto_jede_na_udalost jede JOIN osoba_jede_poskytnutym_vozem 
                                      vo ON jede.id = vo.vuz_na_udalost_id JOIN osoba o ON o.idOsoba = vo.osoba_id 
                                      JOIN auto a ON a.idauto = jede.auto_id AND jede.udalost_id = :id_udalost ");
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function vratMajitele($id)
    {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT email FROM osoba WHERE idOsoba = :id ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function vratOsobaJedeID($id_udalost, $id_osoba, $role)
    {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT id FROM osoba_jede_poskytnutym_vozem WHERE vuz_na_udalost_id IN 
                                      (SELECT id FROM auto_jede_na_udalost WHERE udalost_id = :id_udalost) AND osoba_id = :id_osoba 
                                        AND role = :role");
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->bindParam(':id_osoba', $id_osoba);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $pocet = $stmt->fetch();
        return $pocet[0];
    }

    public function vratAutoJedeID($id_udalost, $id_osoba, $role)
    {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT vuz_na_udalost_id FROM osoba_jede_poskytnutym_vozem WHERE vuz_na_udalost_id IN 
                                      (SELECT id FROM auto_jede_na_udalost WHERE udalost_id = :id_udalost) AND osoba_id = :id_osoba 
                                        AND role = :role");
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->bindParam(':id_osoba', $id_osoba);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $pocet = $stmt->fetch();
        return $pocet[0];
    }

    public function jeduVeSvemAute($id_udalost, $id_osoba) : bool
    {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM osoba_jede_poskytnutym_vozem WHERE vuz_na_udalost_id IN 
                                    (SELECT id FROM auto_jede_na_udalost WHERE udalost_id = :id_udalost AND auto_id IN (SELECT idauto FROM auto 
                                    WHERE majitel = :id_osoba)) AND osoba_id = :id_osoba ");
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->bindParam(':id_osoba', $id_osoba);
        $stmt->execute();
        $pocet = $stmt->fetch();
        if($pocet[0] > 0){
            return true;
        }else{
            return false;
        }
    }

    public function roleRegistraceNaTurnaj($id_udalost, $id_osoba)
    {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT role FROM osoba_jede_poskytnutym_vozem WHERE osoba_id = :id_osoba AND vuz_na_udalost_id
                                    IN (SELECT id FROM auto_jede_na_udalost WHERE udalost_id = :id_udalost) ");
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->bindParam(':id_osoba', $id_osoba);
        $stmt->execute();
        $role = $stmt->fetch();
        return $role[0];
    }

    public function veKteremJeduAute($id_udalost, $id_osoba)
    {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT pocet_mist FROM auto_jede_na_udalost WHERE id IN 
                                    (SELECT vuz_na_udalost_id FROM osoba_jede_poskytnutym_vozem WHERE osoba_id = :id_osoba)
                                    AND `udalost_id` = :id_udalost");
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->bindParam(':id_osoba', $id_osoba);
        $stmt->execute();
        $pocet = $stmt->fetch();
        return $pocet[0];
    }

    public function vratPocetLidiVAute($id_vuz_jede_na_udalost)
    {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM osoba_jede_poskytnutym_vozem WHERE vuz_na_udalost_id = :id_vuz_jede_na_udalost ");
        $stmt->bindParam(':id_vuz_jede_na_udalost', $id_vuz_jede_na_udalost);
        $stmt->execute();
        $pocet = $stmt->fetch();
        return $pocet[0];
    }

    public function vlozOsobaJede($osoba, $vuz_na_udalost,$role)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("INSERT INTO osoba_jede_poskytnutym_vozem (vuz_na_udalost_id,osoba_id, role)
                                                VALUES (:vuz_na_udalost,:osoba,:role)");
        $stmt->bindParam(':vuz_na_udalost', $vuz_na_udalost);
        $stmt->bindParam(':osoba', $osoba);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }

    public function vlozOsobaJedeRidic($osoba, $vuz_na_udalost)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("INSERT INTO osoba_jede_poskytnutym_vozem (vuz_na_udalost_id,osoba_id, role) 
                                    VALUES (:vuz_na_udalost,:osoba,'ridic')");
        $stmt->bindParam(':vuz_na_udalost', $vuz_na_udalost);
        $stmt->bindParam(':osoba', $osoba);
        $stmt->execute();
    }

    public function upravOsobaJede($id, $osoba, $vuz_na_udalost,$role)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("UPDATE osoba_jede_poskytnutym_vozem SET osoba=:osoba,
                                      vuz_na_udalost_id=:vuz_na_udalost,role=:role where id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':osoba', $osoba);
        $stmt->bindParam(':vuz_na_udalost', $vuz_na_udalost);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }
    public function odeberOsobaJede($id)
    {
        $stmt = $this->conn->prepare("DELETE from osoba_jede_poskytnutym_vozem where id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function odeberOsobaJedeVsechnyVAute($vuz_na_udalost)
    {
        $stmt = $this->conn->prepare("DELETE from osoba_jede_poskytnutym_vozem where vuz_na_udalost_id=:vuz_na_udalost");
        $stmt->bindParam(':vuz_na_udalost', $vuz_na_udalost);
        $stmt->execute();
    }
}