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
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

#[AsController]
#[Route(path: "/api")]
class MSTAllController extends AbstractController
{
    private $mstRepository;
    private $serializerInterface;

    public function __construct(MSTRepository $mstRepository, SerializerInterface $serializerInterface)
    {
        $this->mstRepository = $mstRepository;
        $this->serializerInterface = $serializerInterface;
    }
    
    #[Route(
        name: 'mst_all',
        path: '/mst',
        methods: ['GET'],
        defaults: [
            '_api_resource_class' => MST::class,
        ],
    )]
    public function __invoke(): JsonResponse
    {
        $result = [];
        $context = (new ObjectNormalizerContextBuilder())
                    ->withGroups('mst:list')
                    ->toArray();

        foreach($this->mstRepository->findAll() as $mst)
        {
            array_push($result, json_decode($this->serializerInterface->serialize($mst, 'json', $context)));
        }

        return new JsonResponse($result);
    }
}