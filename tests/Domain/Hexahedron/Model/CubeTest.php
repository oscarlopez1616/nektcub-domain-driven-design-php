<?php

namespace App\Tests\Domain\Hexahedron\Model;

use PHPUnit\Framework\TestCase;
use App\Domain\Hexahedron\Model\Cube;
use App\Domain\Hexahedron\Exception\InvalidCubeException;
use App\Domain\Hexahedron\Exception\InvalidCubeIntersectionException;

class CubeTest extends TestCase
{
    public function testConstruct()
    {
        $cube = new Cube(0, 1, 2, 3);
        $this->assertEquals(0, $cube->location()->x());
        $this->assertEquals(1, $cube->location()->y());
        $this->assertEquals(2, $cube->location()->z());
        $this->assertEquals(3, $cube->edge());
        $this->expectException(InvalidCubeException::class);
        $cube = new Cube(0, 1, 2, -1);
    }

    public function testHashTableMap()
    {
        $cube = new Cube(0, 0, 0, 3);
        $expected = array();
        $expected['x'][0] = 0;
        $expected['x'][1] = 1;
        $expected['x'][2] = 2;
        $expected['y'][0] = 0;
        $expected['y'][1] = 1;
        $expected['y'][2] = 2;
        $expected['z'][0] = 0;
        $expected['z'][1] = 1;
        $expected['z'][2] = 2;
        $this->assertEquals($expected, $cube->hashTableMap()->toArray());
        $this->expectException(InvalidCubeException::class);
        $cube = new Cube(0, 0, 0, 0);
    }

    public function testHexahedronIntersected()
    {
        $cube1 = new Cube(0, 0, 0, 3);
        $cube2 = new Cube(0, 0, 0, 3);
        $hexahedron = $cube1->hexahedronIntersected($cube2);
        $this->assertEquals($cube1->hashTableMap()->toArray(), $hexahedron->hashTableMap()->toArray());

        $cube1 = new Cube(0, 0, 0, 3);
        $cube2 = new Cube(3, 0, 0, 3);
        $this->expectException(InvalidCubeIntersectionException::class);
        $cube1->hexahedronIntersected($cube2);
    }

    public function testVolume()
    {
        $cube1 = new Cube(0, 0, 0, 12);
        $this->assertEquals(1728, $cube1->volume()->getMeassure());
        $this->expectException(InvalidCubeException::class);
        new Cube(0, 0, 0, 0);
    }
}
