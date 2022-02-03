<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;

class RegisterModel extends DbModel
{
    const  STATUS_INACTIVE=0;
    const  STATUS_ACTIVE=1;
    const  STATUS_DELETE=2;
    public string $firstname='';
    public string $lastname='';
    public string $email='';
    public int $status=self::STATUS_INACTIVE;
    public string $password='';
    public string $confirm_password='';

    public function tableName(): string
    {
        return  "users";
    }
    public function attributes(): array
    {
        return  ['firstname','lastname','email','password','status'];
    }



    public function save()
    {
        $this->password=password_hash($this->password,PASSWORD_BCRYPT);
        $this->status=self::STATUS_ACTIVE;
        return parent::save();
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
