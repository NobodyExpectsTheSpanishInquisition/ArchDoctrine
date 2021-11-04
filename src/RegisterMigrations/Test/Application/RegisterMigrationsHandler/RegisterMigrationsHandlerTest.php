<?php

declare(strict_types=1);

namespace App\RegisterMigrations\Test\Application\RegisterMigrationsHandler;

use App\RegisterMigrations\Application\RegisterMigrationsHandler;
use App\Shared\Test\IntegrationTestCase;
use App\Shared\Test\PrivatePropertiesAccessor;

final class RegisterMigrationsHandlerTest extends IntegrationTestCase
{
    private RegisterMigrationsHandlerTestData $testData;
    private RegisterMigrationsHandler $handler;
    private RegisterMigrationsHandlerTestAssertions $assertions;

    public function test_ShouldRegisterMigrationsForProject(): void
    {
        $this->testData->loadProject();

        $this->handler->handle($this->testData->getCommand());

        $this->assertions->assertMigrationsWereRegistered();
    }

    public function test_ShouldThrowException_WhenProjectNotFound(): void
    {
        $this->expectException(\LogicException::class);
        $this->handler->handle($this->testData->getCommand());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $entityManager = $this->getEntityManager();
        $this->testData = new RegisterMigrationsHandlerTestData($entityManager);
        $this->handler = self::getContainer()->get(RegisterMigrationsHandler::class);
        $this->assertions = new RegisterMigrationsHandlerTestAssertions(
            $this,
            $this->testData,
            $entityManager,
            new PrivatePropertiesAccessor()
        );

        $this->openTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackTransaction();

        parent::tearDown();
    }
}
