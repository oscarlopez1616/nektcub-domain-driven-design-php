<?php

namespace App\Tests\Domain\Hexahedron\Model;

use PHPUnit\Framework\TestCase;
use App\Domain\Hexahedron\Model\Orthohedron;
use App\Domain\Hexahedron\Exception\InvalidOrthoedronException;

class OrthohedronTest extends TestCase
{
    public function testConstructor()
    {
        $orthohedron = new Orthohedron(0, 1, 2, 3, 4, 3);
        $this->assertEquals(0, $orthohedron->location()->x());
        $this->assertEquals(1, $orthohedron->location()->y());
        $this->assertEquals(2, $orthohedron->location()->z());
        $this->assertEquals(3, $orthohedron->height());
        $this->assertEquals(4, $orthohedron->length());
        $this->assertEquals(3, $orthohedron->depth());
        $this->expectException(InvalidOrthoedronException::class);
        $orthohedron = new Orthohedron(0, 1, 2, 3, 3, 3);
        $this->expectException(InvalidOrthoedronException::class);
        $orthohedron = new Orthohedron(0, 0, 0, 0, 0, 0);
    }

    public function testHashTableMap()
    {
        $cube = new Orthohedron(0, 0, 0, 3, 4, 3);
        $expected = array();
        $expected['x'][0] = 0;
        $expected['x'][1] = 1;
        $expected['x'][2] = 2;
        $expected['y'][0] = 0;
        $expected['y'][1] = 1;
        $expected['y'][2] = 2;
        $expected['y'][3] = 3;
        $expected['z'][0] = 0;
        $expected['z'][1] = 1;
        $expected['z'][2] = 2;
        $this->assertEquals($expected, $cube->hashTableMap()->toArray());
        $this->expectException(InvalidOrthoedronException::class);
        new Orthohedron(0, 0, 0, 0, 0, 0);
    }

    public function testVolume()
    {
        $cube1 = new Orthohedron(0, 0, 0, 12, 24, 12);
        $this->assertEquals(3456, $cube1->volume()->getMeassure());
        $this->expectException(InvalidOrthoedronException::class);
        new Orthohedron(0, 0, 0, 0, 0, 0);
    }
}
