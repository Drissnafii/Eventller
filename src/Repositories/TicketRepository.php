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

        return $this->createTicketFromArray($result);
    }

    public function create(array $data): Ticket
    {
        $stmt = $this->db->prepare("
            INSERT INTO tickets (event_id, user_id, payment_id, payment_status, payment_amount, payment_date)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['eventId'],
            $data['userId'],
            $data['payment_id'],
            $data['payment_status'],
            $data['payment_amount'],
            $data['payment_date']
        ]);

        $data['id'] = $this->db->lastInsertId();
        return $this->createTicketFromArray($data);
    }

    public function findByEventId(int $eventId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE event_id = ?");
        $stmt->execute([$eventId]);
        return $this->createTicketsFromResults($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function findByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $this->createTicketsFromResults($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function findByPaymentStatus(string $status): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE payment_status = ?");
        $stmt->execute([$status]);
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
        $ticket->setEventId($data['event_id'] ?? $data['eventId']);
        $ticket->setUserId($data['user_id'] ?? $data['userId']);
        $ticket->setPaymentId($data['payment_id']);
        $ticket->setPaymentStatus($data['payment_status']);
        $ticket->setPaymentAmount($data['payment_amount']);
        $ticket->setPaymentDate($data['payment_date']);
        return $ticket;
    }

    private function createTicketsFromResults(array $results): array
    {
        return array_map(function ($result) {
            return $this->createTicketFromArray($result);
        }, $results);
    }
}