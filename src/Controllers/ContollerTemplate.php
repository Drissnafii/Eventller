<?php

namespace App\Controllers;

use App\Controllers\TwigController;
use App\Core\Database;
class ContollerTemplate extends TwigController{
    
    public function Home(){
        //echo $this->twig->render('client/home.twig', []);
        $Database = new Database();
        $Database->getConnection();
        // phpinfo();

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
}