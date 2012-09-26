<?php
require_once("/dbh.php");
require_once("../funtions/session.inc.php");

class Authentication {

    private $DBH = new DBH();
    
    StartSecureSession();

    public function __construct() {
    }
    
    public function registerUser($EMail, $UserName, $PW, $PW2, $Rank) {
        if(strlen($EMail) > 0 && strlen($UserName) > 0 && strlen($PW) > 0 && strlen($PW) == strlen($PW2) && isset($Rank)) {
            $Rank = new Rank();
            $Rank->getRankByID($Rank);
            $User = new User();
            if(!$User->getUserByEMail($EMail) && !$User->getUserByUserName($UserName)) {
                $hSecurePW = SecureString($PW);
                $this->dbh->beginTransaction();
                try {  
                    $Stmt = $this->dbh->prepare("INSERT INTO `user` (username, email, pw, salt, rank) VALUES (:username, :email, :pw, :salt, :rank) ");
                    $Stmt->bindParam(':username',$UserName, PDO::PARAM_STR);
                    $Stmt->bindParam(':email',$EMAIL, PDO::PARAM_STR);
                    $Stmt->bindParam(':pw',$hSecurePW['SecureString'], PDO::PARAM_STR);
                    $Stmt->bindParam(':salt',$hSecurePWp['Salt'], PDO::PARAM_STR);
                    $Stmt->bindParam(':rank',$Rank, PDO::PARAM_INT);
                    $Stmt->execute();
                    $this->dbh->commit();
                    return $User->getUserByUserName($UserName);
                } catch (Exception $e) {
                    $this->dbh->rollback();
                    print $e->getMessage();
                    $die();
                }
            }
        }
        return false;
    }

    public function login ($EMailOrUserName, $PW) {
        // Using prepared Statements means that SQL injection is not possible. 
        $User = new User();
        if($User->getUserForLogin($EMailOrUserName, $PW)) {
            $IPAddress = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user. 
            $UserBrowser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
            $UserID = preg_replace("/[^0-9]+/", "", $User->getID()); // XSS protection as we might print this value
            $UserName = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $User->getUserName()); // XSS protection as we might print this value
            $LoginString = hash('sha512', SecureString($password,$thi).$IPAddress.$UserBrowser);
            
            SetSessionParams(array('UserIS' => $UserID, 'UserName' => $UserName, 'LoginString' => $LoginString));
            // Login successful.
            return true;    
        } 
        return false;
    }
    
    public function logout() {
        DestroySession();
    }
    
}

?>
