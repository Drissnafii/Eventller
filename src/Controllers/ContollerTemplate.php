<?php
namespace App\Controllers;
use App\Repositories\EventRepository;
use App\Controllers\TwigController;
use App\Core\Database;

class ContollerTemplate extends TwigController{
    
    public function Home(){
        echo $this->twig->render('client/home.twig', []);
    }
    public function Signin(){
        echo $this->twig->render('client/signin.twig', []);
    }
    public function Signup(){
        echo $this->twig->render('client/signup.twig', []);
    }
    public function Forgotpassword(){
        echo $this->twig->render('client/forgotpassword.twig', []);
    }
    public function Dashboard(){
        echo $this->twig->render('admin/dashborad.twig', []);
    }
    public function events(){
        echo $this->twig->render('client/events.twig',[]);
    }    
    public function payment(){
        $event = new EventRepository();
        $data = $event->findById($_GET['eventId']);
        echo $this->twig->render('client/payment.twig',[
            'event'=>$data
        ]);
    }    
    public function eventdet(){
        $event = new EventRepository();
        $data = $event->findById($_GET['eventId']);
        echo $this->twig->render('client/eventdet.twig',[
            'event'=>$data
        ]);
    }
    public function Test(){
        echo 'Welcome to test';
    }
    public function Dbconnection(){
        Database::getConnection();
    }
}
