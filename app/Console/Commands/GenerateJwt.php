<?php

namespace App\Console\Commands;

use App\Services\AuthKeyService;
use Firebase\JWT\JWT;
use Illuminate\Console\Command;

class GenerateJwt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-jwt {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that generates jwt key based on your private key';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        /** @var AuthKeyService $authService */
        $authService = app(AuthKeyService::class);

        $privateKey = $authService->getPrivateKey();
        $issuedAt = now()->getTimestamp();
        $expireAt = now()->addSeconds(config('auth.expiration'))->getTimestamp();
        $domain = config('app.domain');
        $username = $this->argument('username');

        $data = [
            'iat'  => $issuedAt,
            'iss'  => $domain,
            'nbf'  => $issuedAt,
            'exp'  => $expireAt,
            'userName' => $username,
        ];

        $token = JWT::encode(
            $data,
            $privateKey,
            'RS256'
        );

        $this->line($token);
    }
}
