<?php

class Pripojeni {

    static private $instance = NULL;

    private function __construct()
    {
    }

    static function getPdoInstance() : PDO
    {
        if (self::$instance == NULL) {
            $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance = $conn;
        }
        return self::$instance;
    }
}