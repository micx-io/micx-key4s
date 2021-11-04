<?php


namespace Micx\Key4s\Entity;


use Lack\OidServer\Base\Interface\UserInterface;
use Phore\UniDb\Attribute\UniDbColumn;
use Phore\UniDb\Attribute\UniDbEntity;
use Phore\UniDb\Attribute\UniDbIndex;
use Phore\UniDb\Schema\Index;

#[UniDbEntity(pk: "uid")]
#[UniDbIndex(cols: ["user"], type: Index::TYPE_UNIQUE)]
#[UniDbIndex(cols: ["email"], type: Index::TYPE_UNIQUE)]
class User implements UserInterface
{
    public function __construct(

        /**
         *
         */
        #[UniDbColumn(primaryKey: true)]
        public string $uid,

        #[UniDbColumn(notNull: true)]
        public string $name,

        #[UniDbColumn(notNull: true)]
        public string $email,

        public bool $email_verified = false,

        /**
         * @var string|null
         */
        public ?string $passwd_crypt = null,

        /**
         * @var string|null
         */
        public ?string $birthdate = null,

        /**
         * @var string|null
         */
        public ?string $picture = null,


    ){}


    public function isValidSecret(string $secret): bool
    {
        return password_verify($secret, $this->passwd_crypt);
    }

    public function getUid(): string
    {
        return $this->uid;
    }

}
