<?php

namespace Micx\Key4s\Entity;

use Phore\UniDb\Attribute\UniDbColumn;

class Org
{

    /**
     * @var string
     */
    #[UniDbColumn(primaryKey: true)]
    public string $org_id;

    public string $org_name;


}
