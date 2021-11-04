<?php

declare(strict_types=1);

namespace App\RegisterMigrations\Test\Infrastructure\RegisterMigrationsController;

use App\Shared\Test\WebTestCase;

final class RegisterMigrationsControllerTest extends WebTestCase
{
    private RegisterMigrationsControllerTestData $testData;

    public function test_ShouldBeOk(): void
    {
        $this->testData->loadProject();

        $statusCode = $this->patch($this->testData->getUri(), $this->testData->getRequestParams())->getStatusCode();

        self::assertEquals(204, $statusCode);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new RegisterMigrationsControllerTestData($this->getEntityManager());
    }

    protected function tearDown(): void
    {
        $this->testData->clean();

        parent::tearDown();
    }
}
