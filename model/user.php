<?php
require_once(__DIR__."/dbh.php");
require_once(__DIR__."/../functions/session.inc.php");
require_once(__DIR__."/../functions/core.inc.php");

class User {

    private $UserName, $Rank, $ID, $EMail, $Salt;
    private $DBH;
    
    public function __construct(){
        StartSecureSession();
        $this->DBH = new DBH();
    }
    

    public function getID () {
        return $this->ID;
    }
    
    public function getUserName () {
        return $this->UserName;
    }
    
    public function getRank () {
        return $this->Rank;
    }
    
    public function getEMail () {
        return $this->EMail;
    }
    
    public function getSalt () {
        return $this->Salt;
    }
    
    public function getUserByID($ID) {
        $Count = $this->DBH->prepare("SELECT COUNT(`id`) from `user` WHERE `id` = :id LIMIT 1"); 
        $Count->bindParam(':id', $ID, PDO::PARAM_INT);
        $Count->exec();
        if($Count->fetchColumn() == 1){
            $Stmnt = $this->DBH->prepare("SELECT * from `user` WHERE `id` = :id LIMIT 1");
            $Stmnt->bindParam(':id', $ID, PDO::PARAM_INT);
            $Stmnt->exec();
            $result = $Stmnt->fetch(PDO::FETCH_ASSOC);
            $this->UserName = $result['username'][0];
            $this->Rank = $result['rank'][0];
            $this->EMail = $result['email'][0];
            $this->ID = $result['id'][0];
            $this->Salt = $result['salt'][0];
            return true;
        }
        return false;
    }
    
    public function getUserByEMail($EMail) {
        $Count = $this->DBH->prepare("SELECT COUNT(`email`) from `user` WHERE `email` = :email LIMIT 1"); 
        $Count->bindParam(':email', $EMail, PDO::PARAM_STR);
        $Count->exec();
        if($Count->fetchColumn() == 1){
            $Stmnt = $this->DBH->prepare("SELECT * from `user` WHERE `email` = :email LIMIT 1");
            $Stmnt->bindParam(':email', $EMail, PDO::PARAM_STR);
            $Stmnt->exec();
            $result = $Stmnt->fetch(PDO::FETCH_ASSOC);
            $this->UserName = $result['username'][0];
            $this->Rank = $result['rank'][0];
            $this->EMail = $result['email'][0];
            $this->ID = $result['id'][0];
            $this->Salt = $result['salt'][0];
            return true;
        }
        return false;
    }
    
    public function getUserByUserName($UserName) {
        $Count = $this->DBH->prepare("SELECT COUNT(`username`) from `user` WHERE `username` = :username LIMIT 1"); 
        $Count->bindParam(':username', $UserName, PDO::PARAM_STR);
        $Count->exec();
        if($Count->fetchColumn() == 1){
            $Stmnt = $this->DBH->prepare("SELECT * from `username` WHERE `username` = :username LIMIT 1");
            $Stmnt->bindParam(':username', $UserName, PDO::PARAM_STR);
            $Stmnt->exec();
            $result = $Stmnt->fetch(PDO::FETCH_ASSOC);
            $this->UserName = $result['username'][0];
            $this->Rank = $result['rank'][0];
            $this->EMail = $result['email'][0];
            $this->ID = $result['id'][0];
            $this->Salt = $result['salt'][0];
            return true;
        }
        return false;
    }
    
    public function getUserForLogin($EMailOrUserName, $PW) {
        if($this->getUserByUserName($EMailOrUserName)) {
            $PW = SecureString($PW,$this->Salt);
            $Stmnt = $this->DBH->prepare("SELECT COUNT(`id`) from `user` WHERE `username` = :username AND `password` = :pw LIMIT 1");
            $Stmnt->bindParam(':username', $UserName, PDO::PARAM_STR);
            $Stmnt->bindParam(':pw', $PW, PDO::PARAM_STR);
            $Stmnt->exec();
            return ($Count->fetchColumn() == 1) ? true : false;
        }
        if($this->getUserByEMail($EMailOrUserName)) {
            $PW = SecureString($PW,$this->Salt);
            $Stmnt = $this->DBH->prepare("SELECT COUNT(`id`) from `user` WHERE `username` = :username AND `password` = :pw LIMIT 1");
            $Stmnt->bindParam(':username', $UserName, PDO::PARAM_STR);
            $Stmnt->bindParam(':pw', $PW, PDO::PARAM_STR);
            $Stmnt->exec();
            return ($Stmnt->fetchColumn() == 1) ? true : false;
        }
        return false;
    }
    
    public function getCurrentUser() {
        if($this->isLoggedIn()) {
            $Stmt = $this->DBH->prepare("SELECT * FROM `user` WHERE `id` = :id LIMIT 1");
            $Stmt->bind_param(':id', $UserID); // Bind "$user_id" to parameter.
            $Stmt->exec(); // Execute the prepared query.
            
            $result = $Stmnt->fetch(PDO::FETCH_ASSOC);
            
            $UserLoginString = hash('sha512', $result['password'].$IPAddress.$UserBrowser);
            if($SessionLoginString == $LoginString) {
                $this->UserName = $result['username'][0];
                $this->Rank = $result['rank'][0];
                $this->EMail = $result['email'][0];
                $this->ID = $result['id'][0];
                $this->Salt = $result['salt'][0];
                return true;
            }
        }
        return false;
    }
    
    public function isLoggedIn() {
        // Check if all session variables are set
        if(isset($_SESSION['UserID'], $_SESSION['UserName'], $_SESSION['LoginString'])) {
            $UserID = $_SESSION['UserID'];
            $SessionLoginString = $_SESSION['LoginString'];
            $UserName = $_SESSION['UserName'];
            $IPAddress = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user. 
            $UserBrowser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
     
            $Stmt = $this->DBH->prepare("SELECT COUNT(`id`) FROM `user` WHERE `id` = :id and `username` = :username LIMIT 1");
            $Stmt->bind_param(':id', $UserID, PDO::PARAM_INT); // Bind "$user_id" to parameter.
            $Stmt->bind_param(':username', $UserName, PDO::PARAM_STR);
            $Stmt->exec(); // Execute the prepared query.
     
            if($Stmnt->fetchColumn() == 1) { // If the user exists
            
                $Stmt = $this->DBH->prepare("SELECT `password` FROM `user` WHERE `id` = :id LIMIT 1");
                $Stmt->bind_param(':id', $UserID); // Bind "$user_id" to parameter.
                $Stmt->exec(); // Execute the prepared query.
                
                $result = $Stmnt->fetch(PDO::FETCH_ASSOC);
                
                $UserLoginString = hash('sha512', $result['password'].$IPAddress.$UserBrowser);
                return ($SessionLoginString == $LoginString) ? true : false;
            } 
        }
        return false;
    }
    
    public function changePW($PWNew, $PW) {
        
    }
    
    public function lostPW($PWNew) {
        if(isset($PWNew) && strlen($PWNew) > 0 && isset($this->ID)) {
            $hSecurePW = SecureString($PWNew);
            $Stmt = $this->DBH->prepare("UPDATE `user` SET `password` = :password, `salt` = :salt WHERE `id` = :id");
            $Stmt->bind_param(':id', $this->ID, PDO::PARAM_INT); // Bind "$user_id" to parameter.
            $Stmt->bind_param(':pw', $hSecurePW['SecureString'], PDO::PARAM_STR);
            $Stmt->bind_param(':salt', $hSecurePW['Salt'], PDO::PARAM_STR);
            $Stmt->exec(); // Execute the prepared query.
            return true;
        }  
        return false;
    }
    
}

?>
