<?php

namespace App\Entity;

use App\Repository\CardsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardsRepository::class)]
class Cards
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cards')]
    private ?Rarety $idRarety = null;

    #[ORM\ManyToOne(inversedBy: 'cards')]
    private ?MST $idMST = null;

    #[ORM\OneToMany(mappedBy: 'win', targetEntity: Questions::class)]
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRarety(): ?Rarety
    {
        return $this->idRarety;
    }

    public function setIdRarety(?Rarety $idRarety): self
    {
        $this->idRarety = $idRarety;

        return $this;
    }

    public function getIdMST(): ?MST
    {
        return $this->idMST;
    }

    public function setIdMST(?MST $idMST): self
    {
        $this->idMST = $idMST;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setWin($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getWin() === $this) {
                $question->setWin(null);
            }
        }

        return $this;
    }
}
