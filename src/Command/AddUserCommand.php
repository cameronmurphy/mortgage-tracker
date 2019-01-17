<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AddUserCommand extends Command
{
    protected static $defaultName = 'app:add-user';

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
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $emailQuestion = new Question('<question>Username:</question> ');
        $email = $helper->ask($input, $output, $emailQuestion);

        $passwordQuestion = new Question('<question>Password:</question> ');
        $passwordQuestion->setHidden(true);
        $passwordQuestion->setHiddenFallback(false);

        $user = new User();
        $user->setUsername($email);

        $password = $helper->ask($input, $output, $passwordQuestion);
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $password);

        $user->setPassword($encodedPassword);

        $user->addRole('ROLE_ADMINISTRATOR');

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
