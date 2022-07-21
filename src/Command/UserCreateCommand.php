<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[AsCommand(
    name: 'app:admin:create',
    description: 'This command allows you to create admin user with ROLE_ADMIN ...',
)]
class UserCreateCommand extends Command
{
    protected static $defaultName = 'app:admin:create';

    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder, ?string $name = null)
    {
        parent::__construct($name);
        $this->passwordHasher = $encoder;
        $this->em = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to create admin user with ROLE_ADMIN ...')
            ->addOption('login', 'l', InputArgument::OPTIONAL, 'Admin login')
            ->addOption('email', 'm', InputArgument::OPTIONAL, 'Admin email')
            ->addOption('password', 'p', InputArgument::OPTIONAL, 'Admin password')
        ;
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $userLogin = $input->getOption('login');
        $userEmail = $input->getOption('email');
        $userPassword = $input->getOption('password');

        if (empty($userLogin) || empty($userPassword) || empty($userEmail)) {
            throw new \RuntimeException('Environment variables \'DEFAULT_ADMIN_LOGIN\', \'DEFAULT_ADMIN_EMAIL\' and \'DEFAULT_ADMIN_PASSWORD\' must be set!');
        }
        $isNew = false;

        $user = $this->checkUser($userLogin);

        if ($user instanceof User) {
            $io->error('User with login \''.$userLogin.'\' or e-mail \''.$userEmail.'\' already exists.');

            return 0;
        }

        if ($user === null) {
            $user = $this->createUser($userLogin, $userEmail);
            $isNew = true;
        }

        $user->setPassword($this->hashPassword($user, $userPassword));

        $this->em->persist($user);
        $this->em->flush();

        $io->success("User {$userLogin} was successfully " . ($isNew ? 'created.' : 'updated.'));

        return Command::SUCCESS;
    }

    /**
     * @throws Exception
     */
    private function checkUser(string $userLogin): ?User
    {
        return $this->em->getRepository(User::class)->findByLoginOrEmail($userLogin);
    }

    private function hashPassword(PasswordAuthenticatedUserInterface $user, string $password): string
    {
        return $this->passwordHasher->hashPassword($user, $password);
    }

    private function createUser(string $userLogin, string $userEmail, string $userPassword = ''): User
    {
        $user = new User();
        $user->setEmail($userEmail)
            ->setTitle('Administrator')
            ->setLogin($userLogin)
            ->setPassword($userPassword)
            ->setRoles(['ROLE_ADMIN']);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
