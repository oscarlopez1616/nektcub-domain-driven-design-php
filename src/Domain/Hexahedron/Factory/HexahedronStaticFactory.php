<?php

namespace App\Domain\Hexahedron\Factory;

use App\Domain\Hexahedron\Model\Hexahedron;
use App\Domain\Hexahedron\Model\Cube;
use App\Domain\Hexahedron\Model\Orthohedron;
use App\Domain\Hexahedron\Model\HashTableMapVO;

class HexahedronStaticFactory
{
    public static function createHexahedronFromHashMap(HashTableMapVO $hashTable): Hexahedron
    {
        switch (self::getTypeOfHexahedron($hashTable->toArray())) {
            case Hexahedron::HEXAHEDRON_TYPES[0]://cube
                return self::createCubeFromHashMap($hashTable->toArray());
            case Hexahedron::HEXAHEDRON_TYPES[1]://orthoedron
                return self::createOrthohedronFromHashMap($hashTable->toArray());
        }
    }

    private static function getTypeOfHexahedron($hashTable): string
    {
        if ((count($hashTable['x']) == count($hashTable['y'])) && (count($hashTable['x']) == count($hashTable['z']))) {
            return Hexahedron::HEXAHEDRON_TYPES[0];//cube
        } else {
            return Hexahedron::HEXAHEDRON_TYPES[1];//orthoedron
        }
    }

    private static function createCubeFromHashMap(array $hashTable): Cube
    {
        return new Cube($hashTable['x'][0], $hashTable['y'][0], $hashTable['z'][0], count($hashTable['x']));
    }

    private static function createOrthohedronFromHashMap(array $hashTable): Orthohedron
    {
        return new Orthohedron($hashTable['x'][0], $hashTable['y'][0], $hashTable['z'][0], count($hashTable['x']), count($hashTable['y']), count($hashTable['z']));
    }
}
