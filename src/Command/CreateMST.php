<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Entity\MST;
use App\Entity\Testimony;

#[AsCommand(name: 'mst:create')]
class CreateMST extends Command
{
    public function __construct(private EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct();
    }

    protected static $defaultDescription = 'Creates MST for the game';

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
        $newMST = new MST();
        $newMST->setName('Sida');
        $newMST->setDescription("La MST la plus mortelle numéro 1, baisse défense immunitaire.");
        $newMST->setTransmission('Voie sexuelle, sanguine, héréditaire.');
        $newMST->setSymptom('Défenses immunitaires très affaiblies.');
        $newMST->setTreatment('Il existe un traitement.');
        $newMST->setMortality(76.0);
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Hépatite B');
        $newMST->setDescription("Parmi les 10 virus les plus meurtriers au monde.");
        $newMST->setTransmission('Voie sexuelle, voie sanguine, tatouage ou piercing avec matériel mal stérilisé.');
        $newMST->setSymptom('Inflammation du foie.');
        $newMST->setTreatment('vaccination');
        $newMST->setMortality(0.3);
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Herpès');
        $newMST->setDescription("La MST la plus mortelle numéro 1, baisse défense immunitaire.");
        $newMST->setTransmission('Relations sexuelles.');
        $newMST->setSymptom('Provoque des boutons de fièvre ou d’autres maladies touchant la peau.');
        $newMST->setTreatment('Impossible de s’en débarrasser, le virus réapparaît sous forme de poussées.');
        $newMST->setMortality(12.0);
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Syphilis');
        $newMST->setDescription("La MST la plus mortelle numéro 1, baisse défense immunitaire.");
        $newMST->setTransmission('Par voie sexuelles.');
        $newMST->setSymptom('Défenses immunitaires très affaiblies.');
        $newMST->setTreatment('il existe un traitement');
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Sida');
        $newMST->setDescription("La MST la plus mortelle numéro 1, baisse défense immunitaire.");
        $newMST->setTransmission('Voie sexuelle, sanguine, héréditaire.');
        $newMST->setSymptom('Défenses immunitaires très affaiblies.');
        $newMST->setTreatment('il existe un traitement');
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Sida');
        $newMST->setDescription("La MST la plus mortelle numéro 1, baisse défense immunitaire.");
        $newMST->setTransmission('Voie sexuelle, sanguine, héréditaire.');
        $newMST->setSymptom('Défenses immunitaires très affaiblies.');
        $newMST->setTreatment('il existe un traitement');
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Sida');
        $newMST->setDescription("La MST la plus mortelle numéro 1, baisse défense immunitaire.");
        $newMST->setTransmission('Voie sexuelle, sanguine, héréditaire.');
        $newMST->setSymptom('Défenses immunitaires très affaiblies.');
        $newMST->setTreatment('il existe un traitement');
        $this->entityManagerInterface->persist($newMST);
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
