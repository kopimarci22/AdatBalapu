<?php
class DBconnection
{
    public static $conn = null;
    private static $instance = null;

    private function __construct()
    {

        $connection = oci_connect('DAVID', 'asd123', 'localhost/XE', "UTF8") or die("Hibás csatlakozás!");


        if (!$connection) {
            $m = oci_error();
            echo $m['message'], "\n";
            exit;
        } else {


        }
        self::$conn = $connection;
    }

    public function getConnection()    {
        return self::$conn;
    }


    public static function getInstance()    {
        if (self::$instance == null) {
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }
}