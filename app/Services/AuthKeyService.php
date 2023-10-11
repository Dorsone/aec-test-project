<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class AuthKeyService
{
    const PUBLIC_KEY_PATH = 'auth/public_key.pem';
    const PRIVATE_KEY_PATH = 'auth/private_key.pem';

    public function getPublicKey(): ?string
    {
        return $this->get(self::PUBLIC_KEY_PATH);
    }

    public function getPrivateKey(): ?string
    {
        return $this->get(self::PRIVATE_KEY_PATH);
    }

    public function setPrivateKey(string $content): static
    {
        $this->set(self::PRIVATE_KEY_PATH, $content);

        return $this;
    }

    public function setPublicKey(string $content): static
    {
        $this->set(self::PUBLIC_KEY_PATH, $content);

        return $this;
    }

    protected function get(string $path): ?string
    {
        return Storage::get($path);
    }

    protected function set(string $path, string $content): bool
    {
        return Storage::put($path, $content);
    }
}
