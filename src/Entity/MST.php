<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Controller\API\ApiMSTController\MSTAllController;
use App\Repository\MSTRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\API\ApiMSTController;

#[ORM\Entity(repositoryClass: MSTRepository::class)]
#[ApiResource(operations: [
    new Get(
        uriTemplate: '/mst',
        normalizationContext: ['groups' => ['mst:list']],
        routeName: 'mst_all',
        controller: MSTAllController::class
    ),
    new Get(
        uriTemplate: '/mst/{name}', 
        normalizationContext: ['groups' => ['mst:read']],
        routeName: 'mst_specific',
        controller: MSTSpecificController::class
    ),
])]
#[Route(path: "/api")]
#[UniqueEntity(fields: 'name', message: 'Cette MST existe déjà')]
class MST
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[ApiProperty(identifier: true)]
    #[Groups(['mst:list', 'mst:read'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['mst:read'])]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'MST', targetEntity: Testimony::class)]
    private Collection $testimonies;

    public function __construct()
    {
        $this->testimonies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Testimony>
     */
    public function getTestimonies(): Collection
    {
        return $this->testimonies;
    }

    public function addTestimony(Testimony $testimony): self
    {
        if (!$this->testimonies->contains($testimony)) {
            $this->testimonies->add($testimony);
            $testimony->setMST($this);
        }

        return $this;
    }

    public function removeTestimony(Testimony $testimony): self
    {
        if ($this->testimonies->removeElement($testimony)) {
            // set the owning side to null (unless already changed)
            if ($testimony->getMST() === $this) {
                $testimony->setMST(null);
            }
        }

        return $this;
    }
}
