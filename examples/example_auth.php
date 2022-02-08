<?php

require_once 'MyRequest.php';

$bearerAuth = new \RestWs\BearerTokenAuthentication('_pre-shared_token_');

$webService = new \RestWs\HeaderAuthenticatedWebService('https://api.service.net', $bearerAuth);
$response = $webService->responseOnRequest(new MyRequest());
if ( ! $response->isHttpStatusSuccess()) {
    printf('Web service responded with failure (%d).', $response->httpStatus());
    exit();
}

echo $response->bodyExcerpt();
