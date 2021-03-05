<?php


namespace Micx\Key4s\Type;


use Lack\OidServer\Base\Manager\TenantConfigInterface;

class T_TenantConfig implements TenantConfigInterface
{

    /**
     * @var string
     */
    public $default_location_uri;


    public function getDefaultLocationUri(): string
    {
        return $this->default_location_uri;
    }
}
