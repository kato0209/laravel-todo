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

#[OA\Schema(schema: "CreateUserOutput", type: "object", required: ['email', 'name'])]
final class CreateUserOutput
{
    public string $email;
    public string $name;

    public function __construct(string $email, string $name)
    {
        $this->email = $email;
        $this->name = $name;
    }
}
