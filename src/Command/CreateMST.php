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
        $newMST->setDescription("Le syndrome d'immunodéficience acquise, plus connu sous son acronyme SIDA, est un ensemble de symptômes consécutifs à la destruction de cellules du système immunitaire par le virus de l'immunodéficience humaine (VIH). Le SIDA est le dernier stade de l'infection au VIH, lorsque l'immunodépression est sévère.");
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Trichomonase');
        $newMST->setDescription("La trichomonase ou trichomonose urogénitale est une maladie infectieuse causée par le parasite Trichomonas vaginalis. Environ 70 % des femmes et des hommes ne présentent aucun symptôme lorsqu'ils sont infectés. Lorsque les symptômes apparaissent, ils commencent généralement 5 à 28 jours après l'exposition. Les symptômes peuvent inclure des démangeaisons dans la région génitale, une mauvaise odeur de la sécrétion vaginale, des sensations de brûlure lors de la miction et une douleur lors des rapports sexuels.");
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Chlamydia');
        $newMST->setDescription("Les chlamydies (Chlamydia) forment un genre de bactéries de la famille des Chlamydiaceae. Tout comme les rickettsies, les chlamydies sont des bactéries parasites intracellulaires obligatoires et de petite taille (300-500 nm). Elles sont responsables de diverses maladies chez les animaux dont les humains.");
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Morpion');
        $newMST->setDescription("Il diffère des poux standards (Pediculus humanus capitis ou « pou de tête » et Pediculus humanus ou « pou de corps ») par sa morphologie et sa résidence. Le morpion est un petit insecte trapu, long de 2 à 3 mm ressemblant à un crabe : il possède un thorax très large portant des pattes puissantes à pseudo-pinces énormes (plus fortes que celles du pou de tête) et un abdomen court et étroit.");
        $this->entityManagerInterface->persist($newMST);
        $this->entityManagerInterface->flush();

        $newMST = new MST();
        $newMST->setName('Syphilis');
        $newMST->setDescription("La syphilis (connue familièrement sous le nom de vérole ou encore de grande vérole par opposition à la variole) est une infection sexuellement transmissible contagieuse, due à la bactérie Treponema pallidum (ou tréponème pâle).");
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
