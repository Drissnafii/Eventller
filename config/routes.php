<?php

namespace Config;

use Config\Route;
use App\Controllers\ContollerTemplate;

class Routes{

    public static  $routes = [];
    public static function load(){
        self::$routes = [
            'GET' => [
                new Route(uri:'/', contoller:ContollerTemplate::class ,method:'Home', parametres:[
                    'name' => 'Home'
                ]),
                new Route(uri:'/dashboard', contoller:ContollerTemplate::class,method:'Dashboard'),
                new Route(uri:'/events', contoller:ContollerTemplate::class,method:'Events'),
                new Route(uri:'/signin',contoller:ContollerTemplate::class,method:'Signin'),
                new Route(uri:'/signup',contoller:ContollerTemplate::class,method:'Signup'),
                new Route(uri:'/forgotpassword',contoller:ContollerTemplate::class,method:'Forgotpassword')
            ],
            'POST' => [] ,
            'PUT' => [] ,
            'DELETE' => [] ,
            'PATCH' => [] ,
            
        ];
    }
    public static function getRoutes(){
        return self::$routes;
    }
}

?>