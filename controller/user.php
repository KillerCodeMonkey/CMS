<?php

class UserController {
    
    private $UserActions = array('ViewUser');
    private $CurrentUser;
    
    public function __construct(){
        $this->CurrentUser = new User();
    }
    
    public function main ($hVars) {
        
        if(isset($hVars['Action'])) {
            # Check if user is already logged in.
            if($CurrentUser->getCurrentUser()) {
            
            }
        } else {
            // ERROR-PAGE
        }
    }
    
    protected function getUserByID() {
    }
}

?>
