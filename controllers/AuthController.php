<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{

    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {

        $errors = [];
        if ($request->isPost()) {
            $registerModel = new RegisterModel();
            $firstname = $request->getBody()['firstname'];
            if (!$firstname) {
                $errors['firstname']='Ismni kiritish majburiy!';
            }
        }
        $this->setLayout('auth');

        return $this->render('register',['errors'=>$errors]);
    }


}
