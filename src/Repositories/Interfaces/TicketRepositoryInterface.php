<?php

namespace App\Repositories\Interfaces;
use App\Models\Ticket;

interface TicketRepositoryInterface
{
    /**
     * Find ticket by ID
     */
    public function findById(int $id): ?Ticket;
    
    /**
     * Create new ticket
     */
    public function create(array $data): Ticket;

    
    /**
     * Get tickets by event ID
     */
    public function findByEventId(int $eventId): array;
    
    /**
     * Get tickets by user ID
     */
    public function findByUserId(int $userId): array;
    
    /**
     * Get tickets by payment status
     */
    public function findByPaymentStatus(string $status): array;
    
    /**
     * Get all tickets
     */
    public function getAll(): array;
}