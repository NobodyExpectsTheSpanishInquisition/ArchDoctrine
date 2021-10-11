<?php

declare(strict_types=1);

namespace App\RegisterProject\Test\Infrastructure\RegisterProjectController;

use App\Shared\Test\WebTestCase;

final class RegisterProjectControllerTest extends WebTestCase
{
    private RegisterProjectControllerTestData $testData;

    public function test_ShouldReturnCreatedStatus_WhenProjectWasRegisteredSuccessful(): void
    {
        $response = $this->post($this->testData->getUri(), $this->testData->getData());

        self::assertEquals(201, $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new RegisterProjectControllerTestData($this->getEntityManager());
    }

    protected function tearDown(): void
    {
        $this->testData->deleteRegisteredProject();

        parent::tearDown();
    }
}
