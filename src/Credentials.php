<?php

namespace PelicanPanel;

class Credentials
{
    private string $token;
    private string $url;

    /**
     * Credentials constructor
     * @param string $url
     * @param string $token
     */
    public function __construct(string $url, string $token)
    {
        $this->token = $token;
        $this->url = $url;
    }

    public function __toString()
    {
        return sprintf('[Host: %s], [Token: %s]', $this->url, $this->token);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

}
