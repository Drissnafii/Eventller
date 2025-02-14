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

    public function findById(int $id): ?Ticket
    {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if (!$result) {
            return null;
        }
        $array = [];
        print_r($result[0]);
        foreach ($result as $ticket) {
            $array[] = [
                "id" => $ticket["id"],
                "eventid" => $ticket["eventId"],
                "price" => $ticket["price"],
                "places" => $ticket["places"]
            ];
        }
        return $array;
    }

    public function create($data)
    {
        var_dump($data);
        //try jsondecode for paymentdetails

        
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
