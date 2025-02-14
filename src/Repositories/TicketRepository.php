<?php
namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Core\Database;

class TicketRepository implements TicketRepositoryInterface
{
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if (!$result) {
            return null;
        }
        return $array[] = [
            "id" => $result["id"],
            "eventid" => $result["eventid"],
            "price" => $result["price"],
            "places" => $result["places"]
        ];
    }

    public function create($data)
    {
        echo 'ticketid . '.$data->ticketid . '<br>';
        echo 'userid . '.$data->userid . '<br>';
            // $paymentdetails = json_decode($data["paymentdetails"]);
        echo 'id : '.isset($data->paymentdetails['id']) ? $data->paymentdetails['id'] : ' id not provide' ;
        echo 'status : '.isset($data->paymentdetails['status']) ? $data->paymentdetails['status'] : ' status not provide' ;
        echo 'payer : '.isset($data->paymentdetails['payer']) ? $data->paymentdetails['payer']['email_address'] : ' email_address not provide';
        echo 'create_time : '.isset($data->paymentdetails["create_time"]) ? $data->paymentdetails['create_time'] : ' create_time not provide';
        
        // $stmt = $this->db->prepare("
        //     INSERT INTO booking (ticketId,  userId, payment_status)
        //     VALUES (?, ?, ?)
        // ");

        // $stmt->execute([
        //     $data['eventId'],
        //     $data['price'],
        //     $data['origanisatorId'],
        //     $data['places']
        // ]);

        // $data['id'] = $this->db->lastInsertId();
        // return $this->createTicketFromArray($data);

    }

    // CREATE TABLE booking (
    //     id SERIAL PRIMARY KEY,
    //     ticketId INT,
    //     userId INT,
    //     payment_id VARCHAR(255) NULL,
    //     payment_status VARCHAR(50) NULL,
    //     payment_amount DECIMAL(10,2) NULL,
    //     payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    //     FOREIGN KEY (ticketId) REFERENCES tickets(id) ON DELETE CASCADE
    // );
    public function findByEventId(int $eventId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE eventId = ?");
        $stmt->execute([$eventId]);
        $array = [];
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $ticket) {
            $array[] = [
                "id" => $ticket["id"],
                "eventid" => $ticket["eventid"],
                "price" => $ticket["price"],
                "places" => $ticket["places"]
            ];
        }
        return $array;
    }

    public function findByOriganisatorId(int $origanisatorId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE origanisatorId = ?");
        $stmt->execute([$origanisatorId]);
        return $this->createTicketsFromResults($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM tickets");
        return $this->createTicketsFromResults($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    private function createTicketFromArray(array $data): Ticket
    {
        $ticket = new Ticket();
        $ticket->setEvent($data['eventId']);
        $ticket->setPrice($data['price']);
        $ticket->setOriganisatorId($data['origanisatorId']);
        $ticket->setPlaces($data['places']);
        return $ticket;
    }

    private function createTicketsFromResults(array $results): array
    {
        return array_map(function ($result) {
            return $this->createTicketFromArray($result);
        }, $results);
    }
}
