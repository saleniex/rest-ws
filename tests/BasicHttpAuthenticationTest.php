<?php

namespace RestWs\Tests;

use PHPUnit\Framework\TestCase;
use RestWs\BasicHttpAuthentication;

class BasicHttpAuthenticationTest extends TestCase
{

    public function testHeaderName()
    {
        $a = new BasicHttpAuthentication('_USER_', '_PASS_');
        $this->assertEquals('Authorization', $a->headerName());
    }

    public function testHeaderValue()
    {
        $a = new BasicHttpAuthentication('_USER_', '_PASS_');
        $this->assertEquals('Basic X1VTRVJfOl9QQVNTXw==', $a->headerValue());
    }
}
