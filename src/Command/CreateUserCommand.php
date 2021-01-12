<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ?string $name = null)
    {
        parent::__construct($name);

        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Creates a user in the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $usernameQuestion = new Question('<question>Username:</question> ');
        $username = $helper->ask($input, $output, $usernameQuestion);

        $passwordQuestion = new Question('<question>Password:</question> ');
        $passwordQuestion->setHidden(true);
        $passwordQuestion->setHiddenFallback(false);

        $user = new User();
        $user->setUsername($username);

        $password = $helper->ask($input, $output, $passwordQuestion);
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $password);

        $user->setPassword($encodedPassword);

        $apiTokenQuestion = new Question('<question>API key:</question>  ');
        $apiTokenQuestion->setHidden(true);
        $apiTokenQuestion->setHiddenFallback(false);
        $apiToken = $helper->ask($input, $output, $apiTokenQuestion);

        $user->setApiKey($apiToken);

        $user->addRole('ROLE_ADMINISTRATOR');

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return 0;
    }
}
