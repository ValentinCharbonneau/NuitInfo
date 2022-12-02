<?php

namespace App\Entity;

use App\Controller\API\ApiTestimonyController\TestimonyCreateController;
use App\Controller\API\Testimony\TestimonyAllController;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\TestimonyRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\API\ApiTestimonyController;
use Symfony\Component\Routing\Annotation\Route;

#[ORM\Entity(repositoryClass: TestimonyRepository::class)]
#[ApiResource(operations: [
    new Get(
        name: 'testimony_all',
        uriTemplate: '/testimony', 
        normalizationContext: ['groups' => ['testimony:list']],
        routeName: 'testimony_all',
        controller: TestimonyAllController::class
    ),
    new Get(
        uriTemplate: '/testimony/{id}', 
        normalizationContext: ['groups' => ['testimony:read']],
        routeName: 'testimony_specific',
        controller: TestimonySpecificController::class
    ),
    new Post(
        uriTemplate: '/testimony', 
        denormalizationContext: ['groups' => ['testimony:write']],
        routeName: 'testimony_create',
        controller: TestimonyCreateController::class
    )
])]
#[Route(path: "/api")]
class Testimony
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    #[Groups(['testimony:list', 'testimony:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['testimony:list', 'testimony:read', 'testimony:write'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['testimony:list', 'testimony:read', 'testimony:write'])]
    private ?int $age = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['testimony:read', 'testimony:write'])]
    private ?string $content = null;

    #[ORM\Column]
    private ?bool $validate = false;

    #[ORM\ManyToOne(inversedBy: 'testimonies')]
    #[Groups(['testimony:list', 'testimony:read', 'testimony:write'])]
    private ?MST $MST = null;

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isValidate(): ?bool
    {
        return $this->validate;
    }

    public function setValidate(bool $validate): self
    {
        $this->validate = $validate;

        return $this;
    }

    public function getMST(): ?MST
    {
        return $this->MST;
    }

    public function setMST(?MST $MST): self
    {
        $this->MST = $MST;

        return $this;
    }
}
