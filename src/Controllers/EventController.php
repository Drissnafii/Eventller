<?php

class Event {

    private int $id;
    private string $title;
    private string $image;
    private string $description;
    private DateTime $date;
    private string $location;
    private int $places;
    private string $categorie;

    public function __construct(
        int $id,
        string $title,
        string $image,
        string $description,
        DateTime $date,
        string $location,
        int $places,
        string $categorie
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->description = $description;
        $this->date = $date;
        $this->location = $location;
        $this->places = $places;
        $this->categorie = $categorie;
    }

    public function getId(): int {return $this->id;}
    public function getTitle(): string {return $this->title;}
    public function getImage(): string {return $this->image;}
    public function getDescription(): string {return $this->description;}
    public function getDate(): DateTime {return $this->date;}
    public function getLocation(): string {return $this->location;}
    public function getPlaces(): int {return $this->places;}
    public function getCategorie(): string {return $this->categorie;}
}

?>


<?php
class EventRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function create(Event $event): bool {
        $sql = "INSERT INTO events (title, description, location, datetime, image, userId) 
                VALUES (:title, :description, :location, :datetime, :image, :userId)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'title' => $event->getTitle(),
            'description' => $event->getDescription(),
            'location' => $event->getLocation(),
            'datetime' => $event->getDate()->format('Y-m-d H:i:s'),
            'image' => $event->getImage(),
            'userId' => 1  // You'll need to implement user authentication
        ]);
    }

    public function findById(int $id): ?Event {
        $sql = "SELECT * FROM events WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Event(
                $row['id'],
                $row['title'],
                $row['image'],
                $row['description'],
                new DateTime($row['datetime']),
                $row['location'],
                0, // places is not in database
                '' // category is not in database
            );
        }
        return null;
    }

    public function findAll(): array {
        if(isset($_GET["limit"]) && isset($_GET["offset"])){
            $limit = $_GET["limit"];
            $offset = $_GET["offset"];
            $sql = "SELECT * FROM events LIMIT $limit OFFSET $offset";
        } else {
            $sql = "SELECT * FROM events";
        }
        $sql = "SELECT * FROM events";
        $stmt = $this->db->query($sql);
        $events = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = new Event(
                $row['id'],
                $row['title'],
                $row['image'],
                $row['description'],
                new DateTime($row['datetime']),
                $row['location'],
                0, // places is not in database
                '' // category is not in database
            );
        }
        return $events;
    }
}

