<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginModel;
use app\models\RegisterModel;

class AuthController extends Controller
{

    public function login(Request $request, Response $response)
    {
        $registerModel = new LoginModel();
        if ($request->isPost()){

            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->login()){

                $response->redirect('/');
            }


        }

        return $this->render('login',['model'=>$registerModel]);
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
