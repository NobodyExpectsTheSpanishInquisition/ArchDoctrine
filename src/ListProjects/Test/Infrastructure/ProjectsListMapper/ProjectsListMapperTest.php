<?php

declare(strict_types=1);

namespace App\ListProjects\Test\Infrastructure\ProjectsListMapper;

use App\ListProjects\Infrastructure\ProjectsListMapper;
use App\Shared\Test\PrivatePropertiesAccessor;
use App\Shared\Test\UnitTestCase;

final class ProjectsListMapperTest extends UnitTestCase
{
    private ProjectsListMapper $mapper;
    private ProjectsListMapperTestData $testData;
    private ProjectsListMapperTestAssertions $assertions;

    public function test_MapToView_ShouldMapProjectsToViews(): void
    {
        $list = $this->mapper->mapToView($this->testData->getProjects());

        $this->assertions->assertProjectsWereMappedSuccessfully($list);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = new ProjectsListMapper();
        $this->testData = new ProjectsListMapperTestData();
        $this->assertions =
            new ProjectsListMapperTestAssertions($this, $this->testData, new PrivatePropertiesAccessor());
    }
}
