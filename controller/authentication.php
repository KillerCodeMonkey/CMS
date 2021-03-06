<?php

require_once(__DIR__."/../functions/core.inc.php");

class AuthenticationController {

    private $Authentication;
    private $User;
    private $Template = 'index';
    private $FormError = array();

    public function __construct () {
        $this->Authentication = new Authentication();
        $this->User = new User();
    }

    public function main (array $hVars, $Smarty) {
        if($this->User->getCurrentUser()) {
            if(isset($hVars['p'])){
                $Page = strtolower($hVars['p']);
                $Method = strtolower($hVars['m']);
                if($Page == 'registration') {
                    $this->Template = 'registration';
                    if($Method == 'register') {
                        if(self::register()) {
                            $Smarty->assign('RegisterSuccess', 1);
                            $Smarty->assign('ExistFormError', 0);
                        } else {
                            $Smarty->assign('RegisterSuccess', 0);
                            $Smarty->assign('ExistFormError', 1);
                            $Smarty->assign('FormError', $this->FormError);
                        }
                    }
                } elseif($Page == 'login') {
                    $this->Template = 'login';
                    if($Method == 'login') {
                        if(self::login()) {
                            $Smarty->assign('LoginSuccess', 1);
                            $Smarty->assign('ExistFormError', 0);
                        } else {
                            $Smarty->assign('LoginSuccess', 0);
                            $Smarty->assign('ExistFormError', 1);
                            $Smarty->assign('FormError', $this->FormError);                        
                        }
                    }
                } elseif($Page == 'lostpassword') {
                    $this->Template = 'lostpw';
                    if($Method == 'sendpw') {
                        if(self::sendpw()) {
                            $Smarty->assign('SendPWSuccess', 1);
                            $Smarty->assign('ExistFormError', 0);
                        } else {
                            $Smarty->assign('SendPWSuccess', 0);
                            $Smarty->assign('ExistFormError', 1);
                            $Smarty->assign('FormError', $this->FormError);                        
                        }
                    }
                } else {
                    $this->Template = 'error';
                }
            }
        } else {
            $Method = strtolower($hVars['m']) ? $hVars['m'] : null ;
            if ($Method == 'logout') {
                $this->Authentication->logout();
                $Smarty->assign('LogoutSuccess', 1);
                $Smarty->assign('ExistFormError', 0);
            }
        }
        // already logged in
    }
    
    protected function register() {
        $FormValues = $_POST;
        $UserName = $FormValues['UserName'];
        $EMail = $FormValues['EMail'];
        $PW1 = $FormValues['pw1'];
        $PW2 = $FormValues['pw2'];

        if(!(strlen($EMail) > 0))
            array_push($this->FormError,array('Name' => 'email', 'Reason' => 'MISSING'));
        if(!(strlen($UserName) > 0))
            array_push($this->FormError,array('Name' => 'username', 'Reason' => 'MISSING'));
        if(!(strlen($PW1) > 0))
            array_push($this->FormError,array('Name' => 'pw1', 'Reason' => 'MISSING'));         
        if(!(strlen($PW2) > 0))
            array_push($this->FormError,array('Name' => 'pw2', 'Reason' => 'MISSING'));
        if(length($this->FormError) == 0) {
            if(!ValidateEMail($EMail))
                array_push($this->FormError,array('Name' => 'email', 'Reason' => 'NOTVALID'));
            if(!CompareString($PW1,$PW2))
                array_push($this->FormError,array('Name' => 'pws', 'Reason' => 'NOTEQUAL'));
            if(length($FormError) == 0) {
                if($this->Authentication->registerUser($UserName, $EMail, $PW1, $PW2, 0)){
                    return true;
                } else {
                    array_push($this->FormError,array('Name' => 'UserEmail', 'Reason' => 'USEREXIST'));
                }
            }    
        }
        return false;        
    }
    
    protected function login() {
        $FormValues = $_POST;
        $Login = $FormValues['login'];
        $PW = $FormValues['pw'];    
        
        if(!(strlen($Login) > 0))
            array_push($this->FormError,array('Name' => 'login', 'Reason' => 'MISSING'));
        if(!(strlen($PW) > 0))
            array_push($this->FormError,array('Name' => 'pw', 'Reason' => 'MISSING'));
        if(length($this->FormError) == 0) {
            if(!$this->Authentication->login($Login, $PW)) {
                return true;
            } else {
                array_push($this->FormError,array('Name' => 'data', 'Reason' => 'WRONG'));
            }
        }
        return false;
    }
    
    protected function sendPW() {
        $FormValues = $_POST;
        $UserOrEMail = $FormValues['user'];
        
        if($this->User->getUserByUserName() || $this->User->getUserByEMail()) {
            $PW = GenerateSalt(10);
            if($this->User->lostPW($PW)) {
                $Mail = new Smarty();
                $Mail->assign('UserName',$this->User->getUserName());
                $Mail->assign('NewPW',$PW);
                $MailText = $Mail->fetch('lostPWMail.tpl');
                $Header = '';
                mail($this->User->getEMail(), 'LostPW', $MailText, $Header);
                return true;
            }
        }
        return false;
    }

}

?>
