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
class TestimonySpecificController extends AbstractController
{
    public function __construct(private TestimonyRepository $testimonyRepository, private SerializerInterface $serializerInterface)
    {}

    #[Route(
        name: 'testimony_specific',
        path: '/testimony/{id}',
        methods: ['GET'],
        defaults: [
            '_api_resource_class' => Testimony::class,
        ],
    )]
    public function __invoke(Testimony $data): JsonResponse
    {
        if ($data->isValidate())
        {
            $context = (new ObjectNormalizerContextBuilder())
                    ->withGroups('testimony:read')
                    ->toArray();

            $result = json_decode($this->serializerInterface->serialize($data, 'json', $context));
            $result->MST = $data->getMST()->getName();

            return new JsonResponse($result);
        }
        else
        {
            return new JsonResponse([], 404);
        }
    }
}