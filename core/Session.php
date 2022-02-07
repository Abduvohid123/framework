<?php

namespace app\core;


/*
$originArray = array(0,1,2,3,4,6,7,8,9);
foreach ($originArray as $value){
    $value = $value + 1;
}

unset ($value);

print_r($originArray);

ampersand ni tuwuniw uchun testlab ko'r

*/

class Session
{
    const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessage['remove']=true;
        }
        $_SESSION[self::FLASH_KEY]=$flashMessages;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] =
            [
                'remove' => false,
                'value' => $message
            ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;

    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
           if ($flashMessage['remove']){
               unset($flashMessages[$key]);
           }
        }
        $_SESSION[self::FLASH_KEY]=$flashMessages;
    }
//  bundan keyin labellarni to'g'rilash
    public function set(string $string, $primaryValue)
    {
        $_SESSION[$string]=$primaryValue;
    }
    public function get(string $string)
    {
        return $_SESSION[$string];
    }
    public function  remove($key){

        unset($_SESSION[$key]);
    }
}
