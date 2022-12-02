<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Service\UserManager;
use App\Entity\User;

#[AsCommand(
    name: 'create-admin',
    description: 'cette commande créer un nouvel administarteur',
    //hidden: false,
    //aliases: ['app:add-user']
   
)]
class CreateAdminCommand extends Command
{
    protected static $defaultName = 'app:create-admin';
    protected static $defaultDescription = 'Creates a new user.';
    private $userManager;

    

    public function __construct(UserManager $userManager)
    {
        
        $this->usermanager = $userManager;

        parent::__construct();
    
    }

    /*public function __construct(bool $requirePassword = false)
    {
     
        $this->requirePassword = $requirePassword;

        parent::__construct();
    }*/


    protected function configure(): void
    {
        $this
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command allows you to create a user...');

        $this
        
        ->setDescription('Command for create user')
        
        ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
        
        ;


        /*$this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;*/
    }

    

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        
        // outputs multiple lines to the console (adding "\n" at the end of each line)
    $output->writeln([
        'User Creator',
        '============',
        '',
    ]);

    $user = new User();
    $user->setUsername($input->getArgument("username"));
    $output->writeln("With username : ". $user->getUsername());

    $user->setPassword($input->getArgument("password"));
    
    $this->userManager->create($input->getArgument('username'));
    $this->userManager->persist($user);
    $this->userManager->flush();

    $output->writeln('User successfully generated!');

    return Command::SUCCESS;
        
    }
}
