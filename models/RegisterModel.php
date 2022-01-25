<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
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


    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN => 8], [self::RULE_MAX => 24]],
            'confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH => 'password']]
        ];
    }
}
