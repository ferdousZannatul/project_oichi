<?php
include "const.inc.php";

class db{
    private $serverName = "localhost";//DB_SERVER_NAME;
    private $userName = "root";//DB_USERNAME;//
    private $password = "";//DB_PASSWORD;//
    private $dbName = "oichi_db";//DB_NAME;//

    function connect(){
        $conn = new mysqli(
            $serverName,
            $userName,
            $password,
            $dbName
        );

        return $conn;
    }
}
?>