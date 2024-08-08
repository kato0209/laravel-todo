<?php

namespace App\Application\Usecase;

require_once __DIR__ . '/../../Infrastructure/Repository/User.php';

use App\Domain\Entity\User;
use App\Infrastructure\Repository\UserRepository;

class UserUsecase
{
    public function create_user(User $user): User
    {
        $user->hashPassword();
        $userRepository = new UserRepository;
        $user = $userRepository->create_user($user);

        return $user;
    }

    public function get_user_by_id(int $userID): User
    {
        $userRepository = new UserRepository;
        $user = $userRepository->get_user_by_id($userID);

        return $user;
    }
}
