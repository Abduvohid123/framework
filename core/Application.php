<?php

namespace app\core;

class Application
{
    public  static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Database $db;
    public Response $response;
    public static Application $app;
    public Controller $controller;


    public function __construct($path ,$config)

    {
        self::$app=$this;
        self::$ROOT_DIR=$path;
        $this->db=new Database($config['db']);
        $this->response=new Response();
        $this->request= new Request();
        $this->router = new Router($this->request,$this->response);
        $this->controller=new Controller();
    }

    public function run()
    {
       echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}
