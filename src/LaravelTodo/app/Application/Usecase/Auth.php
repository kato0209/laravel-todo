<?php

namespace App\Application\Usecase;

require_once __DIR__ . '/../../Infrastructure/Repository/User.php';

use App\Domain\Entity\User;
use App\Infrastructure\Repository\UserRepository;

class AuthUsecase
{
    public function login(User $user): User
    {
        $userRepository = new UserRepository;
        $existingUser = $userRepository->get_user_by_email($user->email);

        if (!password_verify($user->password, $existingUser->password)) {
            throw new \Exception('Invalid password');
        }

        return $existingUser;
    }
}
