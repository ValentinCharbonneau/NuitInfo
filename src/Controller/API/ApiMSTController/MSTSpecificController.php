<?php

namespace App\Controller\API\ApiMSTController;

use App\Entity\MST;
use App\Repository\MSTRepository;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

#[AsController]
#[Route(path: "/api")]
class MSTSpecificController extends AbstractController
{
    public function __construct(private MSTRepository $mstRepository, private SerializerInterface $serializerInterface)
    {}
    
    #[Route(
        name: 'mst_specific',
        path: '/mst/{name}',
        methods: ['GET'],
        defaults: [
            '_api_resource_class' => MST::class,
        ],
    )]
    public function __invoke(string  $name): JsonResponse
    {
        $data = $this->mstRepository->findOneBy(['name' => urldecode($name)]);

        $context = (new ObjectNormalizerContextBuilder())
                ->withGroups('mst:read')
                ->toArray();

        return new JsonResponse(json_decode($this->serializerInterface->serialize($data, 'json', $context)));
    }
}