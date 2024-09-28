<?php

namespace PelicanPanel\Allocations;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class Allocations
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getAllAllocations(int $node_id)
    {
        return $this->client->get("api/application/nodes/{$node_id}/allocations", []);
    }

    /**
     * @throws GuzzleException
     */
    public function addAllocation(int $node_id, string $ip, array $ports, string $alias = null)
    {
        return $this->client->post("api/application/nodes/{$node_id}/allocations/", [
            "ip" => $ip,
            "ports" => $ports,
            "alias" => $alias
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function deleteAllocation(int $node_id, int $allocation_id)
    {
        return $this->client->delete("api/application/nodes/{$node_id}/allocations/{$allocation_id}", []);
    }
}
