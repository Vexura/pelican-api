<?php

namespace PelicanPanel;

use GuzzleHttp\Exception\GuzzleException;
use PelicanPanel\Database\Database;
use PelicanPanel\Database\Host;
use PelicanPanel\ExternalServer\ExternalServer;
use PelicanPanel\ExternalUser\ExternalUser;
use Psr\Http\Message\ResponseInterface;
use PelicanPanel\Allocations\Allocations;
use PelicanPanel\Exceptions\ParameterException;


class Client
{
    private $httpClient;
    private $credentials;
    private $apiToken;

    private $url;
    private $allocationHandler;
    /**
     * @var Database
     */
    private $databaseHandler;
    /**
     * @var Host
     */
    private $databaseHostHandler;

    private $externalServerHandler;

    private $externalUserHandler;

    /**
     * @param string $url
     * @param string $token
     * @param string $version
     * @param null $httpClient
     */
    public function __construct(string $url, string $token, $httpClient = null)
    {
        $this->apiToken = $token;
        $this->url = $url;
        $this->httpClient = $httpClient;
        $this->credentials = new Credentials($url, $token);
    }

    /**
     * @param \GuzzleHttp\Client|null $httpClient
     * @return void
     */
    public function setHttpClient(\GuzzleHttp\Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new \GuzzleHttp\Client([
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiToken,
                'User-Agent' => 'APIClient/1.0'
            ],
            'allow_redirects' => false,
            'follow_redirects' => false,
            'timeout' => 120
        ]);
    }

    /**
     * @param $url
     * @param $credentials
     * @return void
     */
    public function setCredentials($url, $credentials)
    {
        if (!$credentials instanceof Credentials) {
            $credentials = new Credentials($url, $credentials);
        }

        $this->credentials = $credentials;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient(): \GuzzleHttp\Client
    {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->apiToken;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return Credentials
     */
    private function getCredentials(): Credentials
    {
        return $this->credentials;
    }


    /**
     * @param string $actionPath
     * @param array $params
     * @param string $method
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function request(string $actionPath, array $params = [], string $method = 'GET'): ResponseInterface
    {
        $url = $this->getCredentials()->getUrl() . $actionPath;

        if (!is_array($params)) {
            throw new ParameterException();
        }

        switch ($method) {
            case 'GET':
                return $this->getHttpClient()->get($url, [
                    'verify' => false,
                    'json' => $params
                ]);
            case 'POST':
                return $this->getHttpClient()->post($url, [
                    'verify' => false,
                    'json' => $params
                ]);
            case 'PUT':
                return $this->getHttpClient()->put($url, [
                    'verify' => false,
                    'json' => $params
                ]);
            case 'DELETE':
                return $this->getHttpClient()->delete($url, [
                    'verify' => false,
                    'json' => $params
                ]);
            default:
                throw new ParameterException('Wrong method: ' . $method);
        }
    }

    /**
     * @param ResponseInterface $response
     * @return mixed|string
     */
    public function processRequest(ResponseInterface $response)
    {
        $response = $response->getBody()->__toString();
        $result = json_decode($response);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $result;
        } else {
            return $response;
        }
    }

    /**
     * @param string $actionPath
     * @param array $params
     * @return mixed|string
     * @throws GuzzleException
     */
    public function post(string $actionPath, array $params = [])
    {
        $response = $this->request($actionPath, $params, 'POST');
        return $this->processRequest($response);
    }

    /**
     * @param string $actionPath
     * @param array $params
     * @return mixed|string
     * @throws GuzzleException
     */
    public function get(string $actionPath, array $params = [])
    {
        $response = $this->request($actionPath, $params, 'GET');
        return $this->processRequest($response);
    }

    /**
     * @param string $actionPath
     * @param array $params
     * @return mixed|string
     * @throws GuzzleException
     */
    public function put(string $actionPath, array $params = [])
    {
        $response = $this->request($actionPath, $params, 'PUT');
        return $this->processRequest($response);
    }

    /**
     * @param string $actionPath
     * @param array $params
     * @return mixed|string
     * @throws GuzzleException
     */
    public function delete(string $actionPath, array $params = [])
    {
        $response = $this->request($actionPath, $params, 'DELETE');
        return $this->processRequest($response);
    }

    /**
     * @return Allocations
     */
    public function allocations(): Allocations
    {
        if (!$this->allocationHandler) $this->allocationHandler = new Allocations($this);
        return $this->allocationHandler;
    }

    /**
     * @return Database
     */
    public function database(): Database
    {
        if (!$this->databaseHandler) $this->databaseHandler = new Database($this);
        return $this->databaseHandler;
    }

    /**
     * @return Host
     */
    public function databaseHost(): Host
    {
        if (!$this->databaseHostHandler) $this->databaseHostHandler = new Host($this);
        return $this->databaseHostHandler;
    }

    /**
     * @return ExternalServer
     */
    public function externalServer(): ExternalServer
    {
        if (!$this->externalServerHandler) $this->externalServerHandler = new ExternalServer($this);
        return $this->externalServerHandler;
    }

    /**
     * @return ExternalUser
     */
    public function externalUser(): ExternalUser
    {
        if (!$this->externalUserHandler) $this->externalUserHandler = new ExternalUser($this);
        return $this->externalUserHandler;
    }
}
