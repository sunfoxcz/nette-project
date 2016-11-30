<?php

namespace App\Model\Services;

use App\Model\Entities\User;
use Kdyby\Doctrine\EntityDao;
use Kdyby\Doctrine\EntityManager;
use Nette\Application\Application;
use Nette\Security;


final class UserService implements Security\IAuthenticator
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var EntityDao
     */
    private $userRepository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $entityManager->getRepository(User::class);
    }

    /**
     * @param string $username
     *
     * @return User|NULL
     */
    public function getByUsername($username)
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }

    /**
     * Performs an authentication.
     *
     * @return User|Security\IIdentity
     * @throws Security\AuthenticationException
     */
    public function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;

        $user = $this->getByUsername($username);

        if (!$user) {
            throw new Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);

        } elseif (!Security\Passwords::verify($password, $user->password)) {
            throw new Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);

        } elseif (Security\Passwords::needsRehash($user->password)) {
            $user->changePassword($password);
            $this->entityManager->flush();
        }

        return $user;
    }
}
