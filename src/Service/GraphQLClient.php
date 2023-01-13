<?php

namespace App\Service;

use App\Interfaces\GraphQLClientInterface;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GraphQLClient implements GraphQLClientInterface
{
    private HttpClientInterface $client;
    private string $defaultURL;

    /**
     * @param HttpClientInterface $client
     * @param KernelInterface $kernel
     */
    public function __construct(HttpClientInterface $client, KernelInterface $kernel)
    {
        $this->client = $client;
        $this->defaultURL = $kernel->getContainer()->getParameter('app.graphql_api_url');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function query(
        string $query,
        array $variables = [],
        ?string $token = null,
        string $endpoint = null
    ): string|array
    {
        if (is_null($endpoint)) {
            $endpoint = $this->defaultURL;
        }

        $options = (new HttpOptions())
            ->setJson(['query' => $query, 'variables' => $variables])
            ->setHeaders([
                'Content-Type' => 'application/json',
                'User-Agent' => 'Symfony GraphQL client'
            ])
        ;

        if (null !== $token) {
            $options->setAuthBearer($token);
        }

        $response = $this->client
            ->request('POST', $endpoint, $options->toArray())
            ->toArray();

        return array_key_exists('errors', $response)
            ? $response['errors'][0]['message']
            : $response;
    }
}