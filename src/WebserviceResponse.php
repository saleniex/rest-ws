<?php

namespace RestWs;

use Psr\Http\Message\ResponseInterface;

/**
 * Response base class
 */
class WebserviceResponse
{
    private ResponseInterface $response;

    private array $decodedBody = [];

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }


    public function body(): string
    {
        return (string)$this->response->getBody();
    }

    public function bodyExcerpt(int $maxLen = 100): string
    {
        $body = $this->body();
        if (strlen($body) > $maxLen) {
            return substr($body, 0, $maxLen) . '...';
        }

        return $body;
    }


    public function httpStatus(): int
    {
        return $this->response->getStatusCode();
    }

    public function isHttpStatusSuccess(): bool
    {
        return 200 <= $this->httpStatus() && $this->httpStatus() < 300;
    }


    public function decodedBody(): array
    {
        if ( ! $this->decodedBody) {
            $data = json_decode($this->body(), true);
            $this->decodedBody = $data ?? [];
        }
        return $this->decodedBody;
    }



    public function decodedBodyProperty(string $name): ?string
    {
        $d = $this->decodedBody();
        return $d[$name] ?? null;
    }
}
