<?php

namespace App\Application\UseCase\Hexahedron;

use App\Domain\Hexahedron\Model\Cube;
use App\Domain\Hexahedron\Model\VolumeVO;
use App\Domain\Hexahedron\Exception\InvalidCubeIntersectionException;

class CalculateVolumeIntersectionCubesService
{
    public function execute(Cube $cube1, Cube $cube2): VolumeVO
    {
        try {
            $hexahedron = $cube1->hexahedronIntersected($cube2);
            return $hexahedron->volume();
        } catch (InvalidCubeIntersectionException $e) {
            return new VolumeVO(0);
        }
    }
}
