<?php

namespace App\Utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTManager
{

    public static string $signer = 'HS256';

    public function encode(int $userID): string
    {
        $key = env('JWT_SECRET');
        $issuedAt = time();
        $expirationTime = $issuedAt + (2 * 365 * 24 * 60 * 60);

        $payload = [
            'userID' => $userID,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        ];
        return JWT::encode($payload, $key, self::$signer);
    }

    public function decode(string $jwt): array
    {
        $key = env('JWT_SECRET');
        return (array) JWT::decode($jwt, new Key($key, self::$signer));
    }
}
