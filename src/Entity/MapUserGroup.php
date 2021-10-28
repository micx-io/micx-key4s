<?php

namespace Micx\Key4s\Entity;

use Phore\UniDb\Attribute\UniDbEntity;

#[UniDbEntity(pk: ["uid", "group_id"])]
class MapUserGroup
{
    public string $uid;

    public string $group_id;

    public string $role = "MEMBER";

    public string $changed_at = "";

    public string $added_at = "";

    public ?string $added_by_uid = null;

    public ?string $changed_by_uid = null;
}
