<?php

namespace App\Http\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(schema: "CreateUserInput", type: "object", required: ['email', 'name', "password"])]
final class CreateUserInput
{
    #[OA\Property(type: "string")]
    public string $email;

    #[OA\Property(type: "string")]
    public string $name;

    #[OA\Property(type: "string")]
    public string $password;

    public function __construct(string $email, string $name, string $password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }
}

#[OA\Schema(schema: "User", type: "object", required: ['UserID', 'email', 'name'])]
final class User
{
    #[OA\Property(type: "integer")]
    public int $UserID;

    #[OA\Property(type: "string")]
    public string $email;

    #[OA\Property(type: "string")]
    public string $name;

    public function __construct(int $UserID, string $email, string $name)
    {
        $this->UserID = $UserID;
        $this->email = $email;
        $this->name = $name;
    }
}
