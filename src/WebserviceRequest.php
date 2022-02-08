<?php

namespace RestWs;

/**
 * Abstract web service request
 */
abstract class WebserviceRequest
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_DELETE = 'DELETE';

    /**
     * HTTP method
     * @return string
     */
    public abstract function method(): string;

    /**
     * Request URI
     * @return string
     */
    public abstract function uri(): string;


    /**
     * Data posted to web service
     *
     * Relevant only if ::method() == "POST"
     *
     * @return array
     */
    public function data(): array
    {
        return [];
    }


    /**
     * Parameters which should be passed as HTTP query
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }


    /**
     * Extra headers
     *
     * @return array
     */
    public function headers(): array
    {
        return [];
    }
}
