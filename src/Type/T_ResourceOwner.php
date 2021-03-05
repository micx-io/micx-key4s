<?php


namespace Micx\Key4s\Type;


use Lack\OidServer\Base\Manager\ResourceOwnerInterface;

class T_ResourceOwner implements ResourceOwnerInterface
{

    /**
     * @var string
     */
    public $uid;

    /**
     * @var string
     */
    public $login_name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $login_secret_hash;


    public function isValidSecret(string $secret): bool
    {
        return password_verify($secret, $this->login_secret_hash);
    }

    public function getUid(): string
    {
        return $this->uid;
    }
}
