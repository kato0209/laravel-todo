<?php

namespace App\Http\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(schema: "CreateUserInput", type: "object", required: ['email', 'name', "password"])]
final class CreateUserInput
{
    public string $email;
    public string $name;
    public string $password;

    public function __construct(string $email, string $name, string $password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }
}

#[OA\Schema(schema: "CreateUserOutput", type: "object", required: ['id', 'email', 'name'])]
final class CreateUserOutput
{
    public int $id;
    public string $email;
    public string $name;

    public function __construct(int $id, string $email, string $name)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
    }
}
