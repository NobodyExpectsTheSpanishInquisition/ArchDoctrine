<?php

declare(strict_types=1);

namespace App\ListProjects\Infrastructure;

use App\ListProjects\Application\ProjectsListProviderInterface;
use App\ListProjects\Application\ProjectsListView;
use App\Shared\Application\Repository\ProjectRepositoryInterface;

final class ProjectsListProvider implements ProjectsListProviderInterface
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository,
        private ProjectsListMapper $mapper
    ) {
    }

    public function provide(): ProjectsListView
    {
        $projects = $this->projectRepository->findAll();

        return $this->mapper->mapToView($projects);
    }
}
