<?php
namespace App\Core;
use Config\Routes;
use App\Controllers\TwigController;
use App\Services\ValidationController;
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
        $uriHTTP = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        foreach ($this->routes[$methodHTTP] as $route => $r) {
            if($r->uri == $uriHTTP){
                $class =  $r->contoller;
                $parametres =  $r->parametres;
                $method =  $r->method;
                $request = ($methodHTTP == 'GET') ? $_GET : (json_decode(file_get_contents('php://input'), true) ?? $_POST);
                $AuthController = ValidationController::Validation($parametres ,$request );
                if($AuthController){
                    $controller = new $class();
                    //$middleware =  new AuthMiddleware($r["role"]);
                    // if($r->middleware !=null){
                    //     // $middleware->handle($request ,function () use ($class, $method) {
                    //     //     $controller = new $class();
                    //     //     return $controller->$method();
                    //     // });
                    //     $Found= true;
                    //     break;
                    // }
                    $controller->$method($request);
                }else{
                    //echo 'Missing parametres';
                }
                $Found = true;
                break;
            }
        }
        if(!$Found) echo $this->twig->render('pagenotfound.twig', ['message' => "Page Not Found 404"]);
    }
}

?>