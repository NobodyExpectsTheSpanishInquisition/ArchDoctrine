<?php

declare(strict_types=1);

namespace App\ListMigrations\Test\Infrastructure\ListMigrationsController;

use App\Shared\Test\WebTestCase;

final class ListMigrationsControllerTest extends WebTestCase
{
    private ListMigrationsControllerTestData $testData;

    public function test_ShouldBeOk(): void
    {
        $this->testData->loadProject();

        $statusCode = $this->get($this->testData->getUri())->getStatusCode();

        self::assertEquals(200, $statusCode);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ListMigrationsControllerTestData($this->getEntityManager());
    }

    protected function tearDown(): void
    {
        $this->testData->clean();

        parent::tearDown();
    }
}
