<?php

namespace App\Domain\Hexahedron\Model;

use Ramsey\Uuid\Uuid;

class HexahedronIdVO
{
    private $uuid;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
    }

    public function id(): string
    {
        return $this->uuid->toString();
    }

    public function uuuid(): Uuid
    {
        return $this->uuid;
    }

    public function __toString()
    {
        return $this->uuid->toString();
    }
}
