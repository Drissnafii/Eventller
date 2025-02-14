<?php

namespace App\Repositories\Interfaces;
use App\Models\Ticket;

interface TicketRepositoryInterface
{
    /** 
     * Find ticket by ID
     */
    public function findById(int $id);
    
    /**
     * Create new ticket
     */
    public function create($data);
    
    /**
     * Get tickets by event ID
     */
    public function findByEventId(int $eventId): array;
    
    /**
     * Get tickets by organizer ID
     */
    public function findByOriganisatorId(int $origanisatorId): array;
    
    /**
     * Get all tickets
     */
    public function getAll(): array;
}
