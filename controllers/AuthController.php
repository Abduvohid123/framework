<?php

namespace app\controllers;

use app\core\Application;
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
        $this->setLayout('auth');

        $registerModel = new RegisterModel();
        if ($request->isPost()) {

            $registerModel->loadData($request->getBody());


            if($registerModel->validate()  && $registerModel->save()){
                Application::$app->session->setFlash('success','Siz registratsiyadan o\'tdingiz');
            //    Application::$app->session->setFlash('danger','Xato');
                Application::$app->response->redirect('/');
            }


            return  $this->render('register',['model'=>$registerModel]);

        }

        return $this->render('register',['model'=>$registerModel]);
    }


}
