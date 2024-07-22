<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;

class UserRepository
{
    public function create_user(User $user): User
    {
        return $user;
    }
}
