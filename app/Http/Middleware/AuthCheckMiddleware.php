<?php

namespace App\Http\Middleware;

use App\Services\AuthKeyService;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');

        if ($token) {
            $publicKey = app(AuthKeyService::class)->getPublicKey();

            list($tokenType, $jwt) = explode(' ', $token);

            try {
                $decoded = JWT::decode($jwt, new Key($publicKey, 'RS256'));

                return $next($request);
            } catch (Exception) {
            }
        }

        return response(['message' => 'Unauthorized 401'], Response::HTTP_UNAUTHORIZED);
    }
}
