<?php
namespace App\Controllers;

use App\Models\Ticket;
use App\Models\Booking;
use App\Repositories\TicketRepository;

class TicketController
{
    private $ticketRepository;

    public function __construct()
    {
        $this->ticketRepository = new TicketRepository();
    }

    public function index()
    {
        return $this->ticketRepository->getAll();
    }

    public function show(int $id)
    {
        $ticket = $this->ticketRepository->findById($id);
        if (!$ticket) {
            return ['error' => 'Ticket not found'];
        }
        return $ticket;
    }

    public function create()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $paymentDetails =$data['paymentDetails'];
        $ticketid = $data['ticketid'];
        $userId = $data['userId'];
        try {
            $Booking = new Booking(userid: $userId ,paymentdetails: $paymentDetails,ticketid: $ticketid );
            return $this->ticketRepository->create($Booking);
        } catch (\Exception $e) {
            return ['error' => 'Failed to create ticket: ' . $e->getMessage()];
        }
    }

    public function getTicketsByEvent()
    {
        try {
            $tickets = $this->ticketRepository->findByEventId($_GET["event_id"]);
            header('Content-Type: application/json');
            echo json_encode($tickets);
            
        } catch (\Exception $e) {
            header('Content-Type: application/json');

            echo json_encode(['error' => 'Failed to fetch tickets: ' . $e->getMessage()]);
        }
    }

    public function getTicketsByOriganisator(int $origanisatorId)
    {
        try {
            $tickets = $this->ticketRepository->findByOriganisatorId($origanisatorId);
            return array_map(function($ticket) {
                return $ticket->toArray();
            }, $tickets);
        } catch (\Exception $e) {
            return ['error' => 'Failed to fetch tickets: ' . $e->getMessage()];
        }
    }
}