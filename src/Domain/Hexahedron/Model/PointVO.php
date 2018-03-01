<?php

namespace App\Domain\Hexahedron\Model;

class PointVO
{
    public const COORDINATES = array('x','y','z');
    private $x;
    private $y;
    private $z;

    public function __construct(int $x, int $y, int $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function z(): int
    {
        return $this->z;
    }

    public function __toString()
    {
        return "(".$this->x.",".$this->y.",".$this->z.")";
    }
}
