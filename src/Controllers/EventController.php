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
