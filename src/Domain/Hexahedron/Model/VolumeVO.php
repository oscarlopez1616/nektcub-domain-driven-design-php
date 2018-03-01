<?php

namespace App\Domain\Hexahedron\Model;

use App\Domain\Hexahedron\Exception\InvalidVolumeVOException;

class VolumeVO
{
    private const UNIT = 'm3';
    private $meassure;
    public function __construct(int $meassure)
    {
        if (!$this->isValidMeassure($meassure)) {
            throw new InvalidVolumeVOException("meassure is negative");
        }
        $this->meassure = $meassure;
    }

    private function isValidMeassure(int $meassure): bool
    {
        return $meassure>=0;
    }

    public function getUnit(): string
    {
        return self::UNIT;
    }

    public function getMeassure(): int
    {
        return $this->meassure;
    }
}
