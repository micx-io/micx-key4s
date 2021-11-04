<?php


namespace Micx\Key4s\UserManager;



use Lack\OidServer\Base\Interface\TokenManagerInterface;
use Lack\OidServer\Base\Type\T_Q_Authorize;

class RedisTokenManager implements TokenManagerInterface {

    const TOKEN_SUFFIX = "_token";

    public function __construct (
        private \Redis $client
    ){}


    public function storeCode(string $code, T_Q_Authorize $authorize)
    {
        $this->client->setex($code . self::TOKEN_SUFFIX, 60, serialize($authorize));
    }

    public function getByCode(string $code): ?T_Q_Authorize
    {
        $result = $this->client->getSet($code . self::TOKEN_SUFFIX, null);
        return unserialize($result, [
            "allowed_classes" => [T_Q_Authorize::class]
        ]);
    }

}
