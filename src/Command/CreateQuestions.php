<?php

namespace App\Command;

use App\Entity\Cards;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Questions;
use App\Entity\Choice;
use App\Entity\Rarety;
use App\Entity\Testimony;
use App\Entity\MST;
use Symfony\Component\Console\Question\Question;

#[AsCommand(name: 'all:create')]
class CreateQuestions extends Command
{
    public function __construct(private EntityManagerInterface $entityManagerInterface, private ManagerRegistry $doctrine)
    {
        parent::__construct();
    }

    protected static $defaultDescription = 'Creates Questions for the game';

    // ...
    protected function configure(): void
    {
        $this
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command creates MST for the game')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {   
        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Sida"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("5 Juin 1981");
        $secondChoice->setLabel("10 mai 2000");
        $oneRarety->setLabel("Légendaire");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("Quel est la date du premier signalement du sida ?");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($oneChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        $this->entityManagerInterface->flush();


        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Sida"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("français");
        $secondChoice->setLabel("québecois");
        $oneRarety->setLabel("brésilien");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("Quel est la nationalité premier cas positif au sida ?");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($oneChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        $this->entityManagerInterface->flush();



        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Hépatite B"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("30-60jours");
        $secondChoice->setLabel("60-90jours");
        $thirdChoice->setLabel("90-120jours");
        $oneRarety->setLabel("Epic");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("Quel est la durée d'incubation de l'hépatite B ?");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($oneChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();



        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Hépatite B"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("1980");
        $secondChoice->setLabel("1981");
        $thirdChoice->setLabel("1982");
        $oneRarety->setLabel("Epic");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("Quel est la date apparition vaccin pour l'hépatite B ?");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($oneChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();


        //troisième
        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Herpès"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("Oui");
        $secondChoice->setLabel("Non");
        $thirdChoice->setLabel("Peut-être");
        $oneRarety->setLabel("Epic");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("possibilité de s’en débarrasser définitivement ?");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($secondChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();



        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Herpès"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("Apparition de bouton");
        $secondChoice->setLabel("Rougeurs");
        $thirdChoice->setLabel("Voix respiratoire bloqué");
        $oneRarety->setLabel("Epic");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("comment se manifeste l’herpès ?");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($oneChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();

        //quatrième


        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Syphilis"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("La famille des Enterobacter");
        $secondChoice->setLabel("La famille des Citrobacter");
        $thirdChoice->setLabel("La famille des spirochètes");
        $oneRarety->setLabel("Epic");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("de quelle famille vient la bactérie contaminante ? ");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($thirdChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();
        

        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Syphilis"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("3 semaines");
        $secondChoice->setLabel("1 mois");
        $thirdChoice->setLabel("1 an");
        $oneRarety->setLabel("Normal");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("période d’incubation ?");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($oneChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();


        //cinquième

        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Mycose vaginale"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("20 %");
        $secondChoice->setLabel("50 %");
        $thirdChoice->setLabel("60 %");
        $oneRarety->setLabel("Incroyable");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("taux de l’humanité souffrante ?");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($oneChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();


        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Mycose vaginale"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("Les tortues");
        $secondChoice->setLabel("les chiens");
        $thirdChoice->setLabel("Les poissons");
        $oneRarety->setLabel("Normal");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("quel animal est il touché par les mycoses ? ");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($thirdChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();

        //sixième


        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Gonorrhée (chaude-pisse)"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("2 jours");
        $secondChoice->setLabel("1 semaine");
        $thirdChoice->setLabel("30 jours");
        $oneRarety->setLabel("Incroyable");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("combien de jours met la chaude pisse à se manifester ? ");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($secondChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();


        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Gonorrhée (chaude-pisse)"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("20%");
        $secondChoice->setLabel("40%");
        $thirdChoice->setLabel("80%");
        $oneRarety->setLabel("Epic");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("sur quel proportion les hommes sont ils touchés par rapport aux femmes ");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($thirdChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();


        //septième



        
        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Papillomavirus"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("200 génotypes différents");
        $secondChoice->setLabel("400 génotypes différents");
        $thirdChoice->setLabel("1000 génotypes différents");
        $oneRarety->setLabel("Epic");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("combien de génotypes différents connaît on ? ");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($oneChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();



        $oneMST = $this->doctrine->getRepository(MST::class)->findOneBy(["name" => "Papillomavirus"]);
        
        $oneChoice = new Choice();// On fait un nouveau Choice
        $secondChoice = new Choice();
        $thirdChoice = new Choice();
        $oneRarety = new Rarety();// On fait un nouveau Rarety
        $oneCard = new Cards();// On fait un nouveau Cards
        $newQuestion = new Questions();// On fait un nouveau Questions

        $oneChoice->setLabel("67%");
        $secondChoice->setLabel("20%");
        $thirdChoice->setLabel("43%");
        $oneRarety->setLabel("Epic");

        $oneCard->setIdRarety($oneRarety->getId());
        $oneCard->setIdMST($oneMST);

        $oneRarety->addCard($oneCard);

        

        $newQuestion->setLabel("quelle proportion de cas le vaccin prévient-il ? ");
        $newQuestion->addProposal($oneChoice);
        $newQuestion->addProposal($secondChoice);
        $newQuestion->addProposal($thirdChoice);
        $newQuestion->setWin(new Cards());

        $oneCard->addQuestion($newQuestion);

        $oneChoice->setQuestion($newQuestion);
        $secondChoice->setQuestion($newQuestion);
        $oneChoice->setProposal($newQuestion);
        $secondChoice->setProposal($newQuestion);

        $newQuestion->setGoodAnswer($oneChoice);


        $this->entityManagerInterface->persist($newQuestion);
        $this->entityManagerInterface->persist($oneChoice);
        $this->entityManagerInterface->persist($secondChoice);
        $this->entityManagerInterface->persist($oneRarety);
        $this->entityManagerInterface->persist($oneCard);
        
        
        $this->entityManagerInterface->flush();



        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}
