<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginModel extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN => 8], [self::RULE_MAX => 24]],
        ];
    }


    public function login()
    {
        $user = RegisterModel::findOne(['email'=>$this->email]);

        if (!$user){
            $this->addError_boshqa_joydan('email','Bu emailda user mavjud emas!');
            return false;
        }


        if (!password_verify($this->password,$user->password)){

            $this->addError_boshqa_joydan('password','Parol xato kiritildi!');
            return false;

        }
        return Application::$app->login($user);
    }





}
