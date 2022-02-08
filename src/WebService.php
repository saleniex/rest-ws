<?php

namespace RestWs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Generic REST web service
 * POST requests assume data payload as JSON object
 *
 * Used in conjunction with WebserviceRequest and Webservice response
 */
class WebService
{
    private ?Client $httpClient = null;
    private bool $debug = false;
    private string $baseUri;
    private bool $verify = true;

    /**
     * @param string $baseUri Web service base URI
     */
    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }


    /**
     * @param WebserviceRequest $request
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function httpResponseOnRequest(WebserviceRequest $request): ResponseInterface
    {
        $requestOptions = [
            RequestOptions::DEBUG => $this->debug,
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::VERIFY => $this->verify,
        ];
        $headers = [];
        if ($request->method() === WebserviceRequest::METHOD_POST) {
            $headers['Content-type'] = 'application/json';
            $requestOptions[RequestOptions::BODY] = json_encode($request->data(), JSON_UNESCAPED_SLASHES);
        }
        if ($request->query()) {
            $requestOptions[RequestOptions::QUERY] = $request->query();
        }
        $requestOptions[RequestOptions::HEADERS] = array_merge(
            $headers,
            $this->headers(),
            $request->headers());

        return $this->httpClient()->request($request->method(), $request->uri(), $requestOptions);
    }

    /**
     * Gets response on request from web service
     *
     * @param WebserviceRequest $request Request
     * @return WebserviceResponse Response on request
     * @throws GuzzleException In case of error while connecting to web service
     */
    public function responseOnRequest(WebserviceRequest $request): WebserviceResponse
    {
        return new WebserviceResponse($this->httpResponseOnRequest($request));
    }


    /**
     * HTTP client's base URI passed in web service constructor
     *
     * @return string
     */
    public function baseUri(): string
    {
        return $this->baseUri;
    }


    /**
     * Sets already initialized HTTP Guzzle client
     *
     * @param Client $client
     * @return void
     * @throws \Exception
     */
    public function setHttpClient(Client $client): void
    {
        if ($this->httpClient) {
            throw new \Exception('Cannot set new HTTP client for web service. Already set.');
        }
        $this->httpClient = $client;
    }


    /**
     * Disable SSL cert verification
     * @return void
     */
    public function disableVerify(): void
    {
        $this->verify = false;
    }


    /**
     * Enable debugging output
     * Guzzle dumps all communication flow in output
     */
    public function enableDebug(): void
    {
        $this->debug = true;
    }


    /**
     * Web service specific headers
     *
     * @return array
     */
    protected function headers(): array
    {
        return [];
    }


    private function httpClient(): Client
    {
        if ( ! $this->httpClient) {
            $this->httpClient = new Client(['base_uri' => $this->baseUri]);
        }
        return $this->httpClient;
    }
}
