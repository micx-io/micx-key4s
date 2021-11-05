<?php

namespace Micx\Key4s\Manager;

use Lack\OidServer\Base\Interface\ClaimManagerInterface;
use Lack\OidServer\Base\Interface\ClientInterface;
use Lack\OidServer\Base\Interface\UserInterface;

class ClaimManager implements ClaimManagerInterface
{

    public function __construct(
        private string $iss,
        private int $token_ttl = 3600
    ){}


    public function validateScopes(ClientInterface $client, UserInterface $user = null, array $scopes = []): void
    {
        foreach ($scopes as $scope)
            if ( ! in_array($scope, ["openid", "profile", "email"]))
                throw new \InvalidArgumentException("Invalid scope '$scope'");
    }

    public function getIdClaims(ClientInterface $client, UserInterface $user = null, array $scopes = []): array
    {
        $payload = [
            "sub" => $user?->getUid(),
            "iss" => $this->iss,
            "aud" => $client->getClientId(),
            "exp" => $this->token_ttl + time(),
            "iat" => time()
        ];

        if (in_array("profile", $scopes)) {
            $payload["name"] = $user->name ?? null;
            $payload["family_name"] = $user->family_name ?? null;
            $payload["given_name"] = $user->given_name ?? null;
            $payload["nickname"] = $user->nickname ?? null;
            $payload["picture"] = $user->picture ?? null;
            $payload["updated_at"] = $user->updated_at ?? null;
        }

        if (in_array("email", $scopes)) {
            $payload["email"] = $user->email ?? null;
            $payload["email_verified"] = $user->email_verified ?? null;
        }

        return $payload;
    }

    public function getAccessClaims(ClientInterface $client, UserInterface $user = null, array $scopes = []): array
    {
        $payload = [
            "sub" => $user?->getUid(),
            "iss" => $this->iss,
            "aud" => $client->getClientId(),
            "exp" => $this->token_ttl + time(),
            "iat" => time()
        ];
        return $payload;
    }
}
