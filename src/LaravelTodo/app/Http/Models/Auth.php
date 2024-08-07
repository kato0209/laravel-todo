<?php

namespace App\Http\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(schema: "LoginInput", type: "object", required: ['email', 'password'])]
final class LoginInput
{
    #[OA\Property(type: "string")]
    public string $email;

    #[OA\Property(type: "string")]
    public string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
