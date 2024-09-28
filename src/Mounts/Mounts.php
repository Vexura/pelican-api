<?php

namespace PelicanPanel\Mounts;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class Mounts
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getAllMounts()
    {
        return $this->client->get("api/application/mounts", []);
    }

    /**
     * @throws GuzzleException
     */
    public function createMount()
    {
        return $this->client->post("api/application/mounts", []);
    }

    /**
     * @throws GuzzleException
     */
    public function getSingleMountById(int $mount_id)
    {
        return $this->client->get("api/application/mounts/{$mount_id}", []);
    }

    /**
     * @throws GuzzleException
     */
    public function deleteMountById(int $mount_id)
    {
        return $this->client->delete("api/application/mounts/{$mount_id}", []);
    }

    //TODO ADD ALL ENDPOINTS (API DOCS SHOWS ERRORS)
}
