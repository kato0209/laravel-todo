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

    public function get_user_by_email(string $email): User
    {
        $userModel = new Users;
        $userObj = $userModel->where('email', $email)->first();
        if (!$userObj) {
            throw new \Exception('User not found');
        }

        $user = new User;
        $user->id = $userObj->id;
        $user->name = $userObj->name;
        $user->email = $userObj->email;
        $user->password = $userObj->password;
        $user->createdAt = $userObj->created_at;
        $user->updatedAt = $userObj->updated_at;

        return $user;
    }
}
