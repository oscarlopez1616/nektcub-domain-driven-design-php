<?php

namespace App\Application\UseCase\Hexahedron;

class CreateCubeRequest
{
    private $x;
    private $y;
    private $z;
    private $edge;

    public function __construct(int $x, int $y, int $z, int $edge)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->edge = $edge;
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

    public function edge(): int
    {
        return $this->edge;
    }
}
