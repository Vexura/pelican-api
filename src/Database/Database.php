<?php

namespace PelicanPanel\Database;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class Database
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getAllDatabases(int $server_id)
    {
        return $this->client->get("api/application/servers/{$server_id}/databases", []);
    }

    /**
     * @throws GuzzleException
     */
    public function createDatabase(int $server_id)
    {
        return $this->client->post("api/application/servers/{$server_id}/databases", []);
    }

    /**
     * @throws GuzzleException
     */
    public function getSingleDatabase(int $server_id, int $database_id)
    {
        return $this->client->get("api/application/servers/{$server_id}/databases/{$database_id}", []);
    }

    /**
     * @throws GuzzleException
     */
    public function deleteSingleDatabase(int $server_id, int $database_id)
    {
        return $this->client->delete("api/application/servers/{$server_id}/databases/{$database_id}", []);
    }

    /**
     * @throws GuzzleException
     */
    public function resetSingleDatabasePassword(int $server_id, int $database_id)
    {
        return $this->client->post("api/application/servers/{$server_id}/databases/{$database_id}/reset-password", []);
    }
}
