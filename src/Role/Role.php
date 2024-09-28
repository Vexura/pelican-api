<?php

namespace PelicanPanel\Role;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Client;

class Role
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getAllRoles()
    {
        return $this->client->get("api/application/roles", []);
    }

    /**
     * @throws GuzzleException
     */
    public function createNewRole(string $name, string $guard = null)
    {
        return $this->client->post("api/application/roles", [
            "name" => $name,
            "guard" => $guard
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function getSingleRoleById(int $role_id)
    {
        return $this->client->get("api/application/roles/{$role_id}", []);
    }

    /**
     * @throws GuzzleException
     */
    public function updateRole(int $role_id, string $name = null, string $guard = null)
    {
        return $this->client->patch("api/application/roles/{$role_id}", [
            "name" => $name,
            "guard" => $guard
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function deleteRole(int $role_id)
    {
        return $this->client->delete("api/application/roles/{$role_id}", []);
    }
}
