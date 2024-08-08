<?php

namespace App\Utils\JWTManager;

use Firebase\JWT\JWT;

class JWTManager
{

    private string $signer = 'HS256';

    public static function encode(int $userID): string
    {
        $key = env('JWT_SECRET');
        $issuedAt = time();
        $expirationTime = $issuedAt + (2 * 365 * 24 * 60 * 60);

        $payload = [
            'userID' => $userID,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        ];
        return JWT::encode($payload, $key, $signer);
    }

    public static function decode(string $jwt): array
    {
        $key = env('JWT_SECRET');
        return (array) JWT::decode($jwt, $key, $signer);
    }
}
