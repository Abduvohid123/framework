<?php

namespace app\controllers;

use app\core\Application;

class SiteController
{
    public function index()
    {
        $massiv=['salom'=>'qalesan'];

        return Application::$app->router->renderView('home',$massiv);
    }

}
