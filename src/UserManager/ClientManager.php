<?php


namespace Micx\Key4s\UserManager;


use Lack\OidServer\Base\Interface\ClientReadManagerInterface;
use Micx\Key4s\Entity\Client;
use Phore\Core\Exception\NotFoundException;
use Phore\UniDb\Ex\EmptyResultException;
use Phore\UniDb\UniDb;

class ClientManager implements ClientReadManagerInterface
{


    public function __construct(
        private UniDb $uniDb
    ){}

    /**
     * @param string $clientId
     * @return Client
     * @throws NotFoundException
     */
    public function getClientById(string $clientId) : Client
    {
        try {
            return $this->uniDb->select(byPrimaryKey: $clientId, table: Client::class, cast: true);
        } catch (EmptyResultException $e) {
            throw new NotFoundException("No client '$clientId' found");
        }
    }
}
