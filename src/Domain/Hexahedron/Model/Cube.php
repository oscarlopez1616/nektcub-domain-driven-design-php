<?php

namespace App\Domain\Hexahedron\Model;

use App\Domain\Hexahedron\Model\Hexahedron;
use App\Domain\Hexahedron\Factory\HexahedronStaticFactory;
use App\Domain\Hexahedron\Exception\InvalidCubeException;
use App\Domain\Hexahedron\Exception\InvalidHashTableMapVOException;
use App\Domain\Hexahedron\Exception\InvalidCubeIntersectionException;

class Cube extends Hexahedron
{
    /**
     * @var int
     */
    private $edge;

    public function __construct(int $x, int $y, int $z, int $edge)
    {
        if ($edge<=0) {
            throw new InvalidCubeException('invalid edge: negative');
        }
        $this->edge = $edge;
        parent::__construct($x, $y, $z);
    }

    public function edge(): int
    {
        return $this->edge;
    }

    protected function calculateHashtable(): HashTableMapVO
    {
        $hashTableMap = array();
        for ($i=0;$i<$this->edge;$i++) {
            $hashTableMap['x'][$i]=$i+$this->location->x();
            $hashTableMap['y'][$i]=$i+$this->location->y();
            $hashTableMap['z'][$i]=$i+$this->location->z();
        }
        return new HashTableMapVO($hashTableMap);
    }

    public function volume(): VolumeVO
    {
        return new VolumeVO(pow($this->edge, 3));
    }

    public function hexahedronIntersected(Cube $cube): Hexahedron
    {
        $cubeIntersectedHashTable = array();
        $cube1HashTableArray = $this->hashTableMap()->toArray();
        $cube2HashTableArray = $cube->hashTableMap()->toArray();
        foreach (PointVO::COORDINATES as $coordinate) {
            $cubeIntersectedHashTable[$coordinate] = array_values(array_intersect($cube1HashTableArray[$coordinate], $cube2HashTableArray[$coordinate]));
        }
        try {
            $hashTableMap = new HashTableMapVO($cubeIntersectedHashTable);
            return HexahedronStaticFactory::createHexahedronFromHashMap($hashTableMap);
        } catch (InvalidHashTableMapVOException $e) {
            throw new InvalidCubeIntersectionException('the cubes do not intersect');
        }
    }
}
