<?php

namespace App\Tests\Application\UseCase\Hexahedron;

use App\Application\UseCase\Hexahedron\CalculateVolumeIntersectionCubesService;
use App\Domain\Hexahedron\Model\Cube;
use App\Domain\Hexahedron\Model\VolumeVO;
use App\Domain\Hexahedron\Exception\InvalidCubeIntersectionException;

use PHPUnit\Framework\TestCase;

class CalculateVolumeIntersectionCubeServiceTest extends TestCase
{
    public function testHandle()
    {
        $cube1 = $this->createMock(Cube::class);
        $cube2 = $this->createMock(Cube::class);
        $cubeIntersected = $this->createMock(Cube::class);
        $volumeVO = $this->createMock(VolumeVO::class);
        $cubeIntersected->expects($this->once())
            ->method('volume')
            ->will($this->returnValue($volumeVO));
        $cube1->expects($this->once())
            ->method('hexahedronIntersected')
            ->will($this->returnValue($cubeIntersected));
        $calculateVolumeIntersectionCubesService = new CalculateVolumeIntersectionCubesService();
        $this->assertEquals($volumeVO, $calculateVolumeIntersectionCubesService->execute($cube1, $cube2));

        $cube1 = new Cube(0, 0, 0, 3);
        $cube2 = new Cube(3, 0, 0, 3);
        $this->expectException(InvalidCubeIntersectionException::class);
        $cube1->hexahedronIntersected($cube2);
    }
}
