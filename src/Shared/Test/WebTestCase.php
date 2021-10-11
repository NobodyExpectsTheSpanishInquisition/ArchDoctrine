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

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param array<string, mixed> $params
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    protected function post(string $uri, array $params): ResponseInterface
    {
        return $this->client->post($uri, ['form_params' => $params]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->entityManager = $this->instantiateEntityManager();
        $this->client = new Client(['base_uri' => $_ENV['APP_URL'] . ':' . $_ENV['APP_PORT']]);
    }

    private function instantiateEntityManager(): EntityManagerInterface
    {
        return self::getContainer()->get(EntityManagerInterface::class);
    }
}
