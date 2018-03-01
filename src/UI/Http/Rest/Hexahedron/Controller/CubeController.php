<?php

namespace App\UI\Http\Rest\Hexahedron\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use League\Tactician\CommandBus;
use App\Application\UseCase\Hexahedron\CreateCubeRequest;
use App\Application\UseCase\Hexahedron\CalculateVolumeIntersectionCubesService;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\RequestParam;


//esto no va aqui
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @RouteResource("Cube", pluralize=false)
 * Class CubeController
 * @package AppBundle\Controller
 */
class CubeController extends Controller
{
    private $commandBus;
    private $calculateVolumeIntersecionCubes;

    public function __construct(CommandBus $commandBus, CalculateVolumeIntersectionCubesService $calculateVolumeIntersecionCubes)
    {
        $this->commandBus = $commandBus;
        $this->calculateVolumeIntersecionCubes = $calculateVolumeIntersecionCubes;
    }

    /**
     * @RequestParam(name="x1", requirements="\d+", description="x1 for cube")
     * @RequestParam(name="y1", requirements="\d+", description="y1 for cube")
     * @RequestParam(name="z1", requirements="\d+", description="z1 for cube")
     * @RequestParam(name="edge1", requirements="[0-9]\d+", description="edge1 for cube")
     * @param ParamFetcher $paramFetcher
     * @return mixed
     */
    public function postCubeAction(ParamFetcher $paramFetcher)
    {
//        try {
//        $form = $this->createFormBuilder(Cube::class)
//            ->add('x1', TextType::class)
//            ->add('save', SubmitType::class, array('label' => 'Create Task'))
//            ->getForm();
//        $form->bind($request);
//        var_dump($form);
//        die();
        $command = new CreateCubeRequest($paramFetcher->get('x1'), $paramFetcher->get('y1'), $paramFetcher->get('z1'), $paramFetcher->get('edge1'));
        return $this->commandBus->handle($command);
//        }catch(\Error $e){
//            throw new HttpException(400, "Bad Reuest");
//        }
    }

    public function getVolumeAction(Request $request)
    {
        $command = new CreateCubeRequest($request->query->get('x1'), $request->query->get('y1'), $request->query->get('z1'), $request->query->get('edge1'));
        $cube1 = $this->commandBus->handle($command);
        $command = new CreateCubeRequest($request->query->get('x2'), $request->query->get('y2'), $request->query->get('z2'), $request->query->get('edge2'));
        $cube2 = $this->commandBus->handle($command);
        return $this->calculateVolumeIntersecionCubes->execute($cube1, $cube2);
    }
}
