<?php


namespace Micx\Key4s\UserManager;




use Lack\OidServer\Base\Interface\UserReadMangerInterface;
use Micx\Key4s\Entity\User;
use Phore\Core\Exception\NotFoundException;
use Phore\UniDb\Ex\EmptyResultException;
use Phore\UniDb\Stmt\OrStmt;
use Phore\UniDb\UniDb;

class UserManager implements UserReadMangerInterface
{


    public function __construct(
        private UniDb $uniDb
    ){}


    /**
     * @param string $uid
     * @return User
     * @throws NotFoundException
     */
    public function getUserByUid(string $uid): User
    {
        try {
            return $this->uniDb->select(byPrimaryKey: $uid, table: User::class, cast: true);
        } catch (EmptyResultException $e) {
            throw new NotFoundException("No user with uid '$uid' existing.");
        }
    }


    /**
     * @param string $uidOrEMail
     * @return User
     * @throws NotFoundException
     */
    public function findUser(string $uidOrEMail): User
    {
        try {
            return $this->uniDb->select(
                new OrStmt(
                    ["email", "=", $uidOrEMail],
                    ["uid", "=", $uidOrEMail],
                    ["name", "=", $uidOrEMail]),
                table: User::class, cast: true
            );
        } catch (EmptyResultException $e) {
            throw new NotFoundException("No user '$uidOrEMail' existing.");
        }
    }
}
