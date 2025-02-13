<?php
namespace App\Controllers;
use App\Repositories\EventRepository;
use App\Controllers\TwigController;
use App\Core\Database;

class ContollerTemplate extends TwigController
{
    public function Home(){
        echo $this->twig->render('client/Home.twig', []);
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
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        $offset = isset($_GET["offset"]) ? $_GET["offset"] : 0;
        $events = $getAllEvents->findAll($limit, $offset);
        
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