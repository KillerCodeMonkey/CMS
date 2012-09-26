<?php

    function StartSecureSession() {
        $session_name = 'sec_session_id'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id. 

        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(true); // regenerated the session, delete the old one.     
    }
    
    function SetSessionParams($hParams) {
        foreach ($hParams as $Key => $Value) {
            $_SESSION[$Key] = $Value;
        }
    }
    
    function DestroySession() {
        $_SESSION = array();
        // get session parameters 
        $Params = session_get_cookie_params();
        // Delete the actual cookie.
        setcookie(session_name(), '', time() - 42000, $Params["path"], $Params["domain"], $Params["secure"], $Params["httponly"]);
        // Destroy session
        session_destroy();
    }

?>
