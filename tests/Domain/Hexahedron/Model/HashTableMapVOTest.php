<?php

namespace App\Tests\Domain\Hexahedron\Model;

use PHPUnit\Framework\TestCase;
use App\Domain\Hexahedron\Model\HashTableMapVO;
use App\Domain\Hexahedron\Exception\InvalidHashTableMapVOException;

class HashTableMapVOTest extends TestCase
{
    public function testConstruct()
    {
        $hashTableMapVOArr = array();
        $hashTableMapVOArr['x'][0]=0;
        $hashTableMapVOArr['y'][0]=0;
        $hashTableMapVOArr['z'][0]=0;
        $hashTableMapVO = new HashTableMapVO($hashTableMapVOArr);
        $this->assertEquals($hashTableMapVOArr, $hashTableMapVO->toArray());

        $this->expectException(InvalidHashTableMapVOException::class);
        $hashTableMapVOArr = array();
        $hashTableMapVOArr['p'][0]=0;
        $hashTableMapVOArr['y'][0]=0;
        $hashTableMapVOArr['z'][0]=0;
        $hashTableMapVO = new HashTableMapVO($hashTableMapVOArr);
    }
}
