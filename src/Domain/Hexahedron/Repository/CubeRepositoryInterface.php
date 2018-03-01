<?php

namespace App\Domain\Hexahedron\Repository;

use App\Domain\Hexahedron\Model\Cube;

interface CubeRepositoryInterface
{
    public function save(Cube $cube);
}
