<?php

namespace App\Models;

class Ticket {
    private $id;
    private $eventId;
    private $userId;
    private $payment_id;
    private $payment_status;
    private $payment_amount;
    private $payment_date;

    public function getId() {return $this->id;}
    public function getEventId() {return $this->eventId;}
    public function setEventId($eventId) {$this->eventId = $eventId;}
    public function getUserId() {return $this->userId;}
    public function setUserId($userId) {$this->userId = $userId;}
    public function getPaymentId() {return $this->payment_id;}
    public function setPaymentId($payment_id) {$this->payment_id = $payment_id;}
    public function getPaymentStatus() {return $this->payment_status;}
    public function setPaymentStatus($payment_status) {$this->payment_status = $payment_status;}
    public function getPaymentAmount() {return $this->payment_amount;}
    public function setPaymentAmount($payment_amount) {$this->payment_amount = $payment_amount;}
    public function getPaymentDate() {return $this->payment_date;}
    public function setPaymentDate($payment_date) {$this->payment_date = $payment_date;}

    public function toArray() {
        return [
            'id' => $this->id,
            'eventId' => $this->eventId,
            'userId' => $this->userId,
            'payment_id' => $this->payment_id,
            'payment_status' => $this->payment_status,
            'payment_amount' => $this->payment_amount,
            'payment_date' => $this->payment_date
        ];
    }
}