<?php


namespace Micx\Key4s\UserManager;


use Lack\OidServer\Base\Manager\ClientInterface;
use Lack\OidServer\Base\Manager\ClientReadManagerInterface;
use Micx\Key4s\Type\T_Client;
use Micx\Key4s\Type\T_Clients;
use Phore\Core\Exception\NotFoundException;

class FileBasedClientManager implements ClientReadManagerInterface
{

    /**
     * @var T_Clients
     */
    private $clients;

    public function __construct(string $file)
    {
        $this->clients = phore_file($file)->hydrate(T_Clients::class);
    }

    public function getClientById(string $clientId) : T_Client
    {
        foreach ($this->clients->clients as $client) {
            if ($client->client_id = $clientId)
                return $client;
        }
        throw new NotFoundException("Client with client_id '$clientId' not found");
    }
}
