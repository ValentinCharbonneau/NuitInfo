<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
class Questions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'questions', cascade: ['persist'] ,targetEntity: Choice::class)]
    private Collection $proposal;

    #[ORM\OneToOne(inversedBy: 'question', cascade: ['persist', 'remove'])]
    private ?Choice $goodAnswer = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Cards $win = null;

    #[ORM\OneToMany(mappedBy: 'proposal', targetEntity: Choice::class)]
    private Collection $choices;

    public function __construct()
    {
        $this->goodAnswer = new Choice();
        $this->proposal = new ArrayCollection();
        $this->choices = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Choice>
     */
    public function getProposal(): Collection
    {
        return $this->proposal;
    }

    public function addProposal(Choice $proposal): self
    {
        if (!$this->proposal->contains($proposal)) {
            $this->proposal->add($proposal);
            $proposal->setQuestion($this);
        }

        return $this;
    }

    public function removeProposal(Choice $proposal): self
    {
        if ($this->proposal->removeElement($proposal)) {
            // set the owning side to null (unless already changed)
            if ($proposal->getQuestion() === $this) {
                $proposal->setQuestion(null);
            }
        }

        return $this;
    }

    public function getGoodAnswer(): ?Choice
    {
        return $this->goodAnswer;
    }

    public function setGoodAnswer(?Choice $goodAnswer): self
    {
        $this->goodAnswer = $goodAnswer;

        return $this;
    }

    public function getWin(): ?Cards
    {
        return $this->win;
    }

    public function setWin(?Cards $win): self
    {
        $this->win = $win;

        return $this;
    }

    /**
     * @return Collection<int, Choice>
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(Choice $choice): self
    {
        if (!$this->choices->contains($choice)) {
            $this->choices->add($choice);
            $choice->setProposal($this);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): self
    {
        if ($this->choices->removeElement($choice)) {
            // set the owning side to null (unless already changed)
            if ($choice->getProposal() === $this) {
                $choice->setProposal(null);
            }
        }

        return $this;
    }
}
