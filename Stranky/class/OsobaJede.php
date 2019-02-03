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
                                      vuz_na_udalost=:vuz_na_udalost,role=:role where id=:id");
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
}