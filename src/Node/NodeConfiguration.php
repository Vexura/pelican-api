<?php

namespace PelicanPanel\Node;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class NodeConfiguration
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getNodeConfiguration(int $node_id)
    {
        return $this->client->get("api/application/nodes/{$node_id}/configuration", []);
    }
}
