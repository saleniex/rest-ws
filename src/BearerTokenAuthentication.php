<?php

namespace RestWs;

/**
 * Header authentication implementation for bearer token authentication
 */
class BearerTokenAuthentication implements HeaderAuthenticationInterface
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }


    /**
     * @inheritDoc
     */
    public function headerName(): string
    {
        return 'Authorization';
    }

    /**
     * @inheritDoc
     */
    public function headerValue(): string
    {
        return sprintf('Bearer %s', $this->token);
    }
}
