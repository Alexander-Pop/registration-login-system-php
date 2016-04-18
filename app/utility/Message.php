<?php

namespace app\utility;

if (!isset($_SESSION)) {
    session_start();
}

class Message
{
    public static function message($message = NULL) 
    {
        if (is_null($message)) {
            $_message = self::getMessage();
            
            return $_message;
        } else {
            self::setMessage($message);
        }
    }
    
    private static function getMessage() 
    {
        $_message = $_SESSION['message'];
        $_SESSION['message'] = '';
        
        return $_message;
    }
    
    private static function setMessage($message) 
    {
        $_SESSION['message'] = $message;
    }

}