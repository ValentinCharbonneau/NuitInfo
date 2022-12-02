<?php

namespace App\Entity;

use App\Repository\ChoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChoiceRepository::class)]
class Choice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToOne(mappedBy: 'goodAnswer', cascade: ['persist', 'remove'])]
    private ?Questions $question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getQuestion(): ?Questions
    {
        return $this->question;
    }

    public function setQuestion(?Questions $question): self
    {
        // unset the owning side of the relation if necessary
        if ($question === null && $this->question !== null) {
            $this->question->setGoodAnswer(null);
        }

        // set the owning side of the relation if necessary
        if ($question !== null && $question->getGoodAnswer() !== $this) {
            $question->setGoodAnswer($this);
        }

        $this->question = $question;

        return $this;
    }
}
