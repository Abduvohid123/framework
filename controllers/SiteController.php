<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $massiv=['salom'=>'qalesan'];

        return $this->render( 'home',$massiv);
    }

}
