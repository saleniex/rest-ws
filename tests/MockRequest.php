<?php

namespace RestWs\Tests;

use RestWs\WebserviceRequest;

class MockRequest extends WebserviceRequest
{
    private string $method;
    private string $uri;
    private array $data;
    private array $query;
    private array $headers;


    public function __construct(string $method = '', string $uri = '', array $data = [], array $query = [], array $headers = [])
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->data = $data;
        $this->query = $query;
        $this->headers = $headers;
    }


    public function method(): string
    {
        return $this->method;
    }


    public function uri(): string
    {
        return $this->uri;
    }


    public function data(): array
    {
        return $this->data;
    }


    public function query(): array
    {
        return $this->query;
    }


    public function headers(): array
    {
        return $this->headers;
    }
}
