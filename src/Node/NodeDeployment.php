<?php

namespace PelicanPanel\Node;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class NodeDeployment
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getDeployableNode(int $disk, int $memory, int $cpu = null, array $location_ids = null, int $page = null, array $tags = null)
    {
        return $this->client->get("api/application/nodes/deployable", [
            "disk" => $disk,
            "memory" => $memory,
            "cpu" => $cpu,
            "location_ids" => $location_ids,
            "page" => $page,
            "tags" => $tags,
        ]);
    }
}
