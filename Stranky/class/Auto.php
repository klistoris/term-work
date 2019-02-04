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

    public function getVsechnaAuta() {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM auto");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByAuto() {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT idauto, znacka, pocet_mist ,typ, email, majitel 
                    FROM auto LEFT JOIN osoba o ON majitel = idOsoba ORDER BY email");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getEmailUzivatelu() {
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT email, idOsoba FROM osoba");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAutaUzivatele() {
        $id_uzivatele = $_SESSION['identity']['idOsoba'];
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT * FROM auto WHERE majitel = :id_uzivatele");
        $stmt->bindParam(':id_uzivatele', $id_uzivatele);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPocetMist($id) {
        $id_uzivatele = $_SESSION['identity']['idOsoba'];
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT pocet_mist FROM auto WHERE majitel = :id_uzivatele AND idAuto = :id");
        $stmt->bindParam(':id_uzivatele', $id_uzivatele);
        $stmt->bindParam(':id', $id);
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

    public function mamAuto() : bool {
        $id_uzivatele = $_SESSION['identity']['idOsoba'];
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM auto WHERE majitel = :id_uzivatele");
        $stmt->bindParam(':id_uzivatele', $id_uzivatele);
        $stmt->execute();
        $pocet = $stmt->fetch();
        if($pocet[0] > 0){
            return true;
        }else{
            return false;
        }
    }

    public function jeMojeAutoUzRegistrovane($id_udalost) : bool {
        $id_uzivatele = $_SESSION['identity']['idOsoba'];
        $stmt_znaky = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt_znaky->execute();
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM auto_jede_na_udalost WHERE auto_id IN 
                                                (SELECT idauto FROM auto WHERE majitel = :id_uzivatele) AND udalost_id = :id_udalost");
        $stmt->bindParam(':id_uzivatele', $id_uzivatele);
        $stmt->bindParam(':id_udalost', $id_udalost);
        $stmt->execute();
        $pocet = $stmt->fetch();
        if($pocet[0] == 0){
            return true;
        }else{
            return false;
        }
    }

    public function vlozAuto($znacka, $pocet_mist, $typ, $majitel)
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

    public function vlozAutoBezMajitele($znacka, $pocet_mist, $typ)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $id_uzivatele = $_SESSION['identity']['idOsoba'];
        $stmt = $this->conn->prepare("INSERT INTO auto (znacka,pocet_mist,typ,majitel)
                                                VALUES (:znacka,:pocet_mist,:typ,:id_uzivatele)");
        $stmt->bindParam(':znacka', $znacka);
        $stmt->bindParam(':pocet_mist', $pocet_mist);
        $stmt->bindParam(':typ', $typ);
        $stmt->bindParam(':id_uzivatele', $id_uzivatele);
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

    public function upravAutoBezMajitele($id, $znacka,$pocet_mist, $typ)
    {
        $id_uzivatele = $_SESSION['identity']['idOsoba'];
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();
        $stmt = $this->conn->prepare("UPDATE auto SET znacka=:znacka,
                                      pocet_mist=:pocet_mist,typ=:typ, majitel = :id_uzivatele where idauto=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':znacka', $znacka);
        $stmt->bindParam(':pocet_mist', $pocet_mist);
        $stmt->bindParam(':typ', $typ);
        $stmt->bindParam(':id_uzivatele', $id_uzivatele);
        $stmt->execute();
    }
    public function odeberAuto($id)
    {
        $stmt = $this->conn->prepare("DELETE from auto where idauto=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}