<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function index()
    {
        $massiv=['salom'=>'qalesan'];

        return $this->render( 'home',$massiv);
    }

    public function other_contact(Request $request)
    {
        var_dump($request->getBody());
    }

}
