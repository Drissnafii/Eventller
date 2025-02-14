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
                new Route(uri:'/test', contoller:ContollerTemplate::class ,method:'Test', parametres:[
                    'name' => 'int'
                ]),
                new Route(uri:'/auth', contoller:UserController::class, method: 'Rederiction'),
                new Route(uri:'/dashboard', contoller:ContollerTemplate::class,method:'Dashboard'),
                new Route(uri:'/a_events', contoller:ContollerTemplate::class,method:'Admin_Events'),
                new Route(uri:'/users', contoller:ContollerTemplate::class,method:'Admin_Users'),
                new Route(uri:'/dbconnection', contoller:ContollerTemplate::class,method:'Dbconnection'),
                new Route(uri:'/events', contoller:ContollerTemplate::class,method:'events'),
                new Route(uri:'/eventdet', contoller:ContollerTemplate::class,method:'eventdet'),
                new Route(uri:'/payment', contoller:ContollerTemplate::class,method:'payment'),
                new Route(uri:'/signin',contoller:ContollerTemplate::class,method:'Signin'),
                new Route(uri:'/signup',contoller:ContollerTemplate::class,method:'Signup'),
                new Route(uri:'/forgotpassword',contoller:ContollerTemplate::class,method:'Forgotpassword'),



                new Route(uri:'/getevents', contoller:EventController::class,method:'Find',parametres:['offset'=>"string"]),
                new Route(uri:'/tickets', contoller:TicketController::class,method:'getTicketsByEvent',parametres:['event_id'=>"string"]),
                new Route(uri:'/statistics', contoller:UserController::class, method:'Statistics'),
                new Route(uri:'/org_dashboard', contoller:ContollerTemplate::class, method:'Org_Dashboard'),
                new Route(uri:'/platform', contoller:ContollerTemplate::class, method:'Platform')


            ],
            'POST' => [
                new Route(uri:'/testpost', contoller:ContollerTemplate::class ,method:'Test', parametres:[
                    'name' => 'int'
                ]),
                new Route(uri:'/register', contoller:UserController::class, method:'signup'),
                new Route(uri:'/login', contoller:UserController::class, method:'login'),
                new Route(uri:'/booking', contoller:TicketController::class, method:'create', parametres:[
                    "ticketid" => 'int' , "userId" => 'int'
                ])
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