<?php
declare(strict_types=1);

namespace App\Repositories;

class LeadRepository
{
    public function findById(int $id) : array
    {
        return [
            'id' => $id,
            'name' => 'lead',
        ];
    }
}
