<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\JWTManager;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // AuthorizationヘッダーからBearerトークンを取り出す
        $authHeader = $request->header('Authorization');
        $jwt = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $jwt = $matches[1];
        }

        if ($jwt) {
            try {
                $jwtManager = new JWTManager;
                $decoded = $jwtManager->decode($jwt);

                $request->attributes->set('jwt', $decoded);
            } catch (Exception $e) {
                // トークンが無効な場合の処理
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['error' => 'jwt is not found'], 401);
        }

        return $next($request);
    }
}
