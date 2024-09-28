<?php

namespace PelicanPanel\ExternalServer;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class ExternalServer
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getExternalServerById(int $server_id)
    {
        return $this->client->get("api/application/servers/external/{$server_id}", []);
    }
}
