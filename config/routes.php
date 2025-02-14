<?php

namespace Config;

use Config\Route;
use App\Controllers\ContollerTemplate;
use App\Controllers\UserController;

class Routes{

    public static  $routes = [];
    public static function load(){
        self::$routes = [
            'GET' => [
                new Route(uri:'/', contoller:ContollerTemplate::class ,method:'Home'),
                new Route(uri:'/test', contoller:ContollerTemplate::class ,method:'Test', parametres:[
                    'name' => 'int'
                ]),
                new Route(uri:'/auth', contoller:UserController::class, method: 'Rederiction'),
                new Route(uri:'/dashboard', contoller:ContollerTemplate::class,method:'Dashboard'),
                new Route(uri:'/a_events', contoller:ContollerTemplate::class,method:'Admin_Events'),
                new Route(uri:'/users', contoller:ContollerTemplate::class,method:'Admin_Users'),
                new Route(uri:'/dbconnection', contoller:ContollerTemplate::class,method:'Dbconnection'),
                new Route(uri:'/events', contoller:ContollerTemplate::class,method:'Events'),
                new Route(uri:'/signin',contoller:ContollerTemplate::class,method:'Signin'),
                new Route(uri:'/signup',contoller:ContollerTemplate::class,method:'Signup'),
                new Route(uri:'/forgotpassword',contoller:ContollerTemplate::class,method:'Forgotpassword'),
                new Route(uri:'/statistics', contoller:UserController::class, method:'Statistics'),
                new Route(uri:'/org_dashboard', contoller:ContollerTemplate::class, method:'Org_Dashboard'),
                new Route(uri:'/platform', contoller:ContollerTemplate::class, method:'Platform')


            ],
            'POST' => [
                new Route(uri:'/testpost', contoller:ContollerTemplate::class ,method:'Test', parametres:[
                    'name' => 'int'
                ]),
                new Route(uri:'/register', contoller:UserController::class, method:'signup'),
                new Route(uri:'/login', contoller:UserController::class, method:'login')
            ] ,
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