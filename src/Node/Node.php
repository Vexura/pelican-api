<?php

namespace PelicanPanel\Node;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class Node
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getAllNodes()
    {
        return $this->client->get("api/application/nodes", []);
    }

    /**
     * @throws GuzzleException
     */
    public function createNode(string $name, bool $public, string $domain, bool $isHttps, bool $behindProxy, int $memory, int $memory_overallocate, int $disk, int $disk_overallocate, int $cpu, int $cpu_overallocate, string $description = null)
    {
        return $this->client->post("api/application/nodes", [
            "name" => $name,
            "public" => $public,
            "fqdn" => $domain,
            "scheme" => $isHttps ? "https" : "http",
            "behindProxy" => $behindProxy,
            "memory" => $memory,
            "memory_overallocate" => $memory_overallocate,
            "disk" => $disk,
            "disk_overallocate" => $disk_overallocate,
            "cpu" => $cpu,
            "cpu_overallocate" => $cpu_overallocate,
            "description" => $description
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function getSingleNodeById(int $node_id)
    {
        return $this->client->get("api/application/nodes/{$node_id}", []);
    }

    /**
     * @throws GuzzleException
     */
    public function deleteNodeById(int $node_id)
    {
        return $this->client->delete("api/application/nodes/{$node_id}", []);
    }

    //TODO ADD ALL ENDPOINTS (API DOCS SHOWS ERRORS)
}
