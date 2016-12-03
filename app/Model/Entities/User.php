<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM;
use Kdyby;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements IIdentity
{
    use Kdyby\Doctrine\Entities\MagicAccessors;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $userId;

    public function getId()
    {
        return $this->userId;
    }

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="simple_array", nullable=false)
     */
    protected $roles = [];

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=60, nullable=false)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=true)
     */
    protected $password;

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param string $newPassword
     */
    public function changePassword($newPassword)
    {
        $this->password = Passwords::hash($newPassword);
    }
}
