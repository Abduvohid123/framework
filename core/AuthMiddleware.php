<?php

namespace app\core;


class AuthMiddleware extends  BaseMiddleware
{
    public array $actions=[];
    public function __construct($actions=[])
    {
        $this->actions=$actions;
    }

    public function exucute(){

        if (Application::mehmonmisan()){
            if (empty($this->actions) || in_array(Application::$app->controller->action,$this->actions)){
                throw new \Exception();
            }
        }
    }

}
