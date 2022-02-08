<?php

namespace RestWs;

/**
 * Header bases authentication interface
 * Should be implemented by authenticators which use header as authentication channel
 */
interface HeaderAuthenticationInterface
{
    /**
     * Authentication header name
     * @return string
     */
    public function headerName(): string;


    /**
     * Authentication header value
     * @return string
     */
    public function headerValue(): string;
}
