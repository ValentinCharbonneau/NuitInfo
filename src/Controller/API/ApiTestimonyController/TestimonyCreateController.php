<?php

namespace App\Controller\API\ApiTestimonyController;

use App\Entity\Testimony;
use App\Repository\MSTRepository;
use App\Repository\TestimonyRepository;
use Doctrine\ORM\EntityManager;use Doctrine\ORM\EntityManagerInterface;

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
class TestimonyCreateController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManagerInterface, private TestimonyRepository $testimonyRepository, private MSTRepository $mSTRepository, private SerializerInterface $serializerInterface, private RequestStack $requestStack)
    {}

    #[Route(
        name: 'testimony_create',
        path: '/testimony',
        methods: ['POST'],
        defaults: [
            '_api_resource_class' => Testimony::class,
        ],
    )]
    public function __invoke(): JsonResponse
    {
        $result = [];
        $context = (new ObjectNormalizerContextBuilder())
                    ->withGroups('testimony:read')
                    ->toArray();
        $request = $this->requestStack->getCurrentRequest();
        $parameters = json_decode($request->getContent());

        if (isset($parameters->name) && isset($parameters->age) && isset($parameters->content) && isset($parameters->MST))
        {
            if (sizeof($this->mSTRepository->findBy(['name' => $parameters->MST])) > 0)
            {
                $newTestimony = new Testimony();
                $newTestimony->setName($parameters->name);
                $newTestimony->setAge($parameters->age);
                $newTestimony->setContent($parameters->content);
                $newTestimony->setMST($this->mSTRepository->findOneBy(['name' => $parameters->MST]));
    
                $this->entityManagerInterface->persist($newTestimony);
                $this->entityManagerInterface->flush();
    
                return new JsonResponse(json_decode($this->serializerInterface->serialize($newTestimony, 'json', $context)), 200);
            }
            else
            {
                return new JsonResponse(["The MST ".$parameters->MST." is unkown"], 400);
            }
        }
        else
        {
            if (!isset($parameters->name))
            {
                array_push($result, "We need parameter 'name'");
            }
            if (!isset($parameters->age))
            {
                array_push($result, "We need parameter 'age'");
            }
            if (!isset($parameters->content))
            {
                array_push($result, "We need parameter 'content'");
            }
            if (!isset($parameters->MST))
            {
                array_push($result, "We need parameter 'MST'");
            }
            else if (sizeof($this->mSTRepository->findBy(['name' => $parameters->MST])) == 0)
            {
                
                array_push($result, "The MST ".$parameters->MST." is unkown");
            }
            return new JsonResponse($result, 400);
        }
        
    }
}