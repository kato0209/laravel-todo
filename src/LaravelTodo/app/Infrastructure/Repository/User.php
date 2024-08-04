<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;
use App\Infrastructure\Models\Users;

class UserRepository
{
    public function create_user(User $user): User
    {
        $userModel = new Users;
        $isExist = $userModel->where('email', $user->email)->exists();
        if ($isExist) {
            throw new \Exception('User already exists');
        }
        $userObj = $userModel->create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $user->id = $userObj->id;
        $user->createdAt = $userObj->created_at;
        $user->updatedAt = $userObj->updated_at;

        return $user;
    }
}
