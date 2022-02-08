<?php

require_once 'MyRequest.php';

$webService = new \RestWs\WebService('https://api.service.net');
$response = $webService->responseOnRequest(new MyRequest());
if ( ! $response->isHttpStatusSuccess()) {
    printf('Web service responded with failure (%d).', $response->httpStatus());
    exit();
}

echo $response->bodyExcerpt();
