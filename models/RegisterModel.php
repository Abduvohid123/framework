<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends  Model
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $confirm_password;

    public function register()
    {
        return 'Created new user';
    }


}
