<?php

namespace PelicanPanel\ExternalUser;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class ExternalUser
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getExternalUserById(int $user_id)
    {
        return $this->client->get("api/application/users/external/{$user_id}", []);
    }
}
