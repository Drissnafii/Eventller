<?php

namespace App\Controllers;

use App\Controllers\TwigController;

class ContollerTemplate extends TwigController{
    
    public function Home(){
        echo $this->twig->render('admin/dashborad.twig', []);
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
        echo $this->twig->render('client/index.twig', []);
    }
}