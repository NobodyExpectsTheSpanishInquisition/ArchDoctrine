<?php

declare(strict_types=1);

namespace App\Shared\Test;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as SymfonyWebTestCase;

class WebTestCase extends SymfonyWebTestCase
{
    private EntityManagerInterface $entityManager;
    private Client $client;

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function get(string $uri): ResponseInterface
    {
        return $this->client->get($uri);
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param array<string, mixed> $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function post(string $uri, array $params): ResponseInterface
    {
        return $this->client->post($uri, ['form_params' => $params]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new Client(['base_uri' => $_ENV['APP_URL'] . ':' . $_ENV['APP_PORT']]);
        $this->entityManager = $this->instantiateEntityManager();
    }

    private function instantiateEntityManager(): EntityManagerInterface
    {
        return self::getContainer()->get(EntityManagerInterface::class);
    }
}
