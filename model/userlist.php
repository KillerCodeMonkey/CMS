<?php
require_once("/dbh.php");
require_once("../functions/session.inc.php");
require_once("../functions/core.inc.php");

class UserList {

    private $UserList = array();
    private $DBH = new DBH();
    
    StartSecureSession();
    
    public function __construct() {
        return $this->getUserInfo;
    }
    
    public function getUserIDs() {
        $IDs = array();
        foreach ($this->UserList as $Key => $Value) {
            $IDs[$Key] = $Value['ID'];
        }
    
        return $IDs;
    }
    
    private function _getData($OrderCriteria = 'username', $SortOrder = 'ASC') {
        if(!in_array($Order, explode(' ', 'username id email'))) {
            $OrderCriteria = 'username';
        }
        if($SortOrder != 'ASC' or $SortOrder != 'DESC') {
            $SortOrder = 'ASC';
        }
        $Stmt = $this->DBH->prepare("SELECT `username`,`id`,`email` from `user` ORDER BY `:ordercriteria` :sortorder ");
        $Stmt->bindParam(':ordercriteria', $OrderCriteria, PDO::PARAM_STR);
        $Stmt->bindParam(':sortorder', $SortOrder, PDO::PARAM_STR);
        $Stmt->exec();
        $Result = $Stmnt->fetchAll();
        foreach ($Result as $Key => $Value ) {
            $this->UserList[$Key] = array('UserName' => $Value['username'], 'ID' => $Value['id'], 'EMail' => $Value['email']);
        }
    }
    
    public function getAllUserInfo() {
        return $this->UserList;
    }
    
    public function getUserNames() {
        $UserNames = array();
        foreach ($this->UserList as $Key => $Value) {
            $UserNames[$Key] = $Value['UserName'];
        }
    
        return $UserNames;
    }
 
    public function getEMailAddrs() {
        $EMailAddrs = array();
        foreach ($this->UserList as $Key => $Value) {
            $EMailAddrs[$Key] = $Value['EMail'];
        }
    
        return $EMailAddrs;
    } 
    
    public function getLatest($Number = 5) {
        
    }  
}

?>
