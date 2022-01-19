<?php

namespace app\core;

class Application
{
    public  static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;


    public function __construct($path)

    {
        self::$app=$this;
        self::$ROOT_DIR=$path;
        $this->response=new Response();
        $this->request= new Request();
        $this->router = new Router($this->request);

    }

    public function run()
    {
       echo $this->router->resolve();
    }
}
