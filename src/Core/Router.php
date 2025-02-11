<?php
namespace App\Core;
use Config\Routes;
use App\Controllers\TwigController;
use App\Core\AuthController;
class Router extends TwigController{

    public array $routes ;
    /**
     * Redirect request to the specified controller
     * 
     * @return string
     */
    public function dispatch(){
        $Found = false;
        Routes::load();
        $this->routes = Routes::getRoutes();
        $methodHTTP = $_SERVER['REQUEST_METHOD'];
        $uriHTTP = $_SERVER['REQUEST_URI'];
        foreach ($this->routes[$methodHTTP] as $route => $r) {
            if($r->uri == $uriHTTP){
                $class =  $r->contoller;
                $method =  $r->method;
                //$middleware =  new AuthMiddleware($r["role"]);
                $controller = new $class;
                $request = [
                    'params' => $_GET,
                    'body' => json_decode(file_get_contents('php://input'), true) ?? $_POST
                ];
                // if($r->middleware !=null){
                //     // $middleware->handle($request ,function () use ($class, $method) {
                //     //     $controller = new $class();
                //     //     return $controller->$method();
                //     // });
                //     $Found= true;
                //     break;
                // }
                $AuthController = new AuthController($class , $method);
                $controller->$method($request);
                $Found = true;
                break;
            }
        }
        if(!$Found) echo $this->twig->render('pagenotfound.twig', ['message' => "Page Not Found 404"]);
    
    }
    public function ValidateInput($input){
       
        return $input;
    }
}

?>