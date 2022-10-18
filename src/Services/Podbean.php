<?php

namespace Garcia\Podbean\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Garcia\Podbean\Exceptions\NotAbleToConnectionException;

abstract class Podbean
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var int
     */
    private int $status;

    /**
     * @var string
     */
    private string $accessToken;

    /**
     * @param string $baseUrl
     * @param string $clientId
     * @param string $clientSecret
     * @throws GuzzleException
     */
    public function __construct(
        string $baseUrl,
        string $clientId,
        string $clientSecret
    ) {
        try {
            $this->client = new Client(["base_uri" => $baseUrl]);
            $response = $this->client->post("/v1/oauth/multiplePodcastsToken", [
                "auth" => [$clientId, $clientSecret],
                "json" => [
                    "grant_type" => "client_credentials",
                ],
            ]);

            $this->status = $response->getStatusCode();
            $this->accessToken = json_decode(
                $response->getBody()->getContents()
            )->access_token;
        } catch (ClientException $e) {
            throw new NotAbleToConnectionException();
        }
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
