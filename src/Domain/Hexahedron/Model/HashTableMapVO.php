<?php

namespace App\Domain\Hexahedron\Model;

use App\Domain\Hexahedron\Model\PointVO;
use App\Domain\Hexahedron\Exception\InvalidHashTableMapVOException;

class HashTableMapVO
{
    private $hashTable;

    public function __construct(array $hashTable)
    {
        $this->hashTable = $hashTable;
        if (!($this->validateCoordinatesHashTable(array_keys($hashTable)) && $this->validateAllCoordinatesHaveFirstCoordinate())) {
            throw new InvalidHashTableMapVOException('invalid coordinates on hashTableMap');
        }
    }

    private function validateCoordinatesHashTable(array $coordinates): bool
    {
        if (!(count(array_intersect($coordinates, PointVO::COORDINATES)) == count(PointVO::COORDINATES))) {
            return false;
        }
        return true;
    }

    private function validateAllCoordinatesHaveFirstCoordinate(): bool
    {
        foreach (PointVO::COORDINATES as $coordinate) {
            try {
                if (!(count($this->hashTable[$coordinate]))) {
                    return false;
                }
            } catch (\Exception $e) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->hashTable;
    }
}
