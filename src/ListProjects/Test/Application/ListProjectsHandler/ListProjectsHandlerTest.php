<?php

declare(strict_types=1);

namespace App\ListProjects\Test\Application\ListProjectsHandler;

use App\ListProjects\Application\ListProjectsHandler;
use App\Shared\Test\IntegrationTestCase;

final class ListProjectsHandlerTest extends IntegrationTestCase
{
    private ListProjectsHandler $handler;
    private ListProjectsHandlerTestAssertions $assertions;
    private ListProjectsHandlerTestData $testData;

    public function test_Handle_ShouldListEmptyProjectList_WhenNoProjectsRegistered(): void
    {
        $list = $this->handler->handle();

        $this->assertions->assertListIsEmpty($list);
    }

    public function test_Handle_ShouldListOneProject_WhenOnlyOneProjectIsRegistered(): void
    {
        $this->testData->loadProject();

        $list = $this->handler->handle();

        $this->assertions->assertListContainsOneProject($list);
    }

    protected function setUp(): void
    {
        parent::setUp();

        /** @var ListProjectsHandler handler */
        $this->handler = $this->getInstance(ListProjectsHandler::class);
        /** @var ListProjectsHandlerTestAssertions assertions */
        $this->assertions = $this->getInstance(ListProjectsHandlerTestAssertions::class);
        /** @var ListProjectsHandlerTestData testData */
        $this->testData = $this->getInstance(ListProjectsHandlerTestData::class);

        $this->openTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackTransaction();

        parent::tearDown();
    }
}
