<?php


namespace Micx\Key4s\UserManager;


use Lack\OidServer\Base\Manager\ResourceOwnerInterface;
use Lack\OidServer\Base\Manager\ResourceOwnerReadMangerInterface;
use Micx\Key4s\Type\T_ResourceOwners;
use Phore\Core\Exception\NotFoundException;

class FileBasedUserManager implements ResourceOwnerReadMangerInterface
{

    /**
     * @var T_ResourceOwners
     */
    private $resourceOwners;

    public function __construct(string $filename)
    {
        $this->resourceOwners = phore_file($filename)->hydrate(T_ResourceOwners::class);
        assert ($this->resourceOwners instanceof T_ResourceOwners);
    }


    /**
     * @param string $uid
     * @return ResourceOwnerInterface
     * @throws NotFoundException
     */
    public function getResourceOwnerById(string $uid): ResourceOwnerInterface
    {
        foreach ($this->resourceOwners->resource_owners as $resourceOwner) {
            if ($resourceOwner->uid === $uid)
                return $resourceOwner;
        }
        throw new NotFoundException("Resource Owner '$uid' not found");
    }


    /**
     * @param string $uidOrEMail
     * @return ResourceOwnerInterface
     * @throws NotFoundException
     */
    public function findResourceOwner(string $uidOrEMail): ResourceOwnerInterface
    {
        foreach ($this->resourceOwners->resource_owners as $resourceOwner) {
            if ($resourceOwner->uid === $uidOrEMail || $resourceOwner->email === $uidOrEMail || $resourceOwner->login_name == $uidOrEMail)
                return $resourceOwner;
        }
        throw new NotFoundException("Resource Owner '$uidOrEMail' not found");
    }
}
