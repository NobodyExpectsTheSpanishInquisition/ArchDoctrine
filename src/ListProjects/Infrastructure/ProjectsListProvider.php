<?php

declare(strict_types=1);

namespace App\ListProjects\Infrastructure;

use App\ListProjects\Application\ProjectsListProviderInterface;
use App\ListProjects\Application\ProjectsListView;
use App\Shared\Domain\Provider\ProjectProviderInterface;

final class ProjectsListProvider implements ProjectsListProviderInterface
{
    public function __construct(
        private ProjectProviderInterface $projectProvider,
        private ProjectsListMapper $mapper
    ) {
    }

    public function provide(): ProjectsListView
    {
        $projects = $this->projectProvider->findAll();

        return $this->mapper->mapToView($projects);
    }
}
