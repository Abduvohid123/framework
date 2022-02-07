<?php

namespace app\core;
class Application
{
    public  static string $ROOT_DIR;
    public string $userClass;
    public Router $router;
    public Request $request;
    public Database $db;
    public Response $response;
    public static Application $app;
    public Controller $controller;
    public Session $session;
    public ?DbModel $user;   // so'roq agar user yoq bolsa errro bolmasligi uchun

//  core ichidagi klaslarni core dan tashqarida ishlatish mimkin emas  -->  misol uchun registermodelni
// unda qanday qilib olamiz  env orqali
    public function __construct($path ,$config)

    {
        self::$app=$this;
        self::$ROOT_DIR=$path;
        $this->db=new Database($config['db']);
        $this->response=new Response();
        $this->request= new Request();
        $this->router = new Router($this->request,$this->response);
        $this->controller=new Controller();
        $this->session=new Session();
        $this->userClass=$config['userClass'];

        $primaryValue=$this->session->get('user')??null;
        if ($primaryValue){
            $primaryKey=$this->userClass::primaryKey();

            $this->user= $this->userClass::findOne([$primaryKey=>$primaryValue]);
        }
        else{
            $this->user=null;
        }


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

    public function login(DbModel $user)
    {
        $this->user= $user;
        $primaryKey=$user::primaryKey();
        $primaryValue=$user->{$primaryKey};  // user->id

        $this->session->set('user',$primaryValue);  // user id si sessiyaga yozildi

        return true;


    }
    public function logout(){
        $this->user=null;
        $this->session->remove('user');
    }

    public static function mehmonmisan()
    {
        return !self::$app->user;
    }

}
