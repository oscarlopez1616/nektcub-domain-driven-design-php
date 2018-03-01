<?php

namespace App\Domain\Hexahedron\Model;

use App\Domain\Hexahedron\Model\PointVO;
use App\Domain\Hexahedron\Model\HashTableMapVO;
use App\Domain\Hexahedron\Model\VolumeVO;
use App\Domain\Hexahedron\Model\HexahedronIdVO;

abstract class Hexahedron
{
    public const HEXAHEDRON_TYPES = array('cube','orthoedron');

    /**
     * @var \App\Domain\Hexahedron\Model\HexahedronIdVO
     */
    protected $id;
    /**
     * @var \App\Domain\Hexahedron\Model\PointVO
     */
    protected $location;


    public function __construct(int $x, int $y, int $z)
    {
        $this->id = new HexahedronIdVO();
        $this->location = new PointVO($x, $y, $z);
    }


    public function location(): PointVO
    {
        return $this->location;
    }


    public function hashTableMap(): HashTableMapVO
    {
        return $this->calculateHashtable();
    }

    abstract protected function calculateHashtable(): HashTableMapVO;

    abstract public function volume(): VolumeVO;
}
