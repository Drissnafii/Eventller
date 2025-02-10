<?php

namespace Repositories;

use Core\Database;
use PDO;
use DateTime;
use Event;

class EventRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll(): array {
        $query = "SELECT * FROM events";
        $stmt = $this->db->query($query);
        $events = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $this->createEventFromRow($row);
        }

        return $events;
    }

    public function findById(int $id): ?Event {
        $query = "SELECT * FROM events WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->createEventFromRow($row) : null;
    }

    public function create(Event $event): bool {
        $query = "INSERT INTO events (title, image, description, datetime, location, places, category_id) 
                 VALUES (:title, :image, :description, :datetime, :location, :places, :category_id)";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'title' => $event->getTitle(),
            'image' => $event->getImage(),
            'description' => $event->getDescription(),
            'datetime' => $event->getDate()->format('Y-m-d H:i:s'),
            'location' => $event->getLocation(),
            'places' => $event->getPlaces(),
            'category_id' => $event->getCategorie()
        ]);
    }

    public function update(Event $event): bool {
        $query = "UPDATE events 
                 SET title = :title, image = :image, description = :description, 
                     datetime = :datetime, location = :location, places = :places, 
                     category_id = :category_id 
                 WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        
        return $stmt->execute([
            'id' => $event->getId(),
            'title' => $event->getTitle(),
            'image' => $event->getImage(),
            'description' => $event->getDescription(),
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

    private function createEventFromRow(array $row): Event {
        return new Event(
            $row['id'],
            $row['title'],
            $row['image'],
            $row['description'],
            new DateTime($row['datetime']),
            $row['location'],
            $row['places'],
            $row['category_id']
        );
    }
}