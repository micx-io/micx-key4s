<?php

namespace Micx\Key4s;

use Micx\Key4s\Entity\Client;
use Micx\Key4s\Entity\Grp;
use Micx\Key4s\Entity\MapUserGroup;
use Micx\Key4s\Entity\Org;
use Micx\Key4s\Entity\User;
use Phore\UniDb\Helper\IOStrategy\OneFilePerEntityIoStrategy;
use Phore\UniDb\UniDbConfig;

UniDbConfig::define("sqlite:/data/key4s.db3", [
    User::class, Grp::class, Client::class, Org::class, MapUserGroup::class
], autocreate_schema: false);

UniDbConfig::defineIO([
    User::class => new OneFilePerEntityIoStrategy(filenameColumn: "user"),
    Client::class => new OneFilePerEntityIoStrategy(filenameColumn: "client_id")
]);
