<?php

namespace Micx\Key4s\Manager;

use Lack\OidServer\Base\Interface\ClaimManagerInterface;
use Lack\OidServer\Base\Interface\ClientInterface;
use Lack\OidServer\Base\Interface\UserInterface;

class ClaimsManager implements ClaimManagerInterface
{

    public function getScopes(ClientInterface $client, UserInterface $user = null, array $scopes = []): array
    {

        return [
            "uid" => $user->getUid(),
        ];
    }
}
