<?php

namespace RestWs\Tests;

use RestWs\BearerTokenAuthentication;
use PHPUnit\Framework\TestCase;

class BearerTokenAuthenticationTest extends TestCase
{
    private BearerTokenAuthentication $authentication;


    protected function setUp(): void
    {
        $this->authentication = new BearerTokenAuthentication('_TOKEN_');
    }

    public function testHeaderName()
    {
        $this->assertEquals('Authorization', $this->authentication->headerName());
    }

    public function testHeaderValue()
    {
        $this->assertEquals('Bearer _TOKEN_', $this->authentication->headerValue());
    }
}
