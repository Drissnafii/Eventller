<?php

namespace App\Models;


class Booking{

    public $ticketid;
    public $userid;
    public $paymentdetails;
    
    public function __construct($ticketid=null , $userid=null ,$paymentdetails=null)
    {
        $this->ticketid= $ticketid;
        $this->userid= $userid;
        $this->paymentdetails= $paymentdetails;
    }
}


?>