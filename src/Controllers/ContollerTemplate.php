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
    public function Events(){
        $getAllEvents = new EventRepository();
        $count = $getAllEvents->getEventnumber();
        $offset = isset($_GET["page"]) ? $_GET["page"] : 8;
        $events = $getAllEvents->findAll($offset);
        
        echo $this->twig->render('client/events.twig',[
            "events" => $events,
            "count" => $count,
        ]);
    }
    public function Test(){
        echo 'Welcome to test';
    }
    public function Dbconnection(){
        Database::getConnection();
    }
}