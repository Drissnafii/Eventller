<?php

namespace App\Models;

class Ticket {
    private $id;
    private $eventId;
    private $price;
    private $origanisatorId;
    private $places;

    public function getId() {
        return $this->id;
    }

    public function getEventId() {
        return $this->eventId;
    }

    public function setEventId($eventId) {
        $this->eventId = $eventId;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getOriganisatorId() {
        return $this->origanisatorId;
    }

    public function setOriganisatorId($origanisatorId) {
        $this->origanisatorId = $origanisatorId;
    }

    public function getPlaces() {
        return $this->places;
    }

    public function setPlaces($places) {
        $this->places = $places;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'eventId' => $this->eventId,
            'price' => $this->price,
            'origanisatorId' => $this->origanisatorId,
            'places' => $this->places
        ];
    }
}