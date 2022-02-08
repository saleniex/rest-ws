<?php

namespace RestWs;

/**
 * Web service which uses header based authentication
 */
class HeaderAuthenticatedWebService extends WebService
{
    private HeaderAuthenticationInterface $authentication;

    public function __construct(string $baseUri, HeaderAuthenticationInterface $authentication)
    {
        parent::__construct($baseUri);
        $this->authentication = $authentication;
    }

    protected function headers(): array
    {
        return array_merge(parent::headers(), [
            $this->authentication->headerName() => $this->authentication->headerValue(),
        ]);
    }
}
