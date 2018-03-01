<?php

namespace App\Domain\Hexahedron\Model;

use App\Domain\Hexahedron\Model\Hexahedron;
use App\Domain\Hexahedron\Exception\InvalidOrthoedronException;

class Orthohedron extends Hexahedron
{
    /**
     * @var int
     */
    private $height;
    /**
     * @var int
     */
    private $length;
    /**
     * @var int
     */
    private $depth;

    public function __construct(int $x, int $y, int $z, int $height, int $length, int $depth)
    {
        if (($height<=0 || $length<=0 || $depth<=0) ||
            ($height==$length && $height==$depth && $length==$depth)) {
            throw new InvalidOrthoedronException('invalid $height or length or depth: negative or 0');
        }
        $this->height = $height;
        $this->length = $length;
        $this->depth = $depth;
        parent::__construct($x, $y, $z);
    }

    public function height(): int
    {
        return $this->height;
    }

    public function length(): int
    {
        return $this->length;
    }

    public function depth(): int
    {
        return $this->depth;
    }

    protected function calculateHashtable(): HashTableMapVO
    {
        $hashTableMap = array();
        for ($i = 0; $i < $this->height; $i++) {
            $hashTableMap['x'][$i] = $this->location->x()+$i;
        }
        for ($i = 0; $i < $this->length; $i++) {
            $hashTableMap['y'][$i] = $this->location->y()+$i;
        }
        for ($i = 0; $i < $this->depth; $i++) {
            $hashTableMap['z'][$i] = $this->location->z()+$i;
        }
        return new HashTableMapVO($hashTableMap);
    }

    public function volume(): VolumeVO
    {
        return new VolumeVO($this->height*$this->length*$this->depth);
    }
}
