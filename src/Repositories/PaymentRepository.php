<?php
namespace App\Repositories;

use App\Core\Database;
use App\Models\Payment;

class PaymentRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function addPayment(Payment $payment)
    {
        $sql = "INSERT INTO booking (ticketId, userId, payment_id, payment_status, payment_amount) 
                VALUES (:ticketId, :userId, :payment_id, :payment_status, :payment_amount)";

        try {
            $stmt = $this->db->prepare($sql);
            
            $stmt->execute([
                ':ticketId' => $payment->getTicketId(),
                ':userId' => $payment->getUserId(),
                ':payment_id' => $payment->getPaymentId(),
                ':payment_status' => $payment->getPaymentStatus(),
                ':payment_amount' => $payment->getPaymentAmount(),
            ]);

            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw new \Exception("Error adding payment: " . $e->getMessage());
        }
    }
}