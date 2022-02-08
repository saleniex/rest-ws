<?php

namespace RestWs\Tests;

require_once 'ResponseMock.php';

use PHPUnit\Framework\TestCase;
use RestWs\WebserviceResponse;

class WebserviceResponseTest extends TestCase
{
    private ?WebserviceResponse $response = null;


    protected function setUp(): void
    {
        $this->response = new WebserviceResponse(new ResponseMock([
            'getStatusCode' => 200,
            'getBody' => '{"name":"_NAME_","value":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."}',
        ]));
    }

    public function testBodyExcerpt()
    {
        $this->assertEquals(
            '{"name":"_NAME_","value":"Lorem Ipsum is simply dummy text of the printing and typesetting industry....',
            $this->response->bodyExcerpt());
    }

    public function testDecodedBody()
    {
        $decode = $this->response->decodedBody();
        $this->assertCount(2, $decode);
    }

    public function testHttpStatus()
    {
        $this->assertEquals(200, $this->response->httpStatus());
    }

    public function testBody()
    {
        $this->assertEquals(
            '{"name":"_NAME_","value":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."}',
            $this->response->body());
    }

    public function testIsHttpStatusSuccess()
    {
        $this->assertTrue($this->response->isHttpStatusSuccess());

        $r01 = new WebserviceResponse(new ResponseMock([
            'getStatusCode' => 400,
            'getBody' => '',
        ]));
        $this->assertFalse($r01->isHttpStatusSuccess());
    }

    public function testDecodedBodyProperty()
    {
        $this->assertEquals(
            '_NAME_',
            $this->response->decodedBodyProperty('name'));
        $this->assertEquals(
            'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            $this->response->decodedBodyProperty('value'));
    }
}
