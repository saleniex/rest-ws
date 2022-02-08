<?php

namespace RestWs\Tests;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 *
 */
class ResponseMock implements ResponseInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->data['getProtocolVersion'];
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        return $this->data['withProtocolVersion'];
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $this->data['getHeaders'];
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        return $this->data['hasHeader'];
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        return $this->data['getHeader'];
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        return $this->data['getHeaderLine'];
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        return $this->data['withHeader'];
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        return $this->data['withAddedHeader'];
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        return $this->data['withoutHeader'];
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return $this->data['getBody'];
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        return $this->data['withBody'];
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return $this->data['getStatusCode'];
    }

    /**
     * @inheritDoc
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        return $this->data['withStatus'];
    }

    /**
     * @inheritDoc
     */
    public function getReasonPhrase()
    {
        return $this->data['getReasonPhrase'];
    }
}
