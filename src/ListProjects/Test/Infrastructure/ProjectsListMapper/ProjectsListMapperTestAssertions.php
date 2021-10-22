<?php

declare(strict_types=1);

namespace App\ListProjects\Test\Infrastructure\ProjectsListMapper;

use App\ListProjects\Application\ProjectsListView;
use App\Shared\Test\PrivatePropertiesAccessor;

final class ProjectsListMapperTestAssertions
{
    public function __construct(
        private ProjectsListMapperTest $testCase,
        private ProjectsListMapperTestData $testData,
        private PrivatePropertiesAccessor $privatePropertiesAccessor
    ) {
    }

    public function assertProjectsWereMappedSuccessfully(ProjectsListView $list): void
    {
        $projects = $this->privatePropertiesAccessor->getProperty($list, 'projects');

        $this->testCase::assertCount(2, $projects);

        $projectOne = $projects[0];

        $this->testCase::assertEquals($this->testData->getProjectOneId(), $projectOne['id']);
        $this->testCase::assertEquals($this->testData->getProjectOneName(), $projectOne['name']);

        $projectTwo = $projects[1];

        $this->testCase::assertEquals($this->testData->getProjectTwoId(), $projectTwo['id']);
        $this->testCase::assertEquals($this->testData->getProjectTwoName(), $projectTwo['name']);
    }
}
