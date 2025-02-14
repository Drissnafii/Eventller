<?php

namespace Config;

use Config\Route;
use App\Controllers\ContollerTemplate;
use App\Controllers\EventController;
use App\Controllers\UserController;
use App\Controllers\TicketController;

class Routes{

    public static  $routes = [];
    public static function load(){
        self::$routes = [
            'GET' => [
                new Route(uri:'/', contoller:ContollerTemplate::class ,method:'Home'),
                new Route(uri:'/dashboard', contoller:ContollerTemplate::class,method:'Dashboard'),
                new Route(uri:'/dbconnection', contoller:ContollerTemplate::class,method:'Dbconnection'),
                new Route(uri:'/events', contoller:ContollerTemplate::class,method:'events'),
                new Route(uri:'/eventdet', contoller:ContollerTemplate::class,method:'eventdet'),
                new Route(uri:'/payment', contoller:ContollerTemplate::class,method:'payment'),
                new Route(uri:'/signin',contoller:ContollerTemplate::class,method:'Signin'),
                new Route(uri:'/signup',contoller:ContollerTemplate::class,method:'Signup'),
                new Route(uri:'/forgotpassword',contoller:ContollerTemplate::class,method:'Forgotpassword'),



                new Route(uri:'/getevents', contoller:EventController::class,method:'Find',parametres:['offset'=>"string"]),
                new Route(uri:'/tickets', contoller:TicketController::class,method:'getTicketsByEvent',parametres:['event_id'=>"string"]),
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