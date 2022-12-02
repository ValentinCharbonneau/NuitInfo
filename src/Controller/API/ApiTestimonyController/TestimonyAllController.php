<?php

namespace App\Controller\API\ApiTestimonyController;

use App\Entity\Testimony;
use App\Repository\TestimonyRepository;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

#[AsController]
#[Route(path: "/api")]
class TestimonyAllController extends AbstractController
{
    public function __construct(private TestimonyRepository $testimonyRepository, private SerializerInterface $serializerInterface)
    {}
    
    #[Route(
        name: 'testimony_all',
        path: '/testimony',
        methods: ['GET'],
        defaults: [
            '_api_resource_class' => Testimony::class,
        ],
    )]
    public function __invoke(): JsonResponse
    {
        $result = [];
        $context = (new ObjectNormalizerContextBuilder())
                    ->withGroups('testimony:list')
                    ->toArray();

        foreach($this->testimonyRepository->findAll() as $testimony)
        {
            if ($testimony->isValidate())
            {
                $interRes = json_decode($this->serializerInterface->serialize($testimony, 'json', $context));
                $interRes->MST = $testimony->getMST()->getName();
                array_push($result, $interRes);
            }
        }

        return new JsonResponse($result);
    }
}