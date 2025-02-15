<?php

namespace App\Models;

class Payment
{
    private $id;
    private $ticketId;
    private $userId;
    private $payment_id;
    private $payment_status;
    private $payment_amount;
    private $payment_date;

    public function __construct(
        $ticketId = null,
        $userId = null,
        $payment_id = null,
        $payment_status = null,
        $payment_amount = null,
        $payment_date = null
    ) {
        $this->ticketId = $ticketId;
        $this->userId = $userId;
        $this->payment_id = $payment_id;
        $this->payment_status = $payment_status;
        $this->payment_amount = $payment_amount;
        $this->payment_date = $payment_date;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getTicketId() { return $this->ticketId; }
    public function getUserId() { return $this->userId; }
    public function getPaymentId() { return $this->payment_id; }
    public function getPaymentStatus() { return $this->payment_status; }
    public function getPaymentAmount() { return $this->payment_amount; }
    public function getPaymentDate() { return $this->payment_date; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setTicketId($ticketId) { $this->ticketId = $ticketId; }
    public function setUserId($userId) { $this->userId = $userId; }
    public function setPaymentId($payment_id) { $this->payment_id = $payment_id; }
    public function setPaymentStatus($payment_status) { $this->payment_status = $payment_status; }
    public function setPaymentAmount($payment_amount) { $this->payment_amount = $payment_amount; }
    public function setPaymentDate($payment_date) { $this->payment_date = $payment_date; }
}