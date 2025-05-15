<?php

namespace App\Libraries;

class Hash
{
    public static function make($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function check($userPassword, $dbUserPassword)
    {
       if(password_verify($userPassword, $dbUserPassword)){
            return true;
        }else{
            return false;
        }
    }
}


?>