<?php
namespace Evento\Application\Handler\User;

use Doctrine\ORM\Exception\ORMException;
use Evento\Domain\User\User;
use Exception;
use Evento\Domain\User\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserHandler
{
    private UserRepositoryInterface $userRepository;
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordHasherInterface $hasher
    )
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    /**
     * @param array $userArray
     * @throws Exception|ORMException
     */
    public function handle(array $userArray): void
    {
        $user = new User();
        $user->setUsername($userArray['username']);
        $user->setEmail($userArray['email']);

        $password = $this->hasher->hashPassword($user, $userArray['password']);
        $user->setPassword($password);
        $user->setAvatar($userArray['avatar']);

        try {
            $this->userRepository->save($user);
        } catch (Exception $exception) {
            throw new Exception ('User can not be saved, probably username or email already taken.');
        }
    }
}