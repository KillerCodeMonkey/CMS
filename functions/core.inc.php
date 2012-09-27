<?php

    function ValidateEMail($EMail) {
        return filter_var($EMail, FILTER_VALIDATE_EMAIL);
    }
    
    function CompareStrings($String1, $String2) {
        return (string)$String1 === (string)$String2 ? 1 : 0;
    }
    
    function SecureString($String, $Salt='') {
        if($Salt != '') {
            $Salt = GenerateSalt();
        }
        $SecureString = base64_encode(hash_hmac('sha256', $String, $Salt, true));
        
        return array('SecureString' => $SecureString, 'Salt' => $Salt);
    }
    
    function GenerateSalt($MaxLength = 15) {
        $CharacterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
        $i = 0;
        $Salt = "";
        while ($i < $MaxLength) {
            $Salt .= $CharacterList{mt_rand(0, (strlen($CharacterList) - 1))};
            $i++;
        }
        return $Salt;
    }

?>
