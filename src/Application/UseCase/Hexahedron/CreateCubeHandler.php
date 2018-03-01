<?php

namespace App\Application\UseCase\Hexahedron;

use App\Application\UseCase\Hexahedron\CreateCubeRequest;
use App\Domain\Hexahedron\Model\Cube;
use App\Domain\Hexahedron\Repository\CubeRepositoryInterface;

class CreateCubeHandler
{
    private $cubeRepositoryInterface;
    public function __construct(CubeRepositoryInterface $cubeRepositoryInterface)
    {
        $this->cubeRepositoryInterface = $cubeRepositoryInterface;
    }

    public function handle(CreateCubeRequest $createCubeCommand): Cube
    {
        $cube = new Cube($createCubeCommand->x(), $createCubeCommand->y(), $createCubeCommand->z(), $createCubeCommand->edge());
        $this->cubeRepositoryInterface->save($cube);
        return $cube;
    }
}
