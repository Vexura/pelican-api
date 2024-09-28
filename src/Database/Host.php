<?php

namespace PelicanPanel\Database;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class Host
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getAll()
    {
        return $this->client->get("api/application/database-hosts", []);
    }

    /**
     * @throws GuzzleException
     */
    public function createDatabaseHost(string $name, string $host, int $port, string $username, string $password, int $node_id = null)
    {
        return $this->client->post("api/application/database-hosts", [
            "name" => $name,
            "host" => $host,
            "port" => $port,
            "username" => $username,
            "password" => $password,
            "node_id" => $node_id,
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function getSingleDatabaseHost(int $database_host_id)
    {
        return $this->client->get("api/application/database-hosts/{$database_host_id}", []);
    }

    /**
     * @throws GuzzleException
     */
    public function deleteSingleDatabaseHost(int $database_host_id)
    {
        return $this->client->delete("api/application/database-hosts/{$database_host_id}", []);
    }

}
