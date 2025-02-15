<?php

namespace App\Controllers;

use App\Models\Payment;
use App\Repositories\PaymentRepository;


class PaymentController
{
    private $paymentRepository;

    public function __construct()
    {
        $this->paymentRepository = new PaymentRepository();
    }

    public function CreatePayment($ticketId, $userId, $paymentDetails)
    {
        try {
            $payment = [
                'ticketId' => $ticketId,
                'userId' => $userId,
                'payment_id' => $paymentDetails->id,
                'payment_status' => $paymentDetails->status,
                'payment_amount' => $paymentDetails->purchase_units[0]->amount->value
            ];

            $paymentModel = new Payment();
            $paymentModel->setTicketId($payment['ticketId']);
            $paymentModel->setUserId($payment['userId']);
            $paymentModel->setPaymentId($payment['payment_id']);
            $paymentModel->setPaymentStatus($payment['payment_status']);
            $paymentModel->setPaymentAmount($payment['payment_amount']);
            
            $result = $this->paymentRepository->addPayment($paymentModel);

            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Payment processed successfully'
                ];
            }

            return [
                'success' => false,
                'message' => 'Failed to process payment'
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }


}