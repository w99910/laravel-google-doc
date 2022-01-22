<?php

namespace Zlt\LaravelGoogleDoc\Services;

use Google_Service_Docs;

class GoogleDocService
{
    private Google_Service_Docs $service;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $client = new \Google\Client();
        $config = config('filesystems.disks.google');
        $client->setScopes(Google_Service_Docs::DOCUMENTS);
        $client->setClientId($config['clientId']);
        $client->setClientSecret($config['clientSecret']);
        $client->refreshToken($config['refreshToken']);
        $client->setAccessType('online');
        $this->service = new Google_Service_Docs($client);
    }

    public function getDoc($documentId): \Google\Service\Docs\Document
    {
        return $this->service->documents->get($documentId);
    }
}
