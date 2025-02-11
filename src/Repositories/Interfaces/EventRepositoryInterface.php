<?php

namespace App\Repositories\Interfaces;

use Event;

interface EventRepositoryInterface {
    public function findAll(int $limit, int $offset): array;
    public function findById(int $id): ?Event;
    public function create(Event $event): bool;
    public function update(Event $event): bool;
    public function delete(int $id): bool;
}