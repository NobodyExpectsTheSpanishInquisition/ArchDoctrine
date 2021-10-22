<?php

declare(strict_types=1);

namespace App\ListProjects\Test\Application\ListProjectsHandler;

use App\ListProjects\Application\ProjectsListView;
use App\Shared\Test\PrivatePropertiesAccessor;

final class ListProjectsHandlerTestAssertions
{
    public function __construct(
        private ListProjectsHandlerTest $testCase,
        private PrivatePropertiesAccessor $privatePropertiesAccessor
    ) {
    }

    public function assertListContainsOneProject(ProjectsListView $list): void
    {
        $projects = $this->privatePropertiesAccessor->getProperty($list, 'projects');

        $this->testCase::assertCount(1, $projects);
    }

    public function assertListIsEmpty(ProjectsListView $list): void
    {
        $projects = $this->privatePropertiesAccessor->getProperty($list, 'projects');

        $this->testCase::assertCount(0, $projects);
    }
}
