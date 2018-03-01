<?php

namespace App\Tests\Domain\Hexahedron\Factory;

use PHPUnit\Framework\TestCase;
use App\Domain\Hexahedron\Factory\HexahedronStaticFactory;
use App\Domain\Hexahedron\Model\Cube;
use App\Domain\Hexahedron\Model\Orthohedron;

class HexahedronStaticFactoryTest extends TestCase
{
    public function testCreateHexahedronFromHashMap()
    {
        $cube = new Cube(0, 0, 0, 3);
        $this->assertEquals(get_class($cube), get_class(HexahedronStaticFactory::createHexahedronFromHashMap($cube->hashTableMap())));
        $orthohedron = new Orthohedron(0, 0, 0, 3, 4, 3);
        $this->assertEquals(get_class($orthohedron), get_class(HexahedronStaticFactory::createHexahedronFromHashMap($orthohedron->hashTableMap())));
    }
}
