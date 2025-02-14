<?php
namespace App\Controllers;
use App\Repositories\EventRepository;
use App\Controllers\TwigController;
use App\Core\Database;
use App\Repositories\TicketRepository;

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
        $Repository = new EventRepository();
        // $Repository->Statistics();
        echo $this->twig->render('admin/dashborad.twig', []);
    }

    public function Admin_Events(){
        echo $this->twig->render('admin/events.twig', []);
    }
    public function Admin_Users(){
        echo $this->twig->render('admin/users.twig', []);
    }
    public function Org_Dashboard() {
        echo $this->twig->render('organisator/dashborad.twig', []);
    }
    public function Platform() {
        echo $this->twig->render("client/Home.twig");
    }

    public function Events(){
        // $eventdata = $event->findById($_GET['eventId']);
        // $data = $ticket->show($_GET['eventId']);

        // echo $this->twig->render('client/payment.twig',[
        //     'ticket'=>$data,
        //     'event'=>$eventdata

        // ]);
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
