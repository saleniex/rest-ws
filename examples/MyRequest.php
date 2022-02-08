<?php

use RestWs\WebserviceRequest;

class MyRequest extends WebserviceRequest
{
    /**
     * @inheritDoc
     */
    public function method(): string
    {
        return WebserviceRequest::METHOD_GET;
    }

    /**
     * @inheritDoc
     */
    public function uri(): string
    {
        return '/my-webservice';
    }
}
