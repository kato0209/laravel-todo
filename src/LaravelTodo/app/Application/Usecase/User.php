<?php

namespace App\Application\Usecase;

use App\Domain\Entity\User;
use App\Infrastructure\Repository\UserRepository;

class UserUsecase
{
    public function create_user(User $user): User
    {
        $user = UserRepository.create_user($user);

        return $user;
    }
}
