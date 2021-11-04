<?php

namespace Micx\Key4s\Manager;

use Firebase\JWT\JWT;
use Lack\OidServer\Base\Interface\JwtBuilderInterface;

class JwtManagerFirebase implements JwtBuilderInterface
{


    public function __construct (
        private string $key,
        private string $method
    ) {}



    public function buildJwtToken(array $claims): string
    {
        $payload = [
            "iss" => "xy",
            "aud" => "",
            "nbf" => time() - 600,
            "iat" => time(),
            "exp" => time() + $this->getExpiresIn()
        ];
        foreach ($claims as $key => $value) {
            $payload[$key] = $value;
        }

        return JWT::encode($payload, $this->key, $this->method);
    }

    public function getExpiresIn(): int
    {
        return 3600;
    }
}
