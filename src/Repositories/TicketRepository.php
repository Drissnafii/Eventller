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
    public function findByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT t.*, e.title as event_name, e.datetime as event_date, e.location as event_location, 
                   e.description as event_description, e.image as event_image,
                   b.payment_amount as amount, b.payment_status as status, b.payment_date, b.payment_date as booking_date 
            FROM tickets t
            INNER JOIN booking b ON b.ticketId = t.id
            INNER JOIN events e ON e.id = t.eventId
            WHERE b.userId = ?
        ");
        $stmt->execute([$userId]);
        $array = [];
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $ticket) {
            $array[] = [
                "id" => $ticket["id"],
                "eventid" => $ticket["eventid"],
                "event_name" => $ticket["event_name"],
                "event_date" => $ticket["event_date"],
                "event_location" => $ticket["event_location"],
                "event_description" => $ticket["event_description"],
                "event_image" => $ticket["event_image"],
                "price" => $ticket["price"],
                "payment_amount" => $ticket["amount"],
                "payment_status" => $ticket["status"],
                "payment_date" => $ticket["payment_date"],
                "booking_date" => $ticket["booking_date"]
            ];
        }
        return $array;
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

    public function create(array $data): Ticket
    {
        $stmt = $this->db->prepare("
            INSERT INTO tickets (eventId, price, origanisatorId, places)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['eventId'],
            $data['price'],
            $data['origanisatorId'],
            $data['places']
        ]);

        $data['id'] = $this->db->lastInsertId();
        return $this->createTicketFromArray($data);
    }

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
        $ticket->setEventId($data['eventId']);
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
