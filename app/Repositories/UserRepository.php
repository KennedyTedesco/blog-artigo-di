<?php
declare(strict_types=1);

namespace App\Repositories;

class UserRepository
{
    public function findById(int $id) : array
    {
        return [
            'id' => $id,
            'name' => 'user',
        ];
    }
}
