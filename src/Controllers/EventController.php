<?php

namespace App\Controllers;
use App\Repositories\EventRepository;
class EventController{

    /**
     * Find all events
     * 
     */
    public function Find(){
        $getAllEvents = new EventRepository();
        $response = $getAllEvents->findAll($_GET['offset']);
        echo json_encode($response);
    }
}