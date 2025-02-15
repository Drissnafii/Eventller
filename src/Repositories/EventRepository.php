<?php
namespace App\Repositories;

use App\Core\Database;
use PDO;
use DateTime;
use App\Models\Event;
use App\Repositories\Interfaces\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll(int $offset): array {
        $query = "SELECT 
                    e.id,
                    e.title,
                    e.image,
                    e.location,
                    c.name as category,
                    TO_CHAR(e.datetime, 'YYYY-MM-DD HH:MI') as date,
                    t.price
                FROM events e
                LEFT JOIN categories c ON e.category_id = c.id
                LEFT JOIN tickets t ON e.id = t.eventId
                LIMIT 6 OFFSET :offset";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', ($offset - 1) * 6, PDO::PARAM_INT);
        $stmt->execute();
        
        $events = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = [
                "id" => $row['id'],
                "title" => $row['title'],
                "image" => $row['image'],
                "date" => $row['date'],
                "location" => $row['location'],
                "category" => $row['category']
            ];
        }

        return [
            "count" => $this->getEventnumber(),
            "events" => $events
        ];
    }

    public function findById(int $id): ?array {
        $query = "SELECT 
                    e.id,
                    e.title,
                    e.description,
                    e.image,
                    e.datetime,
                    e.location,
                    e.places,
                    t.price,
                    c.name AS category,
                    COALESCE(
                        (SELECT COUNT(*) 
                        FROM booking b 
                        JOIN tickets tk ON b.ticketId = tk.id 
                        WHERE tk.eventId = e.id
                    ), 0) as booked_places,
                    CASE 
                        WHEN e.places > 0 THEN 
                            ROUND((COALESCE(
                                (SELECT COUNT(*) 
                                FROM booking b 
                                JOIN tickets tk ON b.ticketId = tk.id 
                                WHERE tk.eventId = e.id
                            ), 0) * 100.0 / e.places), 2)
                        ELSE 100
                    END as percentage
                FROM events e
                LEFT JOIN categories c ON e.category_id = c.id
                LEFT JOIN tickets t ON e.id = t.eventId
                WHERE e.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) return null;

        $remainingPlaces = $row['places'] - $row['booked_places'];

        return [
            "id" => $row['id'],
            "title" => $row['title'],
            "description" => $row['description'],
            "image" => $row['image'],
            "date" => $row['datetime'],
            "places" => $remainingPlaces,
            "price" => $row['price'],
            "location" => $row['location'],
            "percentage" => $row['percentage'],
            "category" => $row['category']
        ];
    }

    public function getEventnumber(): int {
        $query = "SELECT COUNT(*) FROM events";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function create(Event $event): bool {
        $query = "INSERT INTO events (title, description, image, datetime, location, places, category_id) 
                 VALUES (:title, :description, :image, :datetime, :location, :places, :category_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'title' => $event->getTitle(),
            'description' => $event->getDescription(),
            'image' => $event->getImage(),
            'datetime' => $event->getDate()->format('Y-m-d H:i:s'),
            'location' => $event->getLocation(),
            'places' => $event->getPlaces(),
            'category_id' => $event->getCategorie()
        ]);
    }

    public function update(Event $event): bool {
        $query = "UPDATE events SET title = :title, description = :description, image = :image, 
                 datetime = :datetime, location = :location, places = :places, category_id = :category_id 
                 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'id' => $event->getId(),
            'title' => $event->getTitle(),
            'description' => $event->getDescription(), 
            'image' => $event->getImage(),
            'datetime' => $event->getDate()->format('Y-m-d H:i:s'),
            'location' => $event->getLocation(),
            'places' => $event->getPlaces(),
            'category_id' => $event->getCategorie()
        ]);
    }

    public function delete(int $id): bool {
        $query = "DELETE FROM events WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
