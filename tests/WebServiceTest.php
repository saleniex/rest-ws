<?php

namespace RestWs\Tests;

require_once 'MockRequest.php';

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use RestWs\WebService;
use PHPUnit\Framework\TestCase;
use RestWs\WebserviceResponse;

class WebServiceTest extends TestCase
{
    public function testBaseUri()
    {
        $ws = new WebService('_BASE_URI_');
        $this->assertEquals('_BASE_URI_', $ws->baseUri());
    }

    public function testResponseOnRequest()
    {
        $mock = new MockHandler([
            new Response(201, [], '_BODY_'),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $ws = new WebService('');
        $ws->setHttpClient($client);

        $response = $ws->responseOnRequest(new MockRequest('GET'));
        $this->assertInstanceOf(WebserviceResponse::class, $response);
        $this->assertEquals(201, $response->httpStatus());
        $this->assertEquals('_BODY_', $response->body());

    }

    public function testHttpResponseOnRequest()
    {
        $mock = new MockHandler([
            new Response(201, [], '_BODY_'),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $ws = new WebService('');
        $ws->setHttpClient($client);

        $response = $ws->httpResponseOnRequest(new MockRequest('GET'));
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('_BODY_', (string)$response->getBody());
    }
}
