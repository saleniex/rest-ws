<?php

namespace RestWs;

/**
 * Header authentication implementation for HTTP basic authorization
 */
class BasicHttpAuthentication implements HeaderAuthenticationInterface
{
    private string $user;
    private string $password;

    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
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
        return sprintf('Basic %s', base64_encode($this->user . ':' . $this->password));
    }
}
