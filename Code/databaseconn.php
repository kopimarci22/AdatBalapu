<?php
class DBconnection
{
    public static $conn = null;
    private static $instance = null;

    private function __construct()
    {
<<<<<<< HEAD
        $connection = oci_connect('GERGOO', 'asd123', 'localhost/XE', "UTF8") or die("Hibás csatlakozás!");
=======
        $connection = oci_connect('DAVID', 'asd123', 'localhost/XE', "UTF8") or die("Hibás csatlakozás!");
>>>>>>> David
        if (!$connection) {
            $m = oci_error();
            echo $m['message'], "\n";
            exit;
        } else {
<<<<<<< HEAD
        print "Connected!";
=======
            print "Connected!";
>>>>>>> David
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