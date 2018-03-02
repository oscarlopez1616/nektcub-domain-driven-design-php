<?php

namespace App\Tests\UI\Http\Rest\Hexahedron\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CubeControllerTest extends WebTestCase
{

    /**
     * @covers \App\UI\Http\Rest\Hexahedron\Controller\CubeController::getVolumeAction
     * @dataProvider dataProvider
     */
    public function testGetVolumeAction($uri, $expectedCode, $expectedJson)
    {
        $client = static::createClient();
        $client->request('GET', $uri);
        $this->assertEquals($expectedCode, $client->getResponse()->getStatusCode());
        $this->assertEquals($expectedJson, $client->getResponse()->getContent());
    }

    public function dataProvider()
    {
        return array(
            array('/api/cube/volume?x1=0&y1=0&z1=0&edge1=3&x2=3&y2=0&z2=0&edge2=3', 200, '{"unit":"cm","meassure":0}'),
            array('/api/cube/volume?x1=0&y1=0&z1=0&edge1=3&x2=0&y2=0&z2=0&edge2=3', 200, '{"unit":"cm","meassure":27}'),
            array('/api/cube/volume?x1=0&y1=0&z1=0&edge1=3&x2=1&y2=0&z2=0&edge2=3', 200, '{"unit":"cm","meassure":18}')
        );
    }
}
