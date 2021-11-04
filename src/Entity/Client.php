<?php


namespace Micx\Key4s\Entity;


use Lack\OidServer\Base\Interface\ClientInterface;
use Phore\UniDb\Attribute\UniDbColumn;
use Phore\UniDb\Attribute\UniDbEntity;

#[UniDbEntity(pk: "client_id")]
class Client implements ClientInterface
{

    /**
     * @var string
     */
    public $client_id;

    /**
     * @var string|null
     */
    public array $client_secret_hashes;

    /**
     * @var string|null
     */
    public array $allow_urls;

    public function isValidSecret(string $secret): bool
    {
        return password_verify($this->client_secret_hashes, $secret);
        foreach ($this->client_secret_hashes as $curSecret) {
            if (password_verify($secret, $curSecret))
                return true;
        }
        return false;
    }

    public function isValidRedirectTarget(string $url): bool
    {
        $reqScheme = parse_url($url, PHP_URL_SCHEME);
        $reqHost = parse_url($url, PHP_URL_HOST);

        if ($reqScheme === false || $reqScheme === null || $reqHost === false || $reqHost === null || $reqHost === "" || $reqScheme === "")
            throw new \InvalidArgumentException("Invalid redirect_url: '$url'");

        return true;
        foreach ($this->allow_urls as $allow_url) {
            if ($reqScheme === parse_url($allow_url, PHP_URL_SCHEME) && $reqHost === parse_url($allow_url, PHP_URL_HOST))
                return true;
        }
        return false;
    }
}
