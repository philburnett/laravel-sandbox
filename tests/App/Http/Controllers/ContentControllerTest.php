<?php

namespace UnitTests\App\Http\Controllers;

use TestCase;

/**
 * Class ContentControllerTest
 *
 * @package UnitTests\App\Http\Controllers
 */
class ContentControllerTest extends TestCase
{
    public function testPut()
    {
        $response = $this->call(
            'POST',
            'contents',
            [],
            [],
            [],
            ['content_type' => 'application/json'],
            $this->getData()
        );

        $this->assertEquals(202, $response->getStatusCode());
    }

    private function getData()
    {
        return json_encode([
            'author' => [
                'name' => 'Foo Bar',
            ],
            'content' => [
                'content' => 'This is some test content'
            ]
        ]);
    }
}
