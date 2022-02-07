<?php

namespace app\core;



class Controller
{

    public string $layout='main';
    public string $action='';
    /**
     * @var BaseMiddleware[]
     * */

    protected array $middlewares=[];
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout(string $layout)
    {
        $this->layout=$layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[]=$middleware; // controllerning middlewarelariga yig'ish
    }

    /**
     * @return BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

}
