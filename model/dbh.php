<?php
require_once("../config-php");

class DBH {
    
    private $dbh;
    
    public function __construct() {
        try {
            $this->$dbh = new PDO(DB_TYPE.':host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $this->dbh;
    }
    
    public function __destruct() {
        $this->dbh = null;
    }

}

?>
