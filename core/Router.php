<?php

namespace app\core;
class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];




    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback) {
           $this->response->setStatusCode(404);
            return $this->renderContent('Not Found!');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if(is_array($callback)){
            $controller=new $callback[0]();
            Application::$app->controller=$controller;
            $controller->action=$callback[1];
            $callback[0]=$controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->exucute();
            }


        }

        return call_user_func($callback,$this->request,$this->response);
    }

    public function renderView(string $callback,$massiv=[])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($callback,$massiv);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }



    public function renderContent(string $viewContent)
    {
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout=Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view,$massiv)
    {
        foreach ($massiv as $key => $value){
            $$key=$value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}
