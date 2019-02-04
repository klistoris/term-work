<?php


class Autentizace
{
    static private $instance = NULL;
    static private $identity = NULL;

    private $conn = null;


    static function getInstance() : Autentizace
    {
        if (self::$instance == NULL) {
            self::$instance = new Autentizace();
        }
        return self::$instance;
    }

    private function __construct()
    {
        if (isset($_SESSION['identity'])) {
            self::$identity = $_SESSION['identity'];
        }
        $this->conn = Pripojeni::getPdoInstance();

    }

    public function login() : bool
    {
        $stmt = $this->conn->prepare("SELECT heslo FROM osoba WHERE email=:email");
        $stmt->bindParam(':email', $_POST["loginMail"]);
        $stmt->execute();
        $heslo_z_databaze = $stmt->fetch();


        $stmt = $this->conn->prepare("SELECT idOsoba, jmeno, email, heslo, role, vek FROM osoba WHERE email= :email");

        $overeni = password_verify($_POST['loginPassword'], $heslo_z_databaze['heslo']);

        if($overeni){
            $stmt->bindParam(':email', $_POST["loginMail"]);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                $userDto = array('idOsoba' => $user['idOsoba'], 'jmeno' => $user['jmeno'], 'mail' => $user['email'],
                    'heslo' => $user['heslo'], 'role' => $user['role'], 'vek' => $user['vek']);
                $_SESSION['identity'] = $userDto;
                self::$identity = $userDto;
                return true;
            }
            else {
                    return false;
                }
        }else{
            echo "<br>";
            return false;
        }
    }

    public function hasIdentity() : bool
    {
        if (self::$identity == NULL) {
            return false;
        }
        return true;
    }

    public function getIdentity()
    {
        if (self::$identity == NULL) {
            return false;
        }
        return self::$identity;
    }

    public function logout()
    {
        unset($_SESSION['identity']);
        $_SESSION = array();
        session_destroy();
        self::$identity = NULL;
    }
}