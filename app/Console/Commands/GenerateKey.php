<?php

namespace App\Console\Commands;

use App\Services\AuthKeyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that generates private and public keys and saves it in the root of project';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $privateKey = openssl_pkey_new(array(
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA
        ));

        openssl_pkey_export($privateKey, $privateKeyPem);

        $privateKeyResource = openssl_pkey_get_private($privateKey);
        $publicKeyDetails = openssl_pkey_get_details($privateKeyResource);
        $publicKey = $publicKeyDetails['key'];

        $this->saveKeys($privateKeyPem, $publicKey);

        $this->components->info('Successfully generated keys!');
    }

    protected function saveKeys($privateKey, $publicKey): void
    {
        /** @var AuthKeyService $authKeyService */
        $authKeyService = app(AuthKeyService::class);

        $authKeyService
            ->setPrivateKey($privateKey)
            ->setPublicKey($publicKey);
    }
}
