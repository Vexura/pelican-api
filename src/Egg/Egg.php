<?php

namespace PelicanPanel\Egg;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class Egg
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getAllEggs()
    {
        return $this->client->get("api/application/eggs", []);
    }

    /**
     * @throws GuzzleException
     */
    public function getSingleEgg(int $egg_id)
    {
        return $this->client->get("api/application/eggs/{$egg_id}", []);
    }
}
