<?php

/**
 * Connection
 *
 * Erzeugt die Datenbankverbindung
 * @author Timon Müller-Wessling   
 */
class Connection{

    public static function createConnection(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "planningpoker";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn; 
        }
        catch(PDOException $e){
            error_log("Interner Fehler ". $e->getMessage(), 0);
        }
    }

}


?>