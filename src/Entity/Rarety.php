<?php

namespace App\Entity;

use App\Repository\RaretyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaretyRepository::class)]
class Rarety
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'idRarety', targetEntity: Cards::class)]
    private Collection $cards;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
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
     * @return Collection<int, Cards>
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Cards $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards->add($card);
            $card->setIdRarety($this);
        }

        return $this;
    }

    public function removeCard(Cards $card): self
    {
        if ($this->cards->removeElement($card)) {
            // set the owning side to null (unless already changed)
            if ($card->getIdRarety() === $this) {
                $card->setIdRarety(null);
            }
        }

        return $this;
    }
}
