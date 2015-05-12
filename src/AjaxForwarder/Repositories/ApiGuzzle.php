<?php
namespace AAlakkad\AjaxForwarder\Repositories;

use Config;

class ApiGuzzle implements ApiRepository
{
    protected $client;

    public function __construct()
    {
        $configKey = "forwarder";
        $base_url  = Config::get("{$configKey}.servers.default.host");

        // Setup guzzle client with base url.
        $this->client = new \GuzzleHttp\Client(
            [
                'base_url' => $base_url,
            ]
        );
    }

    public function sendRequest($path, array $data = [])
    {
        // Get default args from config
        $configKey   = "forwarder";
        $defaultArgs = Config::get("{$configKey}.servers.default.data", []);
        $options     = [
            'timeout'         => Config::get("{$configKey}.timeout", 5),
            'connect_timeout' => Config::get("{$configKey}.connect_timeout", 3),
        ];
        // Append default args
        $data = array_merge($defaultArgs, $data);
        if (count($data)) {
            $path .= '?';
            $path .= http_build_query($data);
        }
        return $response = $this->client->get($path, $options);
    }
}
